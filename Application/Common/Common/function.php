<?php

/**
 * query API
 * @param  string $token    		应用token
 * @param  string $query       		内容
 * @param  string $session_id     	session_id
 * @return string $responses_result 返回信息         
 */
function query_curl($token, $query, $session_id) {
	$data = array(
        'token' => $token,
        'query' => $query,
        'session_id' => $session_id,
    );
	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, C('YIGE_QUERY'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $responses_result = curl_exec($ch);
    return json_decode($responses_result, true);
}

/**
 * 随机生成session_id
 * @return string $session_id         
 */
function get_session_id($openid,$opt = false) {
	if (S($openid)) {
		return S($openid);
	} else {
		if (function_exists('com_create_guid')) {
	        if ($opt) {
	            return com_create_guid();
	        } else {
	            return trim(com_create_guid(), '{}');
	        }
	    } else {
	        mt_srand((double) microtime() * 10000);
	        $charid = strtoupper(md5(uniqid(rand(), true)));
	        $hyphen = chr(45);
	        $left_curly = $opt ? chr(123) : "";
	        $right_curly = $opt ? chr(125) : "";
	        $session_id = $left_curly
	                . substr($charid, 0, 8) . $hyphen
	                . substr($charid, 8, 4) . $hyphen
	                . substr($charid, 12, 4) . $hyphen
	                . substr($charid, 16, 4) . $hyphen
	                . substr($charid, 20, 12)
	                . $right_curly;
            S($openid, $session_id, 600);
	        return $session_id;
	    }
	}
}

