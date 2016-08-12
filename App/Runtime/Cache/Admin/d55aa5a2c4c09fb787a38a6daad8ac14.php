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
		
		
	
<script type="text/javascript" src="/Public/Admin/js/libs/jquery.js"></script>
        <div class="result-wrap">


			<!-- 搜索 -->
<div class="search-content">
    <form method="GET" name="search_form">
		<p>
			账号：
	   		<input type="text" name="username" size="30" value="<?php echo I('get.username'); ?>" />
		
		
			是否启用：
			<input type="radio" value="-1" name="is_use" <?php if(I('get.is_use', -1) == -1) echo 'checked="checked"'; ?> /> 全部 
			<input type="radio" value="1" name="is_use" <?php if(I('get.is_use', -1) == '1') echo 'checked="checked"'; ?> /> 启用 
			<input type="radio" value="0" name="is_use" <?php if(I('get.is_use', -1) == '0') echo 'checked="checked"'; ?> /> 禁用 
		
		<input class="btn btn-primary btn2" type="submit" value=" 搜索 " class="button" /></p>
    </form>
</div>	
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Admin/add"><i class="icon-font"></i>新增管理员</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr align='center'>
                            <td width="20%" align='center' >管理员账户</td>

                            <td align='center' >是否启用</td>
                            <td align='center' >操作</td>
                        </tr>
						
		<?php foreach ($data as $k => $v): ?>            
			<tr align='center' >
				<td><?php echo $v['username']; ?></td>
				<td style="cursor:pointer;" admin_id="<?php echo ($v["id"]); ?>" class="is_use"><?php echo $v['is_use']==1?'启用':'禁用'; ?></td>
		        <td align="center">
		        	<a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a>
		        	<?php if($v['id'] > 1): ?>
		        	 |
	                <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a> 
	                <?php endif; ?>
		        </td>
	        </tr>
        <?php endforeach; ?> 
		
		<?php if(preg_match('/\d/', $page)): ?>  
        <tr><td align="center" nowrap="true" colspan="3" height="30"><div class="yahoo2"><?php echo ($page); ?></div></td></tr> 
        <?php endif; ?> 
									
                    </table>
                </div>

        </div>
		<script>
		// 为启用的td加一个事件
		$(".is_use").click(function(){
			// 先获取点击的记录的ID
			var id = $(this).attr("admin_id");
			if(id == 1)
			{
				alert("超级管理员不能修改！");
				return false;
			}
			var _this = $(this);
			$.ajax({
				type : "GET",
				// 默认U函数生成的地址是带.html后缀的：/index.php/Admin/Admin/ajaxUpdateIsuse.html/id/3，这样请求这个地址会报错无法请求，所以需要让U生成的地址不要带.html后缀
				// 也就是说，如果在AJAX时使用了U函数并且后面还要再传参数就需要设置第三个参数为FALSE不生成.html后缀
				url : "<?php echo U('ajaxUpdateIsuse', '', FALSE); ?>/id/"+id,
				success : function(data)
				{
					if(data == 0)
						_this.html("禁用");
					else
						_this.html("启用");
				}
			});
		});
		</script>	
		
</body>
</html>