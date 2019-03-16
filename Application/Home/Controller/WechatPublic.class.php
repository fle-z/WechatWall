<?php
namespace Home\Controller;
use Think\Controller;

class WechatPublicController extends Controller {
    public function test(){
        $user_secret = 'ZjMzRiM2NjNzM5Mz-3909fefe25cc48a';//change to your user_secret
        $sign2 = $_POST['sign2'];
        $url = $_POST['url'];
        $timestamp = $_POST['timestamp'];
        if (md5($url . $user_secret . $timestamp) === $sign2) {
            $data = $_POST['data'];
            //process data
            ...
            //finally, you need to echo data_key
            echo $_POST['data_key'];
        } else {
            //安全校验未通过拒绝响应
        }
    }

}
