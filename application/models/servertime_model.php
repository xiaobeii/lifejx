<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午9:40
 */
class Servertime_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入具体时间信息表
    public  function servertime_insert($stime_begin,$stime_end,$day_id,$week_id){
        $this->db->set('stime_begin',$stime_begin);
        $this->db->set('stime_end',$stime_end);
        $this->db->set('day_id',$day_id);
        $this->db->set('week_id',$week_id);
        $this->db->insert('t_server_time');
    }

    //更新具体时间信息表
    public function  servertime_update($stime_begin,$stime_end,$day_id,$week_id,$stime_id){
        $this->db->set('stime_begin',$stime_begin);
        $this->db->set('stime_end',$stime_end);
        $this->db->set('day_id',$day_id);
        $this->db->set('week_id',$week_id);
        $this->db->where('stime_id',$stime_id);
        $this->db->update('t_server_time');
    }

    //删除具体时间信息表
    public function servertime_delete($stime_id){
        $this->db->where('stime_id',$stime_id);
        $this->db->delete('t_server_time');
    }

    //查询具体时间信息表
    public function servertime_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('t.stime_begin,t.stime_end,d.day_detail,k.week_name');
        $this->db->from('t_server_time as t');
        $this->db->join('t_day_arrange as d','t.day_id=d.day_id');
        $this->db->join('t_bas_week as k','t.week_id=k.week_id');
        $this->db->orderby('t.stime_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get();

    }
}
?>