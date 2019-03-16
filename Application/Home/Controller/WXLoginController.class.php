<?php
namespace Home\Controller;
use Think\Controller;

class WXLoginController extends Controller{
    private $token; // 公共平台申请时填写的token
	private $account;
	private $password;

	// 缓存的值
	private $webToken; // 登录后每个链接后都要加token
	private $cookie;

	private $lea;

	// 构造函数
	public function __construct() {
        parent::__construct();  //只要是使用了构造函数，都要加这个代码
		// 配置初始化
		$this->account = C('account');
		$this->password = C('password');
		//$this->cookiePath = $config['cookiePath'];
		//$this->webTokenPath = $config['webTokenPath'];

		$this->login =new  \Home\Model\WXLogin();

		// 读取cookie, webToken
		$this->getCookieAndWebToken();
	}

    public function index(){
        //$this->display();
    }

    //模拟登陆就是模仿浏览器向服务器骗取信息。
	public function login() {
		$url = "https://mp.weixin.qq.com/cgi-bin/login?lang=zh_CN";
		$post["username"] = $this->account;
		$post["pwd"] = md5($this->password);
		$post["f"] = "json";
		$re = $this->login->submit($url, $post);
        // var_dump($re);
		// 保存cookie
		$this->cookie = $re['cookie'];
		S('cookie', $this->cookie);

		// 得到token
		$this->getWebToken($re['body']);

		return true;
	}


	private function getWebToken($logonRet) {
		$logonRet = json_decode($logonRet, true);
		$msg = $logonRet["ErrMsg"]; // /cgi-bin/indexpage?t=wxm-index&lang=zh_CN&token=1455899896
		$msgArr = explode("&token=", $msg);
        //var_dump($magArr);
		if(count($msgArr) != 2) {
			return false;
		} else {
			$this->webToken = $msgArr[1];
			S('webToken', $this->webToken);
			return true;
		}
	}

	public function getCookieAndWebToken() {
		$this->cookie = S('cookie');
		$this->webToken = S('webToken');

		// 如果有缓存信息, 则验证下有没有过时, 此时只需要访问一个api即可判断
		if($this->cookie && $this->webToken) {
			echo $url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo?t=ajax-getcontactinfo&lang=zh_CN&token={$this->webToken}&fakeid=";
			$re = $this->login->submit($url, array(), $this->cookie);
            //var_dump($re);
			$result = json_decode($re['body'], 1);

			if(!$result) {
				return $this->login();
			} else {
				return true;
			}
		} else {
			return $this->login();
		}
	}

	public function getUserInfo($fakeId)
	{
		echo $url = "https://mp.weixin.qq.com/cgi-bin/getcontactinfo?t=ajax-getcontactinfo&lang=zh_CN&token=806546875&fakeid=$fakeId";
		$re = $this->login->submit($url, array(), $this->cookie);
        var_dump($re);
		$result = json_decode($re['body'], 1);
		if(!$result) {
			$this->login();
		}
		return $result;
	}


	public function getLatestMsgs($page = 0) {
		// frommsgid是最新一条的msgid
		$frommsgid = 100000000;
		$offset = 50 * $page;
		$url = "https://mp.weixin.qq.com/cgi-bin/message?t=message/list&action=&keyword=&frommsgid=$frommsgid&offset=$offset&count=1&day=7&token={$this->webToken}&lang=zh_CN";
		$re = $this->login->get($url, $this->cookie);

		// echo $re['body'];

		$preg = '/"msg_item":(.*)}\).msg_item/iUs';
		preg_match_all($preg, $re['body'], $arr);
		// return $arr;
		return json_decode($arr[1][0], 1);
	}


	public function getLatestMsgByCreateTimeAndContent($createTime, $content) {
		$lMsgs = $this->getLatestMsgs(0);

		// 最先的数据在前面

		$contentMatchedMsg = array();
		foreach($lMsgs as $msg) {
			// 仅仅时间符合
			if($msg['dateTime'] == $createTime) {
				// 内容+时间都符合
				if($msg['content'] == $content) {
					return $msg;
				}

			// 仅仅是内容符合
			} else if($msg['content'] == $content) {
				$contentMatchedMsg[] = $msg;
			}
		}

		// 最后, 没有匹配到的数据, 内容符合, 而时间不符
		// 返回最新的一条
		if($contentMatchedMsg) {
			return $contentMatchedMsg[0];
		}

		return false;
	}

	//获取用户头像
	public function getPicture($fakeId){
		$dir = "/";
		$url = "https://mp.weixin.qq.com/cgi-bin/getheadimg?token={$this->webToken}&fakeid={$fakeId}";
		$re = $this->login->get($url, $this->cookie);
		file_put_contents($fakeId.'.jpg', $re['body']);   //file_get_content将文件的内容读入到一个字符串中
		return true;
	}
}
