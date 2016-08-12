<?php
namespace Admin\Controller;
use Think\Controller;
class CategoryController extends IndexController
{
    /**
     * 添加商品分类的方法
     */
    public function add()
    {
        
        if( IS_POST )
        {
            //处理提交的数据
            $category = D("Category");
            if( $category->create(I('post.'),1) ){
                if( $id = $category->add() )
                {
                    $this->success('操作成功',U('lst'),2);
                    exit;
                }
            }
            $error = $category->getError();
            $this->error($error);
            exit;
        }
        //取出父级分类数据(无限极分类后的数据)
        $category = D('Category');
        $categories = $category->getCategory();
        $this->assign('categories',$categories);
        $this->assign('page_title',"新增分类");
        $this->display();
    }
    
    /**
     * 根据id删除分类的方法
     */
    public function del()
    {
        $model = D('Category');
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
    
    /**
     * 修改商品分类的方法
     */
    public function edit()
    {
        $id = I('get.id');
        if(IS_POST)
        {
            $category = D('Admin/Category');
            if($category->create(I('post.'), 2))
            {
                if($category->save() !== FALSE)
                {
                    $this->success('修改成功！', U('lst', array('p' => I('get.p', 1))));
                    exit;
                }
            }
            $this->error($category->getError());
        }
        
        //找出当前分类的数据
        $category = D('Admin/Category');
        $data = $category->find($id);
        $this->assign('data', $data);
        
        //找出所有分类信息
        $categories = $category->getCategoryButSelf($id);       
        $this->assign('categories',$categories);
        $this->assign('page_title',"修改分类");
        $this->display();
    }
    
    /**
     * 显示商品列表的方法
     */
    public function lst()
    {
        $this->assign('page_title',"分类列表");
        //取出分类数据(无限极分类后的数据)
        $category = D('Category');
        $categories = $category->getCateHavePCate();
        $this->assign('categories',$categories);
        $this->display();
    }
}