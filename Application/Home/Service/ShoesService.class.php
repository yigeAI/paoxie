<?php

namespace Home\Service;

use Think\Controller;
use Home\Model\ShoesModel;


class ShoesService extends Controller
{


    /**
     * 脚型介绍
     * @param $responses_result
     * @return mixed
     */
    public static function get_foot_type_intr_link($ai_return_answer)
    {
        return str_replace('[[link]]', C('JIAOXING_URL'), $ai_return_answer);
    }


    /**
     *  脚型匹配
     * @param $responses_result
     * @return mixed
     */
    public static function match_shoe_type($responses_result)
    {
    	if (isset($responses_result['action']) && $responses_result['action']['name'] == 'find_shoe_type') {

            $str_jiaoxing = '';
            $str_xiexing  = '[[shoe_type]]';
            $arr_xiexing_config  = C('XIEXING');
            
            foreach ($responses_result['action']['parameters'] as  $value) {
                
                if ($value['name'] == 'jiaoxing') {
                    $str_jiaoxing = $value['value'];
                }

            }
            return str_replace($str_xiexing, $arr_xiexing_config[$str_jiaoxing], $responses_result['answer']);
        }
        return $responses_result['answer'];
    }


    /**
     * 脚型确认
     * @param $responses_result
     * @return string
     */
    public static function foot_type_confirmation_message($responses_result)
    {

        $str_return = '';
        $arr_where_and_flag =  $arr_where = $arr_flag =  array();
        $arr_action_parameters =$responses_result['action']['parameters'];
        $str_answer = $responses_result['answer'];

        if (isset($arr_action_parameters)) {

            foreach ($arr_action_parameters as $value) {
                switch ($value['name']) {

                    case 'jiaoxing': // 脚型

                        $arr_where_and_flag = self::get_constraint_condition($value,'jiaoxing');
                        $arr_where['jiaoxing'] = $arr_where_and_flag['where'];
                        break;

                    case 'mile':// 公里数

                        $arr_where_and_flag = self::get_constraint_condition($value,'mile');
                        $arr_where['exercise'] = $arr_where_and_flag['where'];
                        $arr_flag['mile_flag'] = $arr_where_and_flag['mile_flag'];
                        break;

                    case 'price': // 价格

                        $arr_where_and_flag = self::get_constraint_condition($value,'price');
                        $arr_where['price'] = $arr_where_and_flag['where'];
                        $arr_flag['price_flag'] = $arr_where_and_flag['mile_flag'];
                        break;

                    case 'xingbie': // 性别

                        $arr_where_and_flag = self::get_constraint_condition($value,'xingbie');
                        $arr_where['sex'] = $arr_where_and_flag['where'];
                        break;
                    
                    default:
                        break;
                }
            }
        }

         $arr_shooes_data = ShoesModel::getShoesListOrderByPrice($arr_where);

        if (!empty($arr_shooes_data)) {

            foreach ($arr_shooes_data as $arr_shooes_data_key => $arr_shooes_data_value) {
                $str_return .= '- '.' '.'<a href="'.$arr_shooes_data_value['url'].'">'.$arr_shooes_data_value['model'].'</a>'.'('.$arr_shooes_data_value['type'].')，价格：'.$arr_shooes_data_value['price'].'元 '.PHP_EOL;
            }
                $str_return  =  str_replace("[[rec_list]]", $str_return, $str_answer);

        } else {
            $arr_res_list = self::match_price_mile($arr_where, $arr_flag['mile_flag'],  $arr_flag['mile_flag']);

            if ($arr_res_list) {

                foreach ($arr_res_list as  $arr_res_list_value) {
                    $str_return .= '- '.' '.'<a href="'.$arr_res_list_value['url'].'">'.$arr_res_list_value['model'].'</a>'.'('.$arr_res_list_value['type'].')，价格：'.$arr_res_list_value['price'].'元 '.PHP_EOL;
                }

                if (strpos('适合您的鞋包括这些', $str_answer) === false) {
                    return str_replace('适合您的鞋包括这些', '没有匹配到合适的跑鞋，为您推荐以下跑鞋', str_replace("[[rec_list]]", $str_return, $str_answer));
                } else {
                    return str_replace('好的，根据您的资料，为您推荐以下跑步鞋', '没有匹配到合适的跑鞋，为您推荐以下跑鞋', str_replace("[[rec_list]]", $str_return, $str_answer));
                }

            }
            $str_return = "抱歉~，没有找到适合您的跑鞋。";
        }
        return $str_return;
    }

    /**
     * 获取条件
     * @param $value
     * @param $type
     * @return array
     */
    private static function get_constraint_condition($value,$type){

        if($type == 'jiaoxing'){
            $arr_jiaoxing_config = C('JIAOXING');
            $str_jiaoxing = isset($value['value']) ? $value['value'] : '';

            if ($str_jiaoxing) {

                foreach ($arr_jiaoxing_config as $jiaoxing_config_key => $jiaoxing_value) {

                    if (in_array($str_jiaoxing, $jiaoxing_value)) {
                        $str_jiaoxing = $jiaoxing_config_key;
                    }

                }
            }
            return array('where'=>array('like', '%'.$str_jiaoxing.'%'));

        }elseif($type == 'mile'){
            $max_mile = ShoesModel::getMaxMileOrPrice('exercise'); // 最大公里数
            $min_mile = ShoesModel::getMinMileOrPrice('exercise'); // 最小公里数
            $mile = isset($value['value'][0]['value']['amount']) ? $value['value'][0]['value']['amount'] : '';

            if ($mile > $max_mile) {
                $mile = $max_mile;
            } else if($mile < $min_mile) {
                $mile = $min_mile;
            }

            $left_mile = $mile-10;
            $right_mile  = $mile+10;
            $mile_flag = array($left_mile, $right_mile);

            return array('where'=>array(array('gt',$left_mile), array('lt',$right_mile)),'mile_flag'=>$mile_flag);

        }elseif($type == 'price'){

            $max_price =ShoesModel::getMaxMileOrPrice('price');
            $min_price =ShoesModel::getMinMileOrPrice('price');
            $price_flag = array();
            $price_return = array();

            if (isset($value['value'][1])) { // 价格区间查询，如：300到400元
                $left_price  = isset($value['value'][0]['value']['amount']) ? $value['value'][0]['value']['amount'] : '';
                $right_price = isset($value['value'][1]['value']['amount']) ? $value['value'][1]['value']['amount'] : '';

                if ($left_price < $min_price) {
                    $left_price = $min_price;
                } elseif ($right_price > $max_price){
                    $right_price = $max_price;
                } elseif ($left_price > $max_price){
                    $left_price  = intval($max_price*0.7);
                    $right_price = $max_price;
                }
                $price_return = array('between', array($left_price , $right_price));
                $price_flag = array($left_price , $right_price);

            } elseif($type == 'price') { // 价格匹配

                $original = isset($value['value'][0]['original']) ? $value['value'][0]['original'] : '';
                $price = isset($value['value'][0]['value']['amount']) ? $value['value'][0]['value']['amount'] : '';

                if ($price < $min_price) {
                    $price = $min_price;
                } elseif ($price > $max_price){
                    $price = $max_price;
                }

                if ($original == $value['original']) { // 价格查询，如：300元，自定义查询条件
                    $price_flag = array($price, $price);
                    $price_return = array('between', array(intval($price*0.7), intval($price*1.3)));
                } else {                                // 价格查询，如：300元左右，处理方向词
                    $price_str = str_replace($original, '', $value['original']);
                    $price_match = 'gt';
                    $price_arr   = C('PRICE');

                    foreach ($price_arr as $match_key => $match_value) {

                        if (in_array($price_str, $match_value)) {

                            if ($match_key == 'between') {
                                $price_match = 'elt';

                                if ($price > $max_price) {
                                    $price = $max_price;
                                } else {
                                    $price = intval($price*1.3);
                                }

                            } else {
                                $price_match = $match_key;
                            }
                        }
                    }

                    if ($price_match == 'gt') {
                        $price_flag = array($price, $max_price);
                    } else {
                        $price_flag = array($min_price, $price);
                    }
                    $price_return = array($price_match, $price);
                }
                return array('where'=>$price_return,'price_flag'=>$price_flag);

            }


        }elseif($type == 'xingbie'){
            if(isset($value['value'])){
                if($value['value'] == '男'){
                    $sex = 1;
                }else{
                    $sex = 2;
                }
            }else{
                $sex = 1;
            }
            return array('where'=>array('eq',$sex));
        }else{
            return array();
        }
    }

    /**
     * 扩张公里数和价格条件
     * @param $arr_where
     * @param $price_flag
     * @param $mile_flag
     * @return array
     */
    private static function match_price_mile($arr_where, $price_flag, $mile_flag)
    {
        $new_where = $arr_where;
        $res_list = array();

        // 扩张价格条件
        for ($price_expand=0; $price_expand <3; $price_expand++) { 
            $left_price  = $price_flag[0]*(1-$price_expand*0.3);
            $right_price = $price_flag[1]*(1+$price_expand*0.3);

            // 扩张公里条件
            for ($mile_expand=1; $mile_expand <4; $mile_expand++) { 
                $left_mile  = $mile_flag[0] - $mile_expand*10;
                $right_mile = $mile_flag[1] + $mile_expand*10;
                $new_where['price']    = array('between', array($left_price, $right_price));
                $new_where['exercise'] = array('between', array($left_mile, $right_mile));
                $res_list = ShoesModel::getShoesListOrderByPrice($new_where);

                if ($res_list) {
                    return $res_list;
                }
                
            }
        }
        return $res_list;
    }
}