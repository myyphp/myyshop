<?php
namespace Admin\Controller;
use Think\Controller;
class RoleController extends IndexController
{
    //新增角色的方法
    public function add()
    {
        if(IS_POST)
        {
            $model = D('Admin/Role');
            if($model->create(I('post.'), 1))
            {
                if($id = $model->add())
                {
                    $this->success('添加成功！', U('lst?p='.I('get.p')));
                    exit;
                }
            }
            $this->error($model->getError());
        }
         
        // 取出所有的权限
        $priModel = D('Privilege');
        $priData = $priModel->getTree();
        $this->assign('priData', $priData);

        $this->assign('page_title','新增角色');
        $this->display();
    }
    //显示角色列表的方法
    public function lst()
    {
        $model = D('Admin/Role');
        $data = $model->search();
        $this->assign(array(
                'data' => $data['data'],
                'page' => $data['page'],
        ));
    
        $this->assign('page_title','角色列表');
        $this->display();
    }
    
}