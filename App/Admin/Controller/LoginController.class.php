<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller
{
    /**
     * 登录的方法
     */
    public function login()
    {   
        if( IS_POST )
        {
            //验证登录数据
            $admin = D('Admin');
            //使用create完成自动验证
            if( $admin->validate($admin->_login_validate)->create('',3) )
            {
                if( $admin->checkLogin() === true )
                {
                    //验证通过
                    $this->redirect("Admin/Index/index");
                }                
            }
            //验证失败
            $this->error($admin->getError());
            exit;
        }
        $this->display();
    }
    
    /**
     * 生成验证码的方法
     */
    public function getCaptcha()
    {
        $config = array(    
                'fontSize'    =>    16,    // 验证码字体大小    
                'length'      =>    2,     // 验证码位数    
                'useNoise'    =>    false, // 关闭验证码杂点
        );
        $captcha = new \Think\Verify($config);
        $captcha->entry();
    }
    
    /**
     * 退出登录的方法
     */
    public function logout()
    {
    	session('id',null);
        session('username',null);
        $this->redirect("Admin/Login/login");
    }
}