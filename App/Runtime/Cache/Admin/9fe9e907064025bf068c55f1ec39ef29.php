<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="/myshop/Public/Admin/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="/myshop/Public/Admin/css/main.css"/>
    <script type="text/javascript" src="/myshop/Public/Admin/js/libs/modernizr.min.js"></script>
</head>
<body>

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/myshop/index.php/Admin/Index/index">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/myshop/index.php/Admin/Goods/goodslist">商品管理</a><span class="crumb-step">&gt;</span><span>新增商品</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="/myshop/index.php/Admin/Goods/goodsadd" method="post" id="myform" name="myform" enctype="multipart/form-data">
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
                                    <input class="common-text required" id="title" name="goods_name" size="30" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>价格：</th>
                                <td><input class="common-text" name="price" size="30" value="" type="text"></td>
                            </tr>
							<tr>
                                <th>是否上架：</th>
                                <td><input name="is_on_sale"  type="radio" value='0' checked='checked'>是
								<input name="is_on_sale"  type="radio" value='1'>否
								</td>
                            </tr>
                            <tr>
                                <th><i class="require-red">*</i>上传图片：</th>
                                <td><input name="logo" id="" type="file"></td>
                            </tr>
                            <tr>
                                <th>商品描述：</th>
                                <td><textarea name="goods_desc" class="common-textarea" id="content" cols="20" style="width: 40%;" rows="10"></textarea></td>
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
</body>
</html>