<?php
namespace Admin\Model;
use Think\Model;
class CategoryModel extends Model 
{
    //允许插入的字段
    protected $insertFields = array('parent_id','cat_name');
    //运行更新的字段
    protected $updateFields = array('id','parent_id','cat_name');
    
    //自动验证
    protected $_validate = array(
    	    array('parent_id','number','父级分类id数据不合法',1),
            array('cat_name','require','分类名称不能为空',1),
            array('cat_name', '1,30', '分类名称的值最长不能超过 30 个字符！', 1, 'length', 3),
    );
    
    /**
     * 取得无限极分类后数据的方法
     */
    public function getCategory()
    {
        $data = $this->select();
        //加载无限极分类函数
        load("@/tree");
        return getTree($data);
    }
    
    /**
     * 取得无限极分类后数据的方法，但是不包含自己本身和其子分类的数据
     * @param 本身的分类id
     */
    public function getCategoryButSelf($id)
    {
        $sql = "select * from sh_category where id != {$id}";
        $data = $this->query($sql);
        //加载无限极分类函数
        load("@/tree");
        return getTree($data);
    }
    
    /**
     * 取出无限极分类后的分类数据的方法，包含有父级分类的名字
     */
    public function getCateHavePCate()
    {
        $sql = "select a.* ,b.cat_name as parent_name from sh_category a left join sh_category b on a.parent_id = b.id";
        $data = $this->query($sql);
        //加载无限极分类函数
        load("@/tree");
        return getTree($data);
    }

    /**
     * 获取子分类id的方法 
     */
    public function getChildren($id)
    {
        $data = $this->select();
        return $this->_children($data, $id);
    }
    
    /**
     *  递归找出所有子分类
     */
    private function _children($data, $parent_id=0, $isClear=TRUE)
    {
        static $ret = array();
        if($isClear) $ret = array();
        
        foreach ( $data as $k => $v )
        {
            if($v['parent_id'] == $parent_id)
            {
                $ret[] = $v['id'];
                $this->_children($data, $v['id'], FALSE);
            }
        }
        return $ret;
    }
   
    /**
     * 构造函数，当删除分类的时候，同时删除子分类
     */   
    public function _before_delete($option)
    {
        // 先找出所有的子分类
        $children = $this->getChildren($option['where']['id']);
        // 如果有子分类都删除掉
        if($children)
        {
            $children = implode(',', $children);
            //避免死循环，需要手动执行sql语句，而不能用delete()
            $this->execute("delete from sh_category where id in($children)");
        }
    }
}
 