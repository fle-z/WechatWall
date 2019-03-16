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
        .content-box {
            width: 823px;
        }
    </style>
    <style>
        .content-box {
            width: 900px;
        }
    </style>
    <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2::53" alt="点击这里给我发消息" title="点击这里给我发消息" /></a>
<div id="body-wrapper">
    <!-- Wrapper for the radial gradient background -->
    <div id="sidebar">
        <div id="sidebar-wrapper">
            <!--网站信息-->
            <!-- Sidebar with logo and menu -->
            <h1 id="sidebar-title"><a href="#">Simpla Admin</a></h1>
            <!-- Logo (221px wide) -->
            <a href="#"><img id="logo" src="/WechatWall/Public/static/image/nlogo.png" weight=10px height=45px alt="" /></a>
            <!-- Sidebar Profile links -->
            <div id="profile-links"> biubiubiu~<br />
                <br />
                <a href="../Wall/index.html" title="前台首页" target="_blank"><b>前台首页</b></a> &nbsp|&nbsp<a href="index.html" title="后台">后台首页</a>&nbsp|&nbsp<a href="logout" title="退出">退出</a></div>
            <ul id="main-nav">
                <!-- Accordion Menu -->
                <li>
                    <a href="#" class="nav-top-item" id="up">
                        <!-- Add the class "current" to current menu item -->
                        上墙 </a>
                    <ul>
                        <li><a href="shenhe" id="shenhe">审核</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-top-item" id="up">
                        <!-- Add the class "current" to current menu item -->
                        高级 </a>
                    <ul>
                        <li><a href="toupiao" id="shenhe">系统设置</a></li>
                    </ul>
                </li>


            </ul>
            <!-- End #main-nav -->

            <!-- End #messages -->
        </div>
    </div>
    <!-- End #sidebar -->
    <div id="main-content">

        <noscript>
    <div class="notification error png_bg">
      <div> 您当前使用的浏览器禁止了网页中的JavaScript代码，这些代码将为您呈现更好的用户体验，请您 <a href="http://www.google.com/support/bin/answer.py?answer=23852" title="点击升级浏览器">升级浏览器</a> 以便JavaScript能在网页中正常运行.

      </div>
    </div>
    </noscript>
        <!-- Page Head -->
        <h2>审核</h2>
        <p id="page-intro">微信墙上墙功能审核后台</p>

        <ul class="shortcut-buttons-set">
            <li><a class="shortcut-button" href="shenhe"><span> <img src="/WechatWall/Public/static/image/icons/pencil_48.png" alt="icon" /><br />
        上墙审核管理 </span></a></li>
            <li><a class="shortcut-button" href="toupiao"><span> <img src="/WechatWall/Public/static/image/icons/clock_48.png" alt="icon" /><br />
        高级设置 </span></a></li>
        </ul>
        <!-- End .shortcut-buttons-set -->
        <div class="clear"></div>
        <!-- End .clear -->

    <div class="content-box">
        <!-- Start Content Box -->
        <div class="content-box-header">
            <h3>微信墙后台主页</h3>
            <ul class="content-box-tabs">
                <li><a href="#tab1" class="default-tab">关于微信墙</a></li>
                <!-- href must be unique and match the id of target div -->
                <li><a href="#tab2">关于我们</a></li>
            </ul>
            <div class="clear"></div>

            <ul class="content-box-tabs">

            </ul>
            <div class="clear"></div>
        </div>
        <!-- End .content-box-header -->
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <div class="AboutR">
                    <!--div class="AboutRT">到微信公众平台设置接口</div-->
                    <div class="AboutRB">
                        <p><span style="color:#009900; font-size:3em">为什么使用微信墙？</span></p>
                        <p style="font-size:1.2em">1、不需要向微信官方申请，可以直接自由使用；
                            <p style="font-size:1.2em">2、具有较好的私密性，不会造成微博那样被刷屏的负面影响；
                                <p style="font-size:1.2em">3、可以自由定制墙体界面、文字，达到更好的使用效果；
                                    <p style="font-size:1.2em">4、可以增加微信公众号的粉丝数量。</p>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="tab2">
                <p>酷文博，为互联网IT人才充电！（http://coolwb.com）</p>
            </div>
            <!-- End #tab2 -->
        </div>
        <!-- End .content-box-content -->
    </div>

    <div class="clear"></div>
    <!-- Start Notifications -->

    <script>
        leftModou.leftCur("#shenhe");
        leftModou.leftCur("#up");
    </script>
    </div>
    <div class="footc" id="">
	<div class="footcT">网站信息<span><a href="javascript:void()" id="divYes">打开</a></span></div>
	<div class="footcC" style="display:none">BY abc</div>
</div>
<!-- End Notifications -->
<div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      &#169; Copyright 2013 www | Powered by <a href="">abc.COM</a> | <a href="#">Top</a> </small>
</div>
<!-- End #footer -->
</div>
<!-- End #main-content -->
</div>