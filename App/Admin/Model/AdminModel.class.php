<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model
{
    
	protected $insertFields = array('username','password','rpassword','is_use');
	protected $updateFields = array('id','username','rpassword','password','is_use');
	// 登录时表单验证的规则 
	public $_login_validate = array(
		array('username', 'require', '用户名不能为空！', 1),
		array('password', 'require', '密码不能为空！', 1),
		array('chkcode', 'require', '验证码不能为空！', 1),
		array('chkcode', 'chk_chkcode', '验证码不正确！', 1, 'callback'),
	);
	// 添加修改管理员时用
	protected $_validate = array(
		array('username', 'require', '账号不能为空！', 1, 'regex', 3),
		array('username', '1,30', '账号的值最长不能超过 30 个字符！', 1, 'length', 3),
		// 下面的规则只有添加时生效，修改时不生效，第六个参数代表什么时候验证：1：添加时验证 2：修改时 3：所有情况都验证
		array('password', 'require', '密码不能为空！', 1, 'regex', 1),
		array('rpassword', 'password', '两次密码输入不一致！', 1, 'confirm', 3),
		array('is_use', 'number', '是否启用 1：启用0：禁用必须是一个整数！', 2, 'regex', 3),
		array('username', '', '账号已经存在！', 1, 'unique', 3),
	);
	//验证验证码的回调函数
	public function chk_chkcode($code)
	{
	    $verify = new \Think\Verify();
	    return $verify->check($code);
	}
    // 添加前
    protected function _before_insert(&$data, $option)
    {
        // 密码加上C('MD5_KEY')在进行md5加密
        $data['password'] = md5( $data['password'].C('MD5_KEY') ) ;
    }
    //添加后
    protected function _after_insert($data, $option)
    {
        $roleId = I('post.role_id');
        if($roleId)
        {
            $arModel = M('AdminRole');
            foreach ($roleId as $v)
            {
                $arModel->add(array(
                        'admin_id' => $data['id'],
                        'role_id' => $v,
                ));
            }
        }
    }
    // 修改前
	// 修改前
	protected function _before_update(&$data, $option)
	{
		// 如果是超级管理员必须是启用的
		if($option['where']['id'] == 1)  $data['is_use'] = 1;
		
		$roleId = I('post.role_id');
		// 先清除原来的数据
		$arModel = M('AdminRole');
		$arModel->where(array('admin_id'=>array('eq', $option['where']['id'])))->delete();
		if($roleId)
		{
			foreach ($roleId as $v)
			{
				$arModel->add(array(
					'admin_id' => $option['where']['id'],
					'role_id' => $v,
				));
			}
		}
		// 判断密码为空就不修改这个字段
		if(empty($data['password']))
			unset($data['password']);
		else 
			$data['password'] = md5($data['password'] . C('MD5_KEY'));
	}
	// 删除前
	protected function _before_delete($option)
	{
		if($option['where']['id'] == 1)
		{
			$this->error = '超级管理员不能被删除！';
			return FALSE;
		}
		// 在删除admin表中管理员的信息之前先删除admin_role表中这个管理员对应的数据
		$arModel = M('AdminRole');
		$arModel->where(array('admin_id'=>array('eq', $option['where']['id'])))->delete();
	}
    
    /**
     * 验证验证码的方法
     * @param string $code : 要验证的验证码
     * @return bool 用户验证码是否正确
     */
    public function checkCaptcha($code)
    {
        $captcha = new \Think\Verify();
        return $captcha->check($code);
    }
    
    /**
     * 验证登录信息的方法
     */
    public function checkLogin()
    {
        //接收登录数据
        $username = I('post.username');
        $password = I('post.password');
        
        $user = $this->where( array('username'=>array('eq',"$username")) )->find();
        if( $user )
        {
            //判断登录权限
            if( $user['id'] == 1 || $user['is_use'] == 1 )
            {
                if( $user['password'] == md5($password.C('MD5_KEY')) )
                {
                    //登录信息正确，把id和用户名存进session
                    session('id',$user['id']);
                    session('username',$user['username']);
                    return true;
                }else{
                    $this->error = "密码错误";
                    return false;
                }
            }else{
                $this->error = "该用户已被禁用";
                return false;
            }   
        }else{
            $this->error = "用户名不存在";
            return false;
        }
    }
    
    public function search($pageSize = 10)
    {
        /**************************************** 搜索 ****************************************/
        $where = array();
        if($username = I('get.username'))
            $where['username'] = array('like', "%$username%");
        $is_use = I('get.is_use');
        if($is_use != '' && $is_use != '-1')
            $where['is_use'] = array('eq', $is_use);
        /************************************* 翻页 ****************************************/
        $count = $this->alias('a')->where($where)->count();
        $page = new \Think\Page($count, $pageSize);
        // 配置翻页的样式
        $data['page'] = $page->show();
        /************************************** 取数据 ******************************************/
        $data['data'] = $this->alias('a')->where($where)->group('a.id')->limit($page->firstRow.','.$page->listRows)->select();
        return $data;
    }
}