<?php
namespace Wx;
/**
 * 微信接口基类
 * @author admin
 */
class Wx{
	const MSGTYPE_TEXT = 'text';
	const MSGTYPE_IMAGE = 'image';
	const MSGTYPE_LOCATION = 'location';
	const MSGTYPE_LINK = 'link';
	const MSGTYPE_EVENT = 'event';
	const MSGTYPE_MUSIC = 'music';
	const MSGTYPE_NEWS = 'news';
	const MSGTYPE_VOICE = 'voice';
	const MSGTYPE_VIDEO = 'video';
	const EVENT_SUBSCRIBE = 'subscribe';       //订阅
	const EVENT_UNSUBSCRIBE = 'unsubscribe';   //取消订阅
	const EVENT_SCAN = 'SCAN';                 //扫描带参数二维码
	const EVENT_LOCATION = 'LOCATION';         //上报地理位置
	const EVENT_MENU_VIEW = 'VIEW';                     //菜单 - 点击菜单跳转链接
	const EVENT_MENU_CLICK = 'CLICK';                   //菜单 - 点击菜单拉取消息
	const EVENT_MENU_SCAN_PUSH = 'scancode_push';       //菜单 - 扫码推事件(客户端跳URL)
	const EVENT_MENU_SCAN_WAITMSG = 'scancode_waitmsg'; //菜单 - 扫码推事件(客户端不跳URL)
	const EVENT_MENU_PIC_SYS = 'pic_sysphoto';          //菜单 - 弹出系统拍照发图
	const EVENT_MENU_PIC_PHOTO = 'pic_photo_or_album';  //菜单 - 弹出拍照或者相册发图
	const EVENT_MENU_PIC_WEIXIN = 'pic_weixin';         //菜单 - 弹出微信相册发图器
	const EVENT_MENU_LOCATION = 'location_select';      //菜单 - 弹出地理位置选择器
	const EVENT_SEND_MASS = 'MASSSENDJOBFINISH';        //发送结果 - 高级群发完成
	const EVENT_SEND_TEMPLATE = 'TEMPLATESENDJOBFINISH';//发送结果 - 模板消息发送结果
	const EVENT_KF_SEESION_CREATE = 'kfcreatesession';  //多客服 - 接入会话
	const EVENT_KF_SEESION_CLOSE = 'kfclosesession';    //多客服 - 关闭会话
	const EVENT_KF_SEESION_SWITCH = 'kfswitchsession';  //多客服 - 转接会话
	const EVENT_CARD_PASS = 'card_pass_check';          //卡券 - 审核通过
	const EVENT_CARD_NOTPASS = 'card_not_pass_check';   //卡券 - 审核未通过
	const EVENT_CARD_USER_GET = 'user_get_card';        //卡券 - 用户领取卡券
	const EVENT_CARD_USER_DEL = 'user_del_card';        //卡券 - 用户删除卡券
	const API_URL_PREFIX = 'https://api.weixin.qq.com/cgi-bin';
	const AUTH_URL = '/token?grant_type=client_credential&';
	const MENU_CREATE_URL = '/menu/create?';
	const MENU_GET_URL = '/menu/get?';
	const MENU_DELETE_URL = '/menu/delete?';
	const GET_TICKET_URL = '/ticket/getticket?';
	const CALLBACKSERVER_GET_URL = '/getcallbackip?';
	const QRCODE_CREATE_URL='/qrcode/create?';
	const QR_SCENE = 0;
	const QR_LIMIT_SCENE = 1;
	const QRCODE_IMG_URL='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=';
	const SHORT_URL='/shorturl?';
	const USER_GET_URL='/user/get?';
	const USER_INFO_URL='/user/info?';
	const USER_UPDATEREMARK_URL='/user/info/updateremark?';
	const GROUP_GET_URL='/groups/get?';
	const USER_GROUP_URL='/groups/getid?';
	const GROUP_CREATE_URL='/groups/create?';
	const GROUP_UPDATE_URL='/groups/update?';
	const GROUP_MEMBER_UPDATE_URL='/groups/members/update?';
	const GROUP_MEMBER_BATCHUPDATE_URL='/groups/members/batchupdate?';
	const CUSTOM_SEND_URL='/message/custom/send?';
	const MEDIA_UPLOADNEWS_URL = '/media/uploadnews?';
	const MASS_SEND_URL = '/message/mass/send?';
	const TEMPLATE_SET_INDUSTRY_URL = '/message/template/api_set_industry?';
	const TEMPLATE_ADD_TPL_URL = '/message/template/api_add_template?';
	const TEMPLATE_SEND_URL = '/message/template/send?';
	const MASS_SEND_GROUP_URL = '/message/mass/sendall?';
	const MASS_DELETE_URL = '/message/mass/delete?';
	const MASS_PREVIEW_URL = '/message/mass/preview?';
	const MASS_QUERY_URL = '/message/mass/get?';
	const UPLOAD_MEDIA_URL = 'http://file.api.weixin.qq.com/cgi-bin';
	const MEDIA_UPLOAD_URL = '/media/upload?';
	const MEDIA_GET_URL = '/media/get?';
	const MEDIA_VIDEO_UPLOAD = '/media/uploadvideo?';
	const MEDIA_FOREVER_UPLOAD_URL = '/material/add_material?';
	const MEDIA_FOREVER_NEWS_UPLOAD_URL = '/material/add_news?';
	const MEDIA_FOREVER_NEWS_UPDATE_URL = '/material/update_news?';
	const MEDIA_FOREVER_GET_URL = '/material/get_material?';
	const MEDIA_FOREVER_DEL_URL = '/material/del_material?';
	const MEDIA_FOREVER_COUNT_URL = '/material/get_materialcount?';
	const MEDIA_FOREVER_BATCHGET_URL = '/material/batchget_material?';
	const OAUTH_PREFIX = 'https://open.weixin.qq.com/connect/oauth2';
	const OAUTH_AUTHORIZE_URL = '/authorize?';
	///多客服相关地址
	const CUSTOM_SERVICE_GET_RECORD = '/customservice/getrecord?';
	const CUSTOM_SERVICE_GET_KFLIST = '/customservice/getkflist?';
	const CUSTOM_SERVICE_GET_ONLINEKFLIST = '/customservice/getonlinekflist?';
	const API_BASE_URL_PREFIX = 'https://api.weixin.qq.com'; //以下API接口URL需要使用此前缀
	const OAUTH_TOKEN_URL = '/sns/oauth2/access_token?';
	const OAUTH_REFRESH_URL = '/sns/oauth2/refresh_token?';
	const OAUTH_USERINFO_URL = '/sns/userinfo?';
	const OAUTH_AUTH_URL = '/sns/auth?';
	///多客服相关地址
	const CUSTOM_SESSION_CREATE = '/customservice/kfsession/create?';
	const CUSTOM_SESSION_CLOSE = '/customservice/kfsession/close?';
	const CUSTOM_SESSION_SWITCH = '/customservice/kfsession/switch?';
	const CUSTOM_SESSION_GET = '/customservice/kfsession/getsession?';
	const CUSTOM_SESSION_GET_LIST = '/customservice/kfsession/getsessionlist?';
	const CUSTOM_SESSION_GET_WAIT = '/customservice/kfsession/getwaitcase?';
	const CS_KF_ACCOUNT_ADD_URL = '/customservice/kfaccount/add?';
	const CS_KF_ACCOUNT_UPDATE_URL = '/customservice/kfaccount/update?';
	const CS_KF_ACCOUNT_DEL_URL = '/customservice/kfaccount/del?';
	const CS_KF_ACCOUNT_UPLOAD_HEADIMG_URL = '/customservice/kfaccount/uploadheadimg?';
	///卡券相关地址
	const CARD_CREATE                     = '/card/create?';
	const CARD_DELETE                     = '/card/delete?';
	const CARD_UPDATE                     = '/card/update?';
	const CARD_GET                        = '/card/get?';
	const CARD_BATCHGET                   = '/card/batchget?';
	const CARD_MODIFY_STOCK               = '/card/modifystock?';
	const CARD_LOCATION_BATCHADD          = '/card/location/batchadd?';
	const CARD_LOCATION_BATCHGET          = '/card/location/batchget?';
	const CARD_GETCOLORS                  = '/card/getcolors?';
	const CARD_QRCODE_CREATE              = '/card/qrcode/create?';
	const CARD_CODE_CONSUME               = '/card/code/consume?';
	const CARD_CODE_DECRYPT               = '/card/code/decrypt?';
	const CARD_CODE_GET                   = '/card/code/get?';
	const CARD_CODE_UPDATE                = '/card/code/update?';
	const CARD_CODE_UNAVAILABLE           = '/card/code/unavailable?';
	const CARD_TESTWHILELIST_SET          = '/card/testwhitelist/set?';
	const CARD_MEMBERCARD_ACTIVATE        = '/card/membercard/activate?';      //激活会员卡
	const CARD_MEMBERCARD_UPDATEUSER      = '/card/membercard/updateuser?';    //更新会员卡
	const CARD_MOVIETICKET_UPDATEUSER     = '/card/movieticket/updateuser?';   //更新电影票(未加方法)
	const CARD_BOARDINGPASS_CHECKIN       = '/card/boardingpass/checkin?';     //飞机票-在线选座(未加方法)
	const CARD_LUCKYMONEY_UPDATE          = '/card/luckymoney/updateuserbalance?';     //更新红包金额
	const SEMANTIC_API_URL = '/semantic/semproxy/search?'; //语义理解
	///数据分析接口
	static $DATACUBE_URL_ARR = array(        //用户分析
		'user' => array(
			'summary' => '/datacube/getusersummary?',		//获取用户增减数据（getusersummary）
			'cumulate' => '/datacube/getusercumulate?',		//获取累计用户数据（getusercumulate）
		),
		'article' => array(            //图文分析
			'summary' => '/datacube/getarticlesummary?',		//获取图文群发每日数据（getarticlesummary）
			'total' => '/datacube/getarticletotal?',		//获取图文群发总数据（getarticletotal）
			'read' => '/datacube/getuserread?',			//获取图文统计数据（getuserread）
			'readhour' => '/datacube/getuserreadhour?',		//获取图文统计分时数据（getuserreadhour）
			'share' => '/datacube/getusershare?',			//获取图文分享转发数据（getusershare）
			'sharehour' => '/datacube/getusersharehour?',		//获取图文分享转发分时数据（getusersharehour）
		),
		'upstreammsg' => array(        //消息分析
			'summary' => '/datacube/getupstreammsg?',		//获取消息发送概况数据（getupstreammsg）
			'hour' => '/datacube/getupstreammsghour?',	//获取消息分送分时数据（getupstreammsghour）
			'week' => '/datacube/getupstreammsgweek?',	//获取消息发送周数据（getupstreammsgweek）
			'month' => '/datacube/getupstreammsgmonth?',	//获取消息发送月数据（getupstreammsgmonth）
			'dist' => '/datacube/getupstreammsgdist?',	//获取消息发送分布数据（getupstreammsgdist）
			'distweek' => '/datacube/getupstreammsgdistweek?',	//获取消息发送分布周数据（getupstreammsgdistweek）
			'distmonth' => '/datacube/getupstreammsgdistmonth?',	//获取消息发送分布月数据（getupstreammsgdistmonth）
		),
		'interface' => array(        //接口分析
			'summary' => '/datacube/getinterfacesummary?',	//获取接口分析数据（getinterfacesummary）
			'summaryhour' => '/datacube/getinterfacesummaryhour?',	//获取接口分析分时数据（getinterfacesummaryhour）
		)
	);
	///微信摇一摇周边
	const SHAKEAROUND_DEVICE_APPLYID = '/shakearound/device/applyid?';//申请设备ID
	const SHAKEAROUND_DEVICE_UPDATE = '/shakearound/device/update?';//编辑设备信息
	const SHAKEAROUND_DEVICE_SEARCH = '/shakearound/device/search?';//查询设备列表
	const SHAKEAROUND_DEVICE_BINDLOCATION = '/shakearound/device/bindlocation?';//配置设备与门店ID的关系
	const SHAKEAROUND_DEVICE_BINDPAGE = '/shakearound/device/bindpage?';//配置设备与页面的绑定关系
	const SHAKEAROUND_MATERIAL_ADD = '/shakearound/material/add?';//上传摇一摇图片素材
	const SHAKEAROUND_PAGE_ADD = '/shakearound/page/add?';//增加页面
	const SHAKEAROUND_PAGE_UPDATE = '/shakearound/page/update?';//编辑页面
	const SHAKEAROUND_PAGE_SEARCH = '/shakearound/page/search?';//查询页面列表
	const SHAKEAROUND_PAGE_DELETE = '/shakearound/page/delete?';//删除页面
	const SHAKEAROUND_USER_GETSHAKEINFO = '/shakearound/user/getshakeinfo?';//获取摇周边的设备及用户信息
	const SHAKEAROUND_STATISTICS_DEVICE = '/shakearound/statistics/device?';//以设备为维度的数据统计接口
	const SHAKEAROUND_STATISTICS_PAGE = '/shakearound/statistics/page?';//以页面为维度的数据统计接口

	protected $token;
	protected $encodingAesKey;
	protected $encrypt_type;
	protected $appid;
	protected $appsecret;
	protected $access_token;
	protected $jsapi_ticket;
	protected $user_token;
	protected $partnerid;
	protected $partnerkey;
	protected $paysignkey;
	protected $postxml;
	protected $_msg;
	protected $_funcflag = false;
	protected $_receive;
	protected $_text_filter = true;
	public $debug =  false;
	public $errCode = 40001;
	public $errMsg = "no access";
	public $logcallback;

	protected function to_json($array) {
		return urldecode(json_encode($this->arr_urlencode($array)));
	}

	protected function arr_urlencode($array){
		$newArr = array();
		foreach ( $array as $key => $value ) {
			if(is_array($value)){
				$newArr[$key] = $this->arr_urlencode($value);
			}else{
				$newArr[$key] = urlencode($value);
			}
		}
		return $newArr;
	}

	/**
	 * 获取access_token
	 * @param string $appid
	 * @param string $appsecret
	 * @param string $token
	 * @return Ambigous <mixed, string, unknown>|boolean
	 */
	public function checkAuth($appid='',$appsecret='',$token=''){
		if (!$appid || !$appsecret) {
			$appid =C('APP_ID');
			$appsecret =C('APP_SECRET');;
		}
		if ($token) { //手动指定token，优先使用
			$this->access_token=$token;
			return $this->access_token;
		}
		$authname = 'wechat_access_token'.$appid;
		if (S($authname))  {
			$this->access_token = S($authname);
			return $this->access_token;
		}
		$url = self::API_URL_PREFIX.self::AUTH_URL.'appid='.$appid.'&secret='.$appsecret;
		$result = $this->curlGet($url);
		if ($result){
			$json = json_decode($result,true);
			if (!$json || isset($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			$this->access_token = $json['access_token'];
			$expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
			S($authname,$this->access_token,$expire);
			return $this->access_token;
		}
		return false;
	}

	/**
	 * 获取JSAPI授权TICKET
	 * @param string $appid 用于多个appid时使用,可空
	 * @param string $jsapi_ticket 手动指定jsapi_ticket，非必要情况不建议用
	 */
	public function getJsTicket($appid='',$jsapi_ticket=''){
		if (!$this->access_token && !$this->checkAuth()) return false;
		if (empty($appid)) $appid =C('APP_ID');
		if ($jsapi_ticket) { //手动指定token，优先使用
			$this->jsapi_ticket = $jsapi_ticket;
			return $this->jsapi_ticket;
		}
		$authname = 'wechat_jsapi_ticket'.$appid;
		if (S($authname))  {
			$this->jsapi_ticket = S($authname);
			return $this->jsapi_ticket;
		}
		$result = $this->curlGet(self::API_URL_PREFIX.self::GET_TICKET_URL.'access_token='.$this->access_token.'&type=jsapi');
		if ($result){
			$json = json_decode($result,true);
			if (!$json || !empty($json['errcode'])) {
				$this->errCode = $json['errcode'];
				$this->errMsg = $json['errmsg'];
				return false;
			}
			$this->jsapi_ticket = $json['ticket'];
			$expire = $json['expires_in'] ? intval($json['expires_in'])-100 : 3600;
			S($authname,$this->jsapi_ticket,$expire);
			return $this->jsapi_ticket;
		}
		return false;
	}

	/**
	 * 获取JsApi使用签名
	 * @param string $url 网页的URL，自动处理#及其后面部分
	 * @param string $timestamp 当前时间戳 (为空则自动生成)
	 * @param string $noncestr 随机串 (为空则自动生成)
	 * @param string $appid 用于多个appid时使用,可空
	 * @return array|bool 返回签名字串
	 */
	public function getJsSign($url, $timestamp=0, $noncestr='', $appid=''){
		if (!$this->jsapi_ticket && !$this->getJsTicket($appid) || !$url) return false;
		if (!$timestamp)
			$timestamp = time();
		if (!$noncestr)
			$noncestr = $this->generateNonceStr();
		$ret = strpos($url,'#');
		if ($ret)
			$url = substr($url,0,$ret);
		$url = trim($url);
		if (empty($url))
			return false;
		$arrdata = array("timestamp" => $timestamp, "noncestr" => $noncestr, "url" => $url, "jsapi_ticket" => $this->jsapi_ticket);
		$sign = $this->getSignature($arrdata);
		if (!$sign)
			return false;
		$signPackage = array(
			"appid"     => C('APP_ID'),
			"noncestr"  => $noncestr,
			"timestamp" => $timestamp,
			"url"       => $url,
			"signature" => $sign
		);
		return $signPackage;
	}

	/**
	 * 获取签名
	 * @param array $arrdata 签名数组
	 * @param string $method 签名方法
	 * @return boolean|string 签名值
	 */
	public function getSignature($arrdata,$method="sha1") {
		if (!function_exists($method)) return false;
		ksort($arrdata);
		$paramstring = "";
		foreach($arrdata as $key => $value){
			if(strlen($paramstring) == 0)
				$paramstring .= $key . "=" . $value;
			else
				$paramstring .= "&" . $key . "=" . $value;
		}
		$Sign = $method($paramstring);
		return $Sign;
	}

	/**
	 * 生成随机字串
	 * @param number $length 长度，默认为16，最长为32字节
	 * @return string
	 */
	public function generateNonceStr($length=16){
		// 密码字符集，可任意添加你需要的字符
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$str = "";
		for($i = 0; $i < $length; $i++){
			$str .= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $str;
	}

	/**
	 * POST方式请求
	 * @param string $url:访问的接口
	 * @param $send_data:传送的数据
	 */
	public function curlPost($url,$send_data) {
		$header = "Accept-Charset: utf-8";
		$useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0';
		$ch = curl_init(); //启动一个curl会话
		curl_setopt($ch, CURLOPT_URL, $url); //要访问的地址
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header); //设置HTTP头字段的数组
		curl_setopt($ch, CURLOPT_USERAGENT, $useragent); //模拟用户使用的浏览器
		curl_setopt($ch, CURLOPT_TIMEOUT, 30); //设置超时限制防止死循环
		curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data); //Post提交的数据包
		curl_setopt($ch, CURLOPT_HEADER, 0); //显示返回的Header区域内容
		curl_setopt($ch, CURLOPT_POST, 1); //发送一个常规的Post请求
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$result = curl_exec($ch); //执行一个curl会话
		curl_close($curl); //关闭curl
		return $result;
	}

	/**
	 * 以GET方式访问接口
	 * @param string $url
	 */
	public function curlGet($url){
		$ch = curl_init();
		$header = "Accept-Charset: utf-8";
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$temp = curl_exec($ch);
		return $temp;
	}
}
?>