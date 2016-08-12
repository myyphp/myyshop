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
                <form action="/index.php/Admin/Privilege/edit" method="post" id="myform" name="myform">
                    <table class="insert-tab" width="100%">
                        <tbody>
                        	<tr>
                                <th><i class="require-red">*</i>上级权限</th>
                                <td>
                                    <select name="parent_id" id="">
                                    	<option value="0">顶级权限</option>
										<?php foreach ($parentData as $k => $v): ?> 
						<?php if($v['id'] == $data['id'] || in_array($v['id'], $children)) continue ; ?> 
						<option <?php if($v['id'] == $data['parent_id']): ?>selected="selected"<?php endif; ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 4*$v['level']).$v['pri_name']; ?></option>
						<?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>权限名称</th>
                                <td>
                                    <input class="common-text required" id="title" name="pri_name" size="28" value="<?php echo ($data['pri_name']); ?>" type="text">
                                </td>
                            </tr>
							
							<tr>
                            <th><i class="require-red">*</i>模块名称</th>
                                <td>
                                    <input class="common-text required" id="" name="module_name" size="28" value="<?php echo ($data['module_name']); ?>" type="text">
                                </td>
                            </tr>
							
							<tr>
                            <th><i class="require-red">*</i>控制器名称</th>
                                <td>
                                    <input class="common-text required" id="" name="controller_name" size="28" value="<?php echo ($data['controller_name']); ?>" type="text">
                                </td>
                            </tr>
							<tr>
                            <th><i class="require-red">*</i>方法名称</th>
                                <td>
                                    <input class="common-text required" id="" name="action_name" size="28" value="<?php echo ($data['action_name']); ?>" type="text">
                                </td>
                            </tr>
							
                            <tr>
                                <th></th>
                                <td>
                                	<input type="hidden" name='id' value="<?php echo ($data['id']); ?>"/>
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