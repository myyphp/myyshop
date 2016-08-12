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
		
		
	
        <div class="search-wrap">
            <div class="search-content">
                <form action="#" method="post">
                    <table class="search-tab">
                        <tr>
                        	<td></td>
                            <th width="70">角色名字:</th>
                            <td><input class="common-text" placeholder="关键字" name="role_name" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">

                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Role/add"><i class="icon-font"></i>新增角色</a>

                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
			    	<tr>
            <th >角色名称</th>
            <th >权限名称</th>
			<th>操作</th>
        </tr>
		<?php foreach ($data as $k => $v): ?>            
			<tr class="tron">
				<td><?php echo $v['role_name']; ?></td>
				<td><?php echo $v['pri_name']; ?></td>
		        <td>
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
		        </td>
	        </tr>
        <?php endforeach; ?> 
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="right" nowrap="true" colspan="3" height="30"><?php echo $page; ?></td></tr> 
        <?php endif; ?> 
                    </table>
                </div>

        </div>
	
		
</body>
</html>