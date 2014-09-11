<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-3
 * Time: 下午8:40
 */
class Area_model extends CI_Model{
    //重写构造方法
    public function __construct() {
        parent::__construct ();//继承model层
        $this->load->database();//实例化数据库操作对象
        $this->load->library('session');//实例化session对象
    }

    //插入区域信息，
    public function area_insert($area_name){//参数为区域名称
        $this->db->set('area_name',$area_name);//给参数区域名称赋值
        $this->db->insert('t_bas_area');//插入到区域基本表里
    }

    //更新区域信息
    public function area_update($area_name,$area_id){//参数为区域名称，区域ID（主键）
        $this->db->set('area_name',$area_name);//给参数区域名称赋值
        $this->db->where('area_id',$area_id);//搜索符合区域ID的记录
        $this->db->update('t_bas_area');//更新区域基本表
    }

    //删除区域信息
    public  function area_delete($area_id){//参数为区域ID
        $this->db->where('area_id',$area_id);//搜索符合当前区域ID的记录
        $this->db->delete('t_bas_area');//删除在区域基本表里的这条记录
    }

    //区域信息查询
    public function area_query($currentpage,$pagesize){//参数为当前页数，每页所含记录条数
        if($currentpage==0){//判断是否为初始页
            $currentpage=1;//如果为初始页则赋值为整形1；
        }
        $start_index=($currentpage-1)*$pagesize;//计算当前页的起始记录是表里的第几条
        $this->db->select('area_name');//查找区域名称
        $this->db->orderby('area_id','desc');//根据区域ID倒序排列
        $this->db->limit($start_index,$pagesize);//分页查询，两个参数一个为起始记录数和当年也总共记录条数
        $this->db->get('t_bas_area');//根据以上条件查询区域基本表
    }

}

?>