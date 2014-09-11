<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午8:54
 */
class Personserver_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入服务评论统计表
    public function personserver_insert($server_id,$person_id,$evaluate,$comment){
        $this->db->set('server_id',$server_id);
        $this->db->set('person_id',$person_id);
        $this->db->set('evaluate',$evaluate);
        $this->db->set('comment',$comment);
        $this->db->insert('t_person_server');
    }

    //更新服务评论统计表
    public function personserver_update($server_id,$person_id,$evaluate,$comment,$pserver_id){
        $this->db->set('server_id',$server_id);
        $this->db->set('person_id',$person_id);
        $this->db->set('evaluate',$evaluate);
        $this->db->set('comment',$comment);
        $this->db->where('pserver_id',$pserver_id);
        $this->db->update('t_person_server');
    }

    //删除评论服务统计信息
    public function personserver_delete($pserver_id){
        $this->db->wherer('pserver_id',$pserver_id);
        $this->db->delete('t_person_server');
    }

    //查询服务评论统计信息
    public function personserver_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('p.person_name,s.server_name,r.evaluate,r.comment');
        $this->db->from('t_person_server as r');
        $this->db->join('t_bas_person as p','r.person_id=p.person_id');
        $this->db->join('t_server_information as s','r.server_id=s.server_id');
        $this->db->orderby('r.pserver_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get();
    }
}
?>