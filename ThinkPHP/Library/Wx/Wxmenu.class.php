<?php
namespace Wx;
/**
 * 菜单管理
 */
class Wxmenu extends Wx{

    /**
     * 创建菜单
     * @param array $menu
     * @return Ambigous <NULL, mixed>
     */
	public function menu_create($menu){
	    if(empty($this->access_token)){
	        $this->checkAuth(C('APP_ID'),C('APP_SECRET'));
	    }
	    $url = Wx::API_URL_PREFIX.Wx::MENU_CREATE_URL."access_token={$this->access_token}";
		$data    = $this->to_json($menu);
		$result = $this->curlPost($url, $data);
		return $result ? json_decode($result) : null;
	}
	
	/**
	 * 获取当前菜单
	 * @return Ambigous <NULL, mixed>
	 */
	public function menu_get(){
	    if(empty($this->access_token)){
	        $this->checkAuth(C('APP_ID'),C('APP_SECRET'));
	    }
	    $url = Wx::API_URL_PREFIX.Wx::MENU_GET_URL."access_token={$this->access_token}";
		$result = $this->curlGet($url);
		return $result ? json_decode($result) : null;
	}
	
	/**
	 * 删除当前菜单
	 * @return Ambigous <NULL, mixed>
	 */
	public function menu_delete(){
	    if(empty($this->access_token)){
	        $this->checkAuth(C('APP_ID'),C('APP_SECRET'));
	    }
	    $url = Wx::API_URL_PREFIX.Wx::MENU_DELETE_URL."access_token={$this->access_token}";
		$result = $this->curlGet($url);
		return $result ? json_decode($result) : null;
	}
}