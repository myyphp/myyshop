<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>myshop后台管理</title>
    <link href="/Public/Admin/css/admin_login.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="admin_login_wrap">
    <h1>后台管理</h1>
    <div class="adming_login_border">
        <div class="admin_input">
            <form action="/index.php/Admin/Login/login" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="username">用户名：</label>
                        <input type="text" name="username" id="username" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="password" id="pwd" size="35" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="chkcode">验证码：</label>
                        <input type="text" name="chkcode" id="chkcode" size="35" class="admin_input_style" /><br />
						<img src="/index.php/Admin/Login/getCaptcha" onclick="this.src='/index.php/Admin/Login/getCaptcha?_='+Math.random();" alt="点击更换" />
                    </li>
					
                    <li>
                        <input type="submit" tabindex="3" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
    <p class="admin_copyright"><a tabindex="5" href="#" target="_blank">返回前台页面</p>
</div>
</body>
</html>