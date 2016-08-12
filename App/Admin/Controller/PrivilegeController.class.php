<?php
namespace Admin\Controller;
use Think\Controller;
class PrivilegeController extends IndexController
{
    //添加权限的方法
    public function add()
    {
        if(IS_POST)
        {
            $model = D('Admin/Privilege');
            if($model->create(I('post.'), 1))
            {
                if($id = $model->add())
                {
                    $this->success('添加成功！', U('lst'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $parentModel = D('Admin/Privilege');
        $parentData = $parentModel->getTree();
        $this->assign('parentData', $parentData);
        
        
        $this->assign('page_title','添加权限');
        $this->display();
    }
    
    //显示权限列表的方法
    public function lst()
    {
        $model = D('Admin/Privilege');
        $data = $model->getTree();
        $this->assign(array(
                'data' => $data,
        ));
        
        $this->assign('page_title','权限列表');
        $this->display();
    }
    
    //修改权限的方法
    public function edit()
    {
        $id = I('get.id');
        if(IS_POST)
        {
            $model = D('Admin/Privilege');
            if($model->create(I('post.'), 2))
            {
                if($model->save() !== FALSE)
                {
                    $this->success('修改成功！', U('lst'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $model = M('Privilege');
        $data = $model->find($id);
        $this->assign('data', $data);
        $parentModel = D('Admin/Privilege');
        $parentData = $parentModel->getTree();
        $children = $parentModel->getChildren($id);
        $this->assign(array(
                'parentData' => $parentData,
                'children' => $children,
        ));
        
        $this->assign('page_title','修改权限');
        $this->display();
    }
    
    //删除权限的方法
    public function del()
    {
        $model = D('Admin/Privilege');
        if($model->delete((int)I('get.id', 0)) !== FALSE)
        {
            $this->success('删除成功！', U('lst'));
            exit;
        }
        else
        {
            $this->error($model->getError());
        }
    }
}