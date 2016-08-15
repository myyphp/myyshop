<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index()
    {
    	//测试调整模板
    	$this->redirect('index/test',array('id'=>1), 3);
    }

    //测试
    public function test($id)
    {
    	//$id = $_GET['id'];
    	$id = (int)$id;

    	if ($id > 0) {
    		echo 'here is news of id '. $id;
    	} else {
    		echo '缺少必要的参数！';
    	}
    }
}