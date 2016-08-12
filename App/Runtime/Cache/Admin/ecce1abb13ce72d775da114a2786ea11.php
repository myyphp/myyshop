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

                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Privilege/add"><i class="icon-font"></i>添加权限</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr align='center'>
                            <th width="20%">权限名称</th>
                            <th>模块名称</th>
                            <th>控制器名称</th>
                            <th>方法名称</th>
                            <th>上级权限的ID，0：代表顶级权限</th>
                            <th>操作</th>
                        </tr>
						
						<?php if(is_array($data)): foreach($data as $key=>$vo): ?><tr>
                            <td><?php echo ($vo["pri_name"]); ?></td>
                            <td><?php echo ($vo["module_name"]); ?></td>
                            <td><?php echo ($vo["controller_name"]); ?></td>
                            <td><?php echo ($vo["action_name"]); ?></td>
                            <td><?php echo ($vo["parent_id"]); ?></td>
                            <td>
                                <a class="link-update" href="/index.php/Admin/Privilege/edit/id/<?php echo ($vo["id"]); ?>">修改</a>
                                <a class="link-del" onclick="return confirm('您确定要删除吗')"  href="/index.php/Admin/Privilege/del/id/<?php echo ($vo["id"]); ?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
									
                    </table>
                </div>

        </div>
	
		
</body>
</html>