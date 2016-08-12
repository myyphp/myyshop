<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/main.css"/>
    <script type="text/javascript" src="/Public/Admin/js/libs/modernizr.min.js"></script>
	<link href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/page.css"/>
</head>
<body>


        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/index.php/Admin/Index/main">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name"><?php echo ($page_title); ?></span></div>
        </div>
		
		
	
        <div class="result-wrap">
            <div class="result-content">
                <form action="/index.php/Admin/Admin/edit" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th><i class="require-red">*</i>用户名</th>
                                <td>
                                    <input class="common-text required" id="title" name="username" size="28" value="<?php echo ($data["username"]); ?>" type="text">
                                </td>
                            </tr>
							
							<tr>
                            <th><i class="require-red">*</i>密码</th>
                                <td>
                                    <input class="common-text required" id="" name="password" size="28" value="" type="password">
                                </td>
                            </tr>
							
							<tr>
                            <th><i class="require-red">*</i>重复密码</th>
                                <td>
                                    <input class="common-text required" id="" name="rpassword" size="28" value="" type="password">
                                </td>
                            </tr>
							
							<?php if($data['id'] > 1): ?>
				        	<tr>
				                <th><i class="require-red">*</i>所在角色：</th>
				                <td>
				                	<?php foreach ($roleData as $k => $v): if(strpos(','.$rid.',', ','.$v['id'].',') !== FALSE) $check = 'checked="checked"'; else $check = ''; ?>
				                    <input <?php echo ($check); ?> type="checkbox" name="role_id[]" value="<?php echo ($v["id"]); ?>" /> <?php echo ($v["role_name"]); ?>
				                    <?php endforeach; ?>
				                </td>
				            </tr>
				            <?php endif; ?>
							<tr>
                            <th><i class="require-red">*</i>是否启用</th>
                                <td>
                                    启用<input class="common-text required" <?php if($data['is_use'] == 1): ?>checked='checked'<?php endif; ?> name="is_use" size="28" value="1" type="radio"> 禁用<input class="common-text required" <?php if($data['is_use'] == 0): ?>checked='checked'<?php endif; ?> name="is_use" size="28" value="0" type="radio">
                                </td>
                            </tr>
							
                            <tr>
                                <th></th>
                                <td>
                                	<input type="hidden" name='id' value="<?php echo ($data["id"]); ?>" />
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    <!--/main-->
</div>
	
		
</body>
</html>