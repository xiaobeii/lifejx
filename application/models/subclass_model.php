<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午8:06
 */
class Subclass_model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入服务活动小类信息
    public function subclass_insert($sub_name,$ctg_id){
        $this->db->set('sub_name',$sub_name);
        $this->db->set('ctg_id',$ctg_id);
        $this->db->insert('t_bas_subclass');
    }

    //更新服务活动小类信息
    public function subclass_update($sbu_name,$ctg_id,$sub_id){
        $this->db->set('sub_name',$sbu_name);
        $this->db->set('ctg_id',$ctg_id);
        $this->db->where('sub_id',$sub_id);
        $this->db->update('t_bas_subclass');
    }

    //删除服务活动小类信息
    public function subclass_delete($sub_id){
        $this->db->where('sub_id',$sub_id);
        $this->db->delete('t_bas_subclass');
    }

    //查询服务轰动小类信息
    public function subclass_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('s.sub_name,c.ctg_name');
        $this->db->from('t_bas_subclass as s');
        $this->db->join('t_bas_category as c','s.ctg_id=c.ctg_id');
        $this->db->orderby('s.sub_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get();
    }
}
?>