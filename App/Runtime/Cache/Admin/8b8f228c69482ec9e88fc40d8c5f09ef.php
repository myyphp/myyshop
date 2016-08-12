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
                            <th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="">全部</option>
                                    
                                </select>
                            </td>
                            <th width="70">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keywords" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">

                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Category/add"><i class="icon-font"></i>新增分类</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>分类名称</th>
                            <th>上级分类</th>
                            <th>操作</th>
                        </tr>
						
						<?php if(is_array($categories)): foreach($categories as $key=>$vo): ?><tr>
                            <td>
                            	<?php if($vo["parent_id"] == 0 ): ?><b><?php endif; ?>
                            	<?php echo (str_repeat('--',$vo["level"])); echo ($vo["cat_name"]); ?>
								<?php if($vo["parent_id"] == 0 ): ?></b><?php endif; ?>
							</td>
                            <td><?php echo ((isset($vo["parent_name"]) && ($vo["parent_name"] !== ""))?($vo["parent_name"]):"顶级分类"); ?></td>
                            <td>
                                <a class="link-update" href="/index.php/Admin/Category/edit/id/<?php echo ($vo["id"]); ?>">修改</a>
                                <a class="link-del" onclick="return confirm('您确定要删除吗')"  href="/index.php/Admin/Category/del/id/<?php echo ($vo["id"]); ?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>
									
                    </table>
                </div>

        </div>
	
		
</body>
</html>