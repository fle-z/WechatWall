<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>微信墙后台</title>
<meta name="description" content="微信墙后台">
<meta name="keywords" content="微信墙后台">
<link rel="stylesheet" href="/WechatWall/Public/static/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/WechatWall/Public/static/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/WechatWall/Public/static/css/invalid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/WechatWall/Public/static/css/main.css" type="text/css" media="screen" />
<script type="text/javascript" src="/WechatWall/Public/static/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/facebox.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/jquery.datePicker.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/jquery.date.js"></script>
<script type="text/javascript" src="/WechatWall/Public/static/js/faceboxpage.js"></script>
</head>
<body>
<style>
.content-box{ width:823px;}
</style>
<body id="login">
<div id="login-wrapper" class="png_bg">
  <div id="login-top">
    <h1>Simpla Admin</h1>
    <!-- Logo (221px width) -->
    <a href="#"><img id="logo" src="/WechatWall/Public/static/image/logo.png" alt="Simpla Admin logo" /></a> </div>
  <!-- End #logn-top -->
  <div id="login-content">
    <form action="doLogin" method="post" enctype="multipart/form-data" style="bottom:0; top:50%; position:absolute; z-index:100000; text-align:center; height:100%;">
	  <p>
        <label>用户名</label>
        <input class="text-input" name="username" type="text" />
      </p>
      <div class="clear"></div>
      <p>
        <label>密码</label>
        <input class="text-input" name="userpwd" type="password" />
      </p>
      <div class="clear"></div>

        <input class="button" type="submit" value="登录" />
      </p>
	  </form>
   </div>
  <!-- End #login-content -->
</div>

</body>
</html>