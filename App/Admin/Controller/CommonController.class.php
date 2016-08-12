<?php
//防止翻墙访问
namespace Admin\Controller;
use Think\Controller;

class CommonController extends Controller{
    /**
     * 检测用户是否登录的方法
     */
    protected function _initialize()
    {
    	if(!session('?id')){
    		$this->redirect("Login/login");
    	}
    }
}