<?php

namespace Home\Model;

use Think\Model;

/**
 * 鞋型
 */
class ShoesModel extends Model {

    /**
     * 获取鞋子列表
     * @param $where
     * @return string
     */
    public static function getShoesListOrderByPrice($where)
    {
        $model = M('shoes');
        $res = $model->where($where)->order('price')->select();
        return $res ? : "";
    }

    /**
     * 最大公里数
     * @return mixed
     */
    public static function getMaxMileOrPrice($where)
    {
        return  M('shoes')->max($where);
    }

    /**
     * 最小公里数
     * @return mixed
     */
    public static function getMinMileOrPrice($where)
    {
        return  M('shoes')->min('exercise');
    }

}