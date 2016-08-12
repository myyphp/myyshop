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
                <form action="/index.php/Admin/Goods/edit" method="post" id="myform" name="myform" enctype="multipart/form-data">
                	<input type="hidden" name='id' value="<?php echo ($goods["id"]); ?>"/>
                	<input type="hidden" name='p' value="<?php echo ($p); ?>"/>
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>商品分类：</th>
                            <td>
                                <select name="colId" id="catid" class="required">
                                    <option value="">请选择</option>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>商品名称：</th>
                                <td>
                                    <input class="common-text required" id="title" name="goods_name" size="30" value="<?php echo ($goods["goods_name"]); ?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>价格：</th>
                                <td><input class="common-text" name="price" size="30" value="<?php echo ($goods["price"]); ?>" type="text"></td>
                            </tr>
							<tr>
                                <th>是否上架：</th>
                                <td><input name="is_on_sale"  type="radio" value='0' <?php echo $goods['is_on_sale'] ? "checked='checked'" : '' ?> />是
								<input name="is_on_sale" <?php echo $goods['is_on_sale'] ? '' : "checked='checked'" ?> type="radio" value='1'>否
								</td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>上传图片：</th>
                                <td><input name="logo" id="" type="file"></td>
                            </tr>
                            <tr>
                                <th>商品描述：</th>
                                <td><textarea name="goods_desc" class="common-textarea" id="goods_desc" cols="120" style="width: 80%;" rows="10"><?php echo ($goods["goods_desc"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
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
	<!-- ueditor插件 -->
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"> </script>
	<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
	
<script>
UE.getEditor('goods_desc', {
	"initialFrameWidth" : "100%",   // 宽
	"initialFrameHeight" : 350,     // 高
	"maximumWords" : 50000          // 最可以输入的字符数
});
</script>
	
		
</body>
</html>