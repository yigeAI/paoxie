<?php

namespace Home\Service;

use Think\Controller;
use \Home\Service\ShoesService;

class RouteService extends Controller
{

    /**
     * 路由
     * @param $responses_result
     * @return mixed
     */
    public static function route($responses_result)
    {

        $str_return_answer = '';
        $str_action_name   = $responses_result['action']['name'];
        $ai_return_answer  = $responses_result['answer'];

        if (isset($str_action_name) && $str_action_name) {
            switch ($str_action_name) {

                // 脚型介绍
                case 'get_jiaoxing_intr_link':
                    $str_return_answer = ShoesService::get_foot_type_intr_link($ai_return_answer);
                    break;

                // 匹配鞋型
                case 'find_shoe_type':

                    if ($responses_result['action']['complete']) {
                        $str_return_answer = ShoesService::match_shoe_type($responses_result);
                    } else {

                        if (strpos($ai_return_answer, '[[link]]') === false) {
                            $str_return_answer = $ai_return_answer;
                        } else {
                            $str_return_answer = str_replace('[[link]]', C('JIAOXING_URL'), $ai_return_answer);
                        }
                    }
                    break;

                // 确认信息
                case 'find_shoes':
                    $str_return_answer = ShoesService::foot_type_confirmation_message($responses_result);
                    break;

                // 默认
                default:
                    $str_return_answer = $ai_return_answer;
                    break;
            }
        }
        return $str_return_answer ? : $ai_return_answer;
    }
}