<?php
namespace Home\Controller;
use Think\Controller;

class WallController extends Controller {
    public function index(){
        $coolwb_wxh = C('coolwb_wxh');
        $huati = C('huati');
        $this->assign('coolwb_wxh', $coolwb_wxh);
        $this->assign('huati', $huati);
        $this->display();
    }

    public function api(){
        $lastid = $_REQUEST['lastid'];
        $num = $lastid + 1;
        //$sql1="SELECT * FROM  `msg` order by `mid` desc limit 3";

        $wall = D('wall');
        $account = $wall->where('num = %d', $num)->limit(1)->select();

        for($i = 2; $i < 11; $i++){
            if($account == ''){
                $num = $lastid + $i;
                $account = $wall->where('num = %d', $num)->limit(1)->select();
            } else {
                break;
            }
        }
        $id       = $account[0];
        $fakeid   = $account[2];
        $num      = $account[3];
        $content  = $account[4];
        $nickname = $account[5];
        $avatar   = $account[6];
        $ret      = $account[7];
        if($num){
            @$msg=array(
                'data' => array(
                      array(
                          "id"       =>$id,
                          "fakeid"   =>$fakeid,
                          "num"      =>$num,
                          "content"  =>$content,
                          "nickname" =>$nickname,
                          "avatar"   =>$avatar
                     )
                ),
                ret=>1
            );
            echo $msg=json_encode($msg);
        }else{
            @$msg=array(data=>array(),ret=>0);
            echo $msg=json_encode($msg);
        }
    }
}
