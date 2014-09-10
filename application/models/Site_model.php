<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午7:50
 */
class Site_model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入地址信息
    public function site_insert($site_name,$location,$describe,$transport){
        $this->db->set('site_name',$site_name);
        $this->db->set('location',$location);
        $this->db->set('describe',$describe);
        $this->db->set("transport",$transport);
        $this->db->insert('t_bas_site');
    }

    //更新地址信息
    public  function site_update($site_name,$location,$describe,$transport,$site_id){
        $this->db->set('site_name',$site_name);
        $this->db->set('location',$location);
        $this->db->set('describe',$describe);
        $this->db->set("transport",$transport);
        $this->db->where('site_id',$site_id);
        $this->db->update('t_bas_site');
    }

    //删除地址信息
    public function site_delete($site_id){
        $this->db->where('site_id',$site_id);
        $this->db->delete('t_bas_site');
    }

    //查询地址信息
    public function site_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('site_name,location,describe,transport');
        $this->db->orderby('site_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get('t_bas_site');
    }
}
?>