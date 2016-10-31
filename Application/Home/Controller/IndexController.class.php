<?php

namespace Home\Controller;

use Think\Controller;
use Wx\Wechat;
use \Home\Service\RouteService;

class IndexController extends Controller
{

    public function index()
    {

        // 微信后台填写的TOKEN
        $str_token = C('TOKEN');
        // 加载微信SDK
        $obj_wechat = new Wechat($str_token);
        // 获取请求信息
        $arr_request = $obj_wechat->request();
        // 获取openid
        $str_openid = $arr_request['FromUserName'];
        // 获取会话session_id
        $str_session_id = get_session_id($str_openid);
        // 定义回复消息的类型
        $msg_type = $obj_wechat::MSG_TYPE_TEXT;
        // 获取用户输入（语音）的内容
        $str_query = isset($request['Recognition']) ? $request['Recognition'] : $arr_request['Content'];
        //请求返回
        $arr_responses = query_curl(C('AI_TOKEN.PAOXIE'), $str_query, $str_session_id);

     //   $obj_wechat->response(json_encode($arr_responses).'***'.$str_session_id, $msg_type);
        //返回结果
        $obj_wechat->response(RouteService::route($arr_responses), $msg_type);
    }
}
