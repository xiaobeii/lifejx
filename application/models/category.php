<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-3
 * Time: 下午9:00
 */
class Category_model extends CI_Model{
    //重写构造函数
    public function __construct() {
        parent::__construct ();//继承model层
        $this->load->database();//实例化数据库操作对象
        $this->load->library('session');//实例化session对象
    }

    //插入大类信息
    public function ctg_insert($ctg_name){//参数为大类名称
        $this->db->set('ctg_name',$ctg_name);//给参数为大类名称赋值
        $this->db->insert('t_bas_category');//插入到大类基本表里
    }

    //更新大类信息
    public function ctg_update($ctg_id,$ctg_name){//参数为大类ID(主键)，大类名称
        $this->db->set('ctg_name',$ctg_name);//给大类名称变量赋值
        $this->db->where('ctg_id',$ctg_id);//查找符合当前大类ID的记录
        $this->db->update('t_bas_category');//更新大类信息基本表
    }

    //删除大类信息
    public function ctg_delete($ctg_id){//参数为大类ID
        $this->db->where('ctg_id',$ctg_id);//查找符合大类ID的记录
        $this->db->delete('t_bas_category');//删除当前符合条件的记录
    }

    //查询大类信息
    public function ctg_query($currentpage,$pagesize){//参数为当前页数，每页所含记录条数
        if($currentpage==0){//判断是否为初始页
            $currentpage=1;//如果为初始页则赋值为整形1；
        }
        $start_index=($currentpage-1)*$pagesize;//计算当前页的起始记录是表里的第几条
        $this->db->select('ctg_name');//查找大类名称
        $this->db->orderby('ctg_id','desc');//根据大类ID倒序排列
        $this->db->limit($start_index,$pagesize);//分页查询，两个参数一个为起始记录数和当年也总共记录条数
        $this->db->get('t_bas_category');//根据以上条件查询大类基本表
    }

}
?>