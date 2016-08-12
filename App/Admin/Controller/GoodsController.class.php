<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends IndexController
{
    /**
     * 添加商品的方法
     */
    public function add()
    {
        if( IS_POST )
        {
            // 商品数据入库
            $goods = D('Goods');
            if( $goods->create() )
            {
                if( $goods->add() )
                {
                    $this->success('商品添加成功',U('lst'),2);
                    exit;
                }   
            }
            $error = $goods->getError(); 
            $this->error($error);
        }
        $this->assign('page_title','新增商品');
        $this->display();
    }

    /**
     * 显示商品列表
     */
    public function lst()
    {
        //取得含有分页字符串的商品数据
        $goods = D('Goods');
        $goodsdata = $goods->search();
        
        $this->assign(array(
        	'goodsdata'=>$goodsdata['data'],
            'pageString'=>$goodsdata['page'],
        ));
        $this->assign('page_title','商品管理');
        $this->display();
    }
    
    /**
     * 删除商品的方法
     */
    public function del()
    {
        $p = (int)I('get.p');
        $goods = D('Goods');
        //删除前，使用钩子函数删除对应的商品图片
        $res = $goods->delete( (int)I('get.id') );
        if ( $res !== false )
        {
            $this->success("操作成功",U("lst?p={$p}"));
        }else{
            $this->error('操作失败，请重试');
        }        
    }
    
    /**
     * 修改商品的方法
     */
    public function edit()
    {
        if( IS_POST )
        {
            //处理要修改的数据
            $goods = D('Goods');
            if( $goods->create( I('post.') ,2) )
            {
                if( $goods->save() !== false )
                {
                    $this->success('操作成功',U('lst?p='.(int)I('post.p')),2);
                    exit;
                }
            }
            $error = $goods->getError();
            $this->error($error);
        }
        
        //要修改的商品id
        $id = I("get.id");
        //商品对应的页数，以便在修改后调回到原来的页数
        $p = I('get.p');
        $goodsById = M('Goods')->find($id);
        $this->assign('p',$p);
        $this->assign('goods',$goodsById);
        $this->assign('page_title','商品修改');
        
        $this->display();
    }
}