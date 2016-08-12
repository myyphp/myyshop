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
            	
                <!-- 商品搜索部分  start-->
				<form action="/index.php/Admin/Goods/lst" method="get">
                    <table class="search-tab">
                        <tr>
                            <th width="110">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="">全部</option>
                                    <option value="19">精品界面</option><option value="20">推荐界面</option>
                                </select>
                            </td>
                            <th width="60">商品名称:</th>
                            <td><input size="10" class="common-text" placeholder="商品名字" name="gname" value="" type="text"></td>
							<th width="60">价格:</th>
                            <td><input size="5" class="common-text" placeholder="最小价格" name="sprice" value="" type="text">-<input  size="5" class="common-text" placeholder="最大价格" name="eprice" value="" type="text"></td>
							<td>添加时间：<input type="text" placeholder="开始时间"  size="8" id="start_addtime" name="start_addtime" value="<?php echo I('get.start_addtime'); ?>" /> - 
		<input type="text" size="8" placeholder="结束时间" id="end_addtime" name="end_addtime" value="<?php echo I('get.end_addtime'); ?>" /></td>
						</tr>
						<tr>	
							<th width="60">上架情况:</th>
							<td><input type="checkbox" name='isonsale' value='0'/>否<input type="checkbox" name='isonsale' value='1'/>是</td>
							<th width="60">删除情况:</th>
							<td><input type="checkbox" name='isdelete' value='0'/>否<input type="checkbox" name='isdelete' value='1'/>是</td>
							<th width="60">排序:</th>
							<td>
								<input type="checkbox" name='odby' value='id_asc'/>ID升序
								<input type="checkbox" name='odby' value='id_desc'/>ID降序
								<input type="checkbox" name='odby' value='price_asc'/>价格升序
								<input type="checkbox" name='odby' value='price_desc'/>价格降序
							</td>
                            <td></td>
                        </tr>
						<tr><td colspan='7' align='right'><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td></tr>
                    </table>
                </form>
				<!-- 商品搜索部分 end -->
				
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Goods/add"><i class="icon-font"></i>新增商品</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" type="checkbox"></th>
                            <th>ID</th>
                            <th>商品名称</th>
                            <th>缩略图</th>
                            <th>价格</th>
                            <th>描述</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
						
						<?php if(is_array($goodsdata)): foreach($goodsdata as $key=>$vo): ?><tr>
                            <td class="tc"><input class="allChoose" name="id[]" type="checkbox"></td>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><a target="_blank" href="#"><?php echo ($vo["goods_name"]); ?></a></td>
                            <td align='center'><img src="/Public/Uploads/<?php echo ($vo["sm_logo"]); ?>"/></td>
                            <td><?php echo ($vo["price"]); ?></td>
                            <td><?php echo (htmlspecialchars_decode($vo["goods_desc"])); ?></td>
                            <td><?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></td>
                            <td>
                                <a class="link-update" href="/index.php/Admin/Goods/edit/id/<?php echo ($vo["id"]); ?>/p/<?php echo I('get.p',1);?>">修改</a>
                                <a class="link-del" href="/index.php/Admin/Goods/del/id/<?php echo ($vo["id"]); ?>/p/<?php echo I('get.p',1);?>" onclick="return confirm('您确定要删除吗？')">删除</a>
                            </td>
                        </tr><?php endforeach; endif; ?>

                    </table>
                    <div class="yahoo2"><?php echo ($pageString); ?></div>
                </div>
            </form>
        </div>
	<!-- 时间输入插件 -->
	<link href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" language="javascript" src="/Public/datepicker/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/datepicker/datepicker_zh-cn.js"></script>
<script>
$("#start_addtime").datepicker({ dateFormat: "yy-mm-dd" });
$("#end_addtime").datepicker({ dateFormat: "yy-mm-dd" });
</script>

	
		
</body>
</html>