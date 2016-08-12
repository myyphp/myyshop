<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商城后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="container clearfix">

    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php/Admin/Goods/lst" target="main-frame"><i class="icon-font">&#xe006;</i>商品列表</a></li>
						<li><a href="/index.php/Admin/Goods/add" target="main-frame"><i class="icon-font">&#xe008;</i>添加商品</a></li>

                        <li><a href="#"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="#"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="#"><i class="icon-font">&#xe052;</i>友情链接</a></li>                      
                        <li><a href="#"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
				
                <li>
                	<a href="#"><i class="icon-font">&#xe003;</i>商品分类管理</a>
                	<ul class="sub-menu">
                		 <li><a href="/index.php/Admin/Category/lst" target="main-frame"><i class="icon-font">&#xe006;</i>分类列表</a></li>
						<li><a href="/index.php/Admin/Category/add" target="main-frame"><i class="icon-font">&#xe008;</i>添加分类</a></li>
                	</ul>
                </li>

		        <li>
                	<a href="#"><i class="icon-font">&#xe003;</i>管理员权限管理</a>
                	<ul class="sub-menu">
                		<li><a href="/index.php/Admin/Admin/lst" target="main-frame"><i class="icon-font">&#xe006;</i>管理员列表</a></li>
                		 <li><a href="/index.php/Admin/Role/lst" target="main-frame"><i class="icon-font">&#xe006;</i>角色列表</a></li>
						<li><a href="/index.php/Admin/Privilege/lst" target="main-frame"><i class="icon-font">&#xe008;</i>权限列表</a></li>
                	</ul>
                </li>
        </div>
    </div>
    <!--/sidebar-->
</body>
</html>