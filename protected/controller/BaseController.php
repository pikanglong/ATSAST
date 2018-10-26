<?php

class BaseController extends Controller{
	public $layout = "layout.html";
	function init(){
		$this->version_info=array(
			"author"=>"John Zhang",
			"organization"=>"SAST of NJUPT",
			"developer"=>"John Zhang",
			"version"=>"0.2.2 Beta",
			"subversion"=>"201810261652",
		);
		$this->title="";
		// $this->bg="https://1cf.co/searchEngine/img/bg.jpg";
		$this->bg="";
		session_start();
		// error_reporting(0);
		header("Content-type: text/html; charset=utf-8");
		require(APP_DIR.'/protected/include/functions.php');
		$this->islogin=is_login();
		$this->url="";
		if ($this->islogin) {
			$userinfo=getuserinfo(@$_SESSION['OPENID']);
			if(!is_null($userinfo['real_name']) || $userinfo['real_name']==="null") $display=$userinfo['real_name'];
			else $display=$userinfo['name'];
			$userinfo['display_name']=$display;
			$this->userinfo=$userinfo;
        }
		$current_hour=date("H");
		if ($current_hour<6) $this->greeting="凌晨了";
		elseif ($current_hour<11) $this->greeting="早上好";
		else if ($current_hour<13) $this->greeting="中午好";
		else if ($current_hour<18) $this->greeting="下午好";
		else if ($current_hour<22) $this->greeting="晚上好";
		else $this->greeting="深夜了";
	}

    function tips($msg, $url){
        $url = "location.href=\"{$url}\";";
		echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");{$url}}</script></head><body onload=\"sptips()\"></body></html>";
		exit;
    }
    function jump($url, $delay = 0){
        echo "<html><head><meta http-equiv='refresh' content='{$delay};url={$url}'></head><body></body></html>";
        exit;
    }
	
	public static function err404($controller_name, $action_name){
		header("HTTP/1.0 404 Not Found");
		//echo $controller_name."<br>".$action_name;
		//echo "<BR>".arg("username");
		$controlObj = new BaseController;
		$controlObj->display("404/index.html");
		//$controlObj->jump("/");
		exit;
	}
} 