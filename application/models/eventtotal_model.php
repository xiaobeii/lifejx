<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午8:36
 */
class Eventtotal_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入活动统计信息
    public function eventtotal_insert($event_id,$person_id,$comment){
        $this->db->set('event_id',$event_id);
        $this->db->set('person_id',$person_id);
        $this->db->set('comment',$comment);
        $this->db->insert('t_event_total');
    }

    //更新活动统计信息
    public function eventtotal_update($event_id,$person_id,$comment,$total_id){
        $this->db->set('event_id',$event_id);
        $this->db->set('person_id',$person_id);
        $this->db->set('comment',$comment);
        $this->db->where('total_id',$total_id);
        $this->db->update('t_event_total');
    }

    //删除活动统计信息
    public function eventtotal_delete($total_id){
        $this->db->where('total_id',$total_id);
        $this->db->delte('t_event_total');
    }

    //查询活动统计信息
    public function eventtotal_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('i.event_name,p.person_no,p.person_name,t.coment');
        $this->db->from('t_event_total as t');
        $this->db->join('t_event_information as i','t.event_id=i.event_id');
        $this->db->join('t_bas_person as p','t.person_id=p.person_id');
        $this->db->orderby('t.total_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get();
    }
}
?>