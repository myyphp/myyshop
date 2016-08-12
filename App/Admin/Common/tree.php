<?php
/**
 * 无限极分类函数
 * @param1 $data : 要进行无限极分类的数组
 * @param2 $pid : 顶级分类id 默认0
 * @param3 $level : 层级标识 默认0
 */
function getTree($data,$pid=0,$level=0)
{
	static $tree = array();
	foreach ($data as $v){
		if($v['parent_id']==$pid){
    	    $v['level'] = $level;
    	    $tree[] = $v;
    	    getTree($data,$v['id'],$level+1);
		}	
	}
	return $tree;
}