<?php
function removeXSS($val)
{
	// 实现了一个单例模式,性能更好
	static $obj = null;
	if($obj === null)
	{
		require('./HTMLPurifier/HTMLPurifier.includes.php');
		$config = HTMLPurifier_Config::createDefault();
		// 保留a标签上的target属性
		$config->set('HTML.TargetBlank', TRUE);
		$obj = new HTMLPurifier($config);  
	}
	return $obj->purify($val);  
}

/**
 * 让超出指定长度的文本内容显示为省略号
 * param1 : $content : 要处理的文本
 * param2 : $len : 要显示的长度 默认为20
 */
function showContent($content,$len=40){
    if(strlen($content)>$len){
        return mb_substr($content,0,$len,'utf-8').'....';
    }else{
        return $content;
    }
}

/**
 * 上传图片并生成缩略图
 * 用法：
 * $ret = uploadOne('logo', 'Goods', array(
 array(600, 600),
 array(300, 300),
 array(100, 100),
 ));
 返回值：
 if($ret['ok'] == 1)
 {
 $ret['images'][0];   // 原图地址
 $ret['images'][1];   // 第一个缩略图地址
 $ret['images'][2];   // 第二个缩略图地址
 $ret['images'][3];   // 第三个缩略图地址
 }
 else
 {
 $this->error = $ret['error'];
 return FALSE;
 }
 *
 */
function uploadOne($imgName, $dirName, $thumb = array())
{
    // 上传LOGO
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0)
    {
        $rootPath = C('IMG_rootPath');
        $upload = new \Think\Upload(array(
                'rootPath' => $rootPath,
        ));
        // 实例化上传类
        $upload->maxSize = (int)C('IMG_maxSize') * 1024 * 1024;// 设置附件上传大小
        $upload->exts = C('IMG_exts');// 设置附件上传类型
        /// $upload->rootPath = $rootPath; // 设置附件上传根目录
        $upload->savePath = $dirName . '/'; // 图片二级目录的名称
        // 上传文件
        $info   =   $upload->upload();
        if(!$info)
        {
            return array(
                    'ok' => 0,
                    'error' => $upload->getError(),
            );
        }
        else
        {
            $ret['ok'] = 1;
            $ret['images'][0] = $logoName = $info[$imgName]['savepath'] . $info[$imgName]['savename'];
            // 判断是否生成缩略图
            if($thumb)
            {
                $image = new \Think\Image();
                // 循环生成缩略图
                foreach ($thumb as $k => $v)
                {
                    $ret['images'][$k+1] = $info[$imgName]['savepath'] . 'thumb_'.$k.'_' .$info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open($rootPath.$logoName);
                    $image->thumb($v[0], $v[1])->save($rootPath.$ret['images'][$k+1]);
                }
            }
            return $ret;
        }
    }
}
