<?php
namespace Admin\Model;
use Think\Model;
class GoodsModel extends Model 
{
    // 允许接收的字段
	protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');
	
	// 自定义验证规则
	protected $_validate = array(
	        array('goods_name', 'require', '商品名称不能为空！', 1),
	        array('goods_name', '1,45', '商品名称必须是1-45个字符', 1, 'length'),
	        array('price', 'currency', '价格数据格式不正确', 1),
	        array('is_on_sale', '0,1', '是否上架只能是0,1两个值', 1, 'in'),
	);
	
	// 钩子程序 ：商品数据入库前先处理图片上传并生成缩略图

	protected function _before_insert(&$data, $option)
	{
	    // 获取当前时间
	    $data['addtime'] = time();
	    if(isset($_FILES['logo']) && $_FILES['logo']['error'] == 0)
	    {
	        $ret = uploadOne('logo', 'Goods', array(
	                array(150, 150, 2),
	        ));
	        if($ret['ok'] == 1)
	        {
	            $data['logo'] = $ret['images'][0];
	            $data['sm_logo'] = $ret['images'][1];
	        }
	        else
	        {
	            $this->error = $ret['error'];
	            return FALSE;
	        }
	    }
	}
	/**
	 * 对商品数据进行分页、排序、搜索
	 */
	public function search()
	{
	    /*******************搜索********************/

	    $where = array();
	    //商品名称的搜索
	    $goods_name = I("get.gname");
	    if( $goods_name )
	    {
	        $where['goods_name'] = array('like',"%{$goods_name}%");
	    }
	    
	    //价格区间的搜索
	    $start_price = I('get.sprice');
	    $end_price = I('get.eprice');
	    if( $start_price && $end_price )
	    {
	        $where['price'] = array( "between",array($start_Price, $end_Price) );
	    } elseif( $start_price ){
	        $where['price'] = array('egt',$start_price);
	    } elseif( $end_price ){
	        $where['price'] = array('elt',$end_price);
	    }
	    
	    //是否上架的搜索
	    $is_on_sale = (int)I('get.isonsale',-1);
	    if( $is_on_sale != -1 )
	    {
	        $where['is_on_sale'] = array('eq',$is_on_sale);
	    }
	    
	    //是否删除的搜索
	    $is_delete = (int)I('get.isdelete',-1);
	    if( $is_delete != -1 )
	    {
	        $where['is_delete'] = array('eq',$is_delete);
	    }
	    
	    //时间的搜索
	    $start_addtime = I('get.start_addtime');
	    $end_addtime = I('end.start_addtime');
	    if( $start_addtime && $end_addtime ){
	        $where['addtime'] = array('between',array(strtotime("$start_addtime 00:00:01"),strtotime("$end_addtime 00:00:01")));
	    }elseif( $start_addtime ){
	        $where['addtime'] = array('egt',strtotime("$start_addtime 00:00:01"));
	    }elseif ( $end_addtime ){
	        $where['addtime'] = array('elt',strtotime("$end_addtime 23:59:59"));
	    }
	    
	    /*******************排序********************/
	    //默认排序方式
	    $orderby = "id";
	    $orderway = 'asc';
	    
	    $orderway = I('get.odby');
	    if( $orderway && in_array($orderway, array('id_desc','price_asc','price_desc')) )
	    {
	        if( $orderway == 'id_desc' )
	        {
	            $orderway = 'desc';
	        }elseif ( $orderway == 'price_asc' )
	        {
	            $orderby = 'price';
	        }else{
	            $orderby = 'price';
	            $orderway = 'desc';
	        }
	    }
	    
	    /*******************分页********************/
	    //总记录数
	    $count = $this->where($where)->count('id');
	    //每页显示记录数量
	    $pageshowcount = C("PAGE_SHOW_COUNT");         
	    $page = new \Think\Page($count,$pageshowcount);
	    $pageString = $page->show();
	    //取得每页的商品数据，并返回给控制器
	    $pageData = $this->where($where)->limit($page->firstRow.','.$page->listRows)->order("{$orderby} {$orderway}")->select();
	    return array(
	    	'page'=>$pageString,
	        'data'=>$pageData,    
	    );
	}
	
	/**
	 * 钩子函数，在删除指定商品的时候，先删除掉磁盘上面的商品图片
	 */
	public function _before_delete($options)
	{
	    //根据id取出图片地址
	    $img = $this->field("logo,sm_logo")->find($options['where']['id']);
	    $logo = C("IMG_rootPath").'/'.$img['logo'];
	    $sm_logo = C("IMG_rootPath").'/'.$img['sm_logo'];
	    
	    unlink($logo);
	    unlink($sm_logo);
	}
	
	/**
	 * 钩子函数，在修改商品的时候删除原来的图片，并重新生成
	 */
	public function _before_update(&$data, $options)
	{
	    // 上传LOGO
	    if($_FILES['logo']['error'] == 0)
	    {
	        $rootPath = C('IMG_rootPath');
	        //上传文件信息配置
	        $upload = new \Think\Upload(array('rootPath' => $rootPath,));
	        $upload->maxSize = (int)C('IMG_maxSize') * 1024 * 1024;
	        $upload->exts = C('IMG_exts');
	        $upload->savePath = 'Goods/';
	        // 上传文件
	        $info   =   $upload->upload();
	        if( !$info )
	        {
	            // 先把上传失败的错误信息存到模型中，由控制器最终再获取这个错误信息并显示
	            $this->error = $upload->getError();
	            return FALSE;
	        }else{
	             
	            $logoName = $info['logo']['savepath'] . $info['logo']['savename'];
	            // 拼凑缩略图的文件名
	            $smLogoName = $info['logo']['savepath'] . 'thumb_' .$info['logo']['savename'];
	             
	            // 生成缩略图
	            $image = new \Think\Image();
	            $image->open($rootPath.$logoName);
	            $image->thumb(150, 150)->save($rootPath.$smLogoName);
	             
	            // 把图片的表单放到表单中
	            $data['logo'] = $logoName;
	            $data['sm_logo'] = $smLogoName;
	            
	            //根据id取出图片地址,并删除
	            $img = $this->field("logo,sm_logo")->find($options['where']['id']);
	            $logo = C("IMG_rootPath").'/'.$img['logo'];
	            $sm_logo = C("IMG_rootPath").'/'.$img['sm_logo'];             
	            unlink($logo);
	            unlink($sm_logo);
	        }
	    }
	}
}