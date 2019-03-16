<?php
namespace Home\Controller;
use Think\Controller;

class AdminController extends Controller{
    function __initialize(){
        header("Content-type:text/html;charset=utf-8");
    }

    public function index(){
        $this->display();
    }

    public function login(){
        if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
        	$str='<script language="javascript" type="text/javascript">
            setTimeout("javascript:location.href="index.html"", 2000);
            </script>';
            echo $str;
        }
        $this->display();
    }//login end

    public function doLogin(){
        $posts = I('post.');
        foreach ($posts as $k => $v){
        	$posts[$k] = trim($v);
        }
        $pwd = $posts["userpwd"];
        $username = $posts["username"];

        $admin = D('admin');
        $userinfo = $admin->where('user = "%s" and pwd = "%s"', $username, $pwd)->select();
        //var_dump($userinfo);
        if(!empty($userinfo)){
        	session_start();
        	$_SESSION['admin'] = true;
        	$str='<script language="javascript" type="text/javascript">
            setTimeout("javascript:location.href="index.html"", 1);
            </script>';
            echo $str;
        } else {
            echo "用户或密码错误";
            echo '<a href="login.html">点击这里返回</a>';
            $str='<script language="javascript" type="text/javascript">
            setTimeout("javascript:location.href="login.html"", 3000);
            </script>';
            echo $str;
         }
    }//doLogin end

    public function shenhe(){
        if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
            $wall = D('wall');
            $count = $wall->where('ret = 0 and id > 1')->count();//待审核的记录的条数
            $this -> assign('count', $count);
            $data = $wall->where('ret = 0 and id > 1')->getField('num', 'nickname', 'content');
            $this->assign('data', $data);

            $count0 = $wall->where('ret = 1')->count();//已经审核的记录的条数
            $this -> assign('count0', $count0);
            $data0 = $wall->where('ret = 1')->getField('num', 'nickname', 'content');
            $this->assign('data0', $data0);

            $this->display();
         } else {
             $_SESSION['admin'] = false;
             $str="你还没登陆，无权访问";
             $str.='<a href="login.html">点击这里返回</a>';
             $str.='<script language="javascript" type="text/javascript">
             setTimeout("javascript:location.href="login.html"", 3000);
             </script>';
             die($str);
         }
   }//shenhe end

   public function doShenhe(){
       if(isset($_GET['do'])){
        	$do = $_GET['do'];
        	$cid = $_GET['cid'];
        }else{
        	die("invild action");
        }

        switch($do){
        	case "del":
        		DoDelete();
                $cid = $_GET['cid'];
                $wall = D('wall');
                $wall->where('id = '.$cid)->delete();
                echo "<script>location.href='shenhe.html';</script>";
        		break;

        	case "shenhe":
                $cid = $_GET['cid'];
                $wall_num = D('wall_num');
                $account = $wall_num->select();
                $num = $account[0];
                $wall = D('wall');
                $data['ret'] = 1;
                $data['num'] = $num;
                $data['status'] = '0';
                $wall->where('id = '.$cid)->save($data);
                $wall_num->setInc('num', 1);
                echo "<script>location.href='shenhe.html';</script>";
         		break;

          	case "del_all":
                mysql_query("TRUNCATE TABLE weixin_wall");
                mysql_query("UPDATE `weixin_wall_num` SET `num` = 1");
                echo "<script>alert('操作成功，你的微信墙已经焕然一新哦！');location.href='shenhe.html';</script>";
         		break;
        }
   }//deShenhe end

   public function toupiao(){
       if(isset($_SESSION['admin']) && $_SESSION['admin']=== true){
        	echo "你已经成功登陆";
            $this->display();
        } else {
            $_SESSION['admin'] = false;
            $str="你还没登陆，无权访问";
            $str.='<a href="index.php">点击这里返回</a>';
            $str.='<script language="javascript" type="text/javascript">
            setTimeout("javascript:location.href="index.php"", 3000);
            </script>';
            die($str);
        }
   }//toupiao end
}
