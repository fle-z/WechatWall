<?php
namespace Home\Controller;
use Think\Controller;

class WechatController extends Controller{
    function __initialize(){
        header("Content-type:text/html;charset=utf-8");
    }

    public function __construct(){
        $token = C('token');
        $debug = true;
        $w = new \Home\Model\WechatModel($token, $debug);
        if (isset($_GET['echostr'])){
            $w->valid();
            exit();
        }

        //回复用户
        $w->reply("reply_cb");
        exit();
    }

    //消息回复主函数
    function reply_cb($request, $w){
        $to = $request['ToUserName'];
        $from = $request['FromUserName'];
    	$time = $w->get_creattime();
        if ($w->get_msg_type() == "location") //发送位置接口
    	{
    		$lacation = "x@".(string)$request['Location_X']."@".(string)$request['Location_Y'];
    		$lacation = urlencode(str_replace('\.','\\\.',$lacation));
    		$lacation = urldecode(xiaojo($lacation,$from,$to));
    		return  $lacation;
        }
        else if ($w->get_msg_type() == "image"){    //返回图片地址
    		$PicUrl = $request['PicUrl'];
    		$pic = urldecode(xiaojo("&".$PicUrl,$from,$to));
    		//$w->set_funcflag();
    		return $pic;
        }
    	else if ($w->get_msg_type() == "voice"){   //用户发语音时回复语音或音乐,请在此配置默认语音回复
    		return array(
    			"title" =>  "你好",
    			"description" =>  "亲爱的主人",
    			"murl" =>  "http://weixen-file.stor.sinaapp.com/b/xiaojo.mp3",//语音地址，建议自定义一个语音
    			"hqurl" =>  "http://weixen-file.stor.sinaapp.com/b/xiaojo.mp3",
    		);
        }
    	else if ($w->get_msg_type() == "event"){   //事件检测
    		if ($w->get_event_type() == "subscribe"){ //首次关注回复请在后台设置关键词为 "subscribe" 的图文、文本或语音规则
                $data = array(
                    'openid'   => $from,
                    'flag'     => -1,
                    'vote'     => 1,
                    'nickname' => $nicheng
                );
                $flag = D('flag');
                $sql_flag = $flag->add($data, $replace=true);
    			return media(urldecode( MOREN));
    		}else if($w->get_event_type() == "unsubscribe"){
                $data = array(
                    'openid'   => $from,
                    'flag'     => -1,
                    'vote'     => 1,
                    'nickname' => $nicheng
                );
                $flag = D('flag');
                $sql_flag = $flag->add($data, $replace=true);
    			$unsub = media(urldecode( MOREN));
    			return $unsub;
    		} else if ($w->get_event_type() == "click"){
    			$menukey = $w->get_event_key();
    			$menu = xiaojo($menukey,$from,$to);
    			return $menu;
    		} else {
    			$menukey = $w->get_event_key();
    			return $menukey;
    		}
        }
        $content = trim($request['Content']);
       	$firsttime = $content;
    	if ($content !== ""){   //发纯文本
            //$w->set_funcflag(); //如果有必要的话，加星标，方便在web处理
    		$content = $w->biaoqing($content); //表情处理
    		if(strstr($content,C('FLAG'))){    //该函数的作用是在第一个参数中找出第二个参数的位置，取出他后面的字符串
    			$w->set_funcflag();  //如果有星标的标记则设为星标(用于留言)
    		}

            /*话题判断函数开始*/
            function startsWith($haystack,$needle,$case=false) {
                if($case){  //判断是否对大小写敏感
                    return (strcmp(substr($haystack, 0, strlen($needle)),$needle)===0);
                }else{
                    return (strcasecmp(substr($haystack, 0, strlen($needle)),$needle)===0);
                }
            }
            /*话题判断函数结束*/

            if(startsWith($content, $huati)){
                $login = A('Login');
                $flag = D('flag');
                $sql_name = $flag->where("openid = '%s'", $from)->setField('nickname', $nicheng);
                $reply = "title|发送成功#pic|#url|".C('$weixin_wxq')."@title|你已经成功发送，审核通过即可上墙！PS:点击我，查看微信墙！";
            }

            $reply = media(urldecode( $reply));
        	return  $reply;

        }
    	else{
    		return  C('MOREN');
    	}

    }//reply_cb end

    //审核微信留言内容，判断是否可以上墙
    function test(){

        $weiXin = new WXLogin($G_CONFIG['weiXin']);

        $lastMsg = $weiXin->getLatestMsgs();
        print_r($lastMsg);
        $file = $lastMsg[0]['fakeid'].'.jpg';
        if (is_readable($file) == false) {
            $weiXin->getPicture($lastMsg[0]['fakeid']);
        }
        if($lastMsg[0][type] == '1'){
            $messageid = $lastMsg[0]['id'];
            $fakeid = $lastMsg[0]['fakeid'];
            $nicheng = $lastMsg[0]['nick_name'];
            $content = $lastMsg[0]['content'];
            $nicheng = strip_tags($nicheng);    //跳过HTML和PHP的标签
            $content = strip_tags($content);
            $content = @str_replace(array('"','\'','゛','&nbsp;'), array('','','',''), $content);
            $nicheng = @str_replace(array('"','\'','゛','&nbsp;'), array('','','',''), $nicheng);

            $imgurl = Web_ROOT.'/moni/'.$fakeid.'.jpg';

            $wall = D('wall');
            $row = $wall->where('fakeid = "%s"', $fakeid)->select();

            $data = array(
                'messageid' => $messageid,
                'fakeid'    => $fakeid,
                'num'       => -1,
                'content'   => $content,
                'nickname'  => $nickname,
                'avatar'    => $imgurl,
                'ret'       => 0,
                'status'    => 0
            );
            $wall->add($data);
        }
    }

}
