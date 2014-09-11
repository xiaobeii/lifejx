<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-2
 * Time: 下午7:50
 */
class Event_model extends CI_Model{

    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入活动信息
    public function event_insert($event_name,$event_image,$event_describe,$event_time,$note,$notice_num,$partake_num,$fees,
                                 $tag,$area_id,$merchant_id,$sub_id,$time_id){
        $data=array('event_name'=>$event_name,
            'event_image'=>$event_image,
            'event_describe'=>$event_describe,
            'event_time'=>$event_time,
            'note'=>$note,
            'notice_num'=>$notice_num,
            'partake_num'=>$partake_num,
            'tag'=>$tag,
            'fees'=>$fees,
            'area_id'=>$area_id,
            'merchant_id'=>$merchant_id,
            'sub_id'=>$sub_id,
            'time_id'=>$time_id
        );
        $this->db->insert('t_event_information',$data);

        $new_id_number = $this->db->insert_id();//获取插入数据的新的ID,此行代码必须放在insert之后。
    }

    //更新活动信息
    public function event_update($event_id,$event_name,$event_image,$event_describe,$event_time,$note,$notice_num,$partake_num,$tag,
    $area_id,$merchant_id,$sub_id,$time_id,$fees){
        $this->db->set('event_name', $event_name);
        $this->db->set('event_image',$event_image);
        $this->db->set('event_describe',$event_describe);
        $this->db->set('event_time',$event_time);
        $this->db->set('note',$note);
        $this->db->set( 'notice_num',$notice_num);
        $this->db->set('partake_num',$partake_num);
        $this->db->set('tag',$tag);
        $this->db->set( 'area_id',$area_id);
        $this->db->set('merchant_id',$merchant_id);
        $this->db->set( 'sub_id',$sub_id);
        $this->db->set( 'time_id',$time_id);
        $this->db->set( 'fees',$fees);
        $this->db->where('event_id',$event_id);
        $this->db->update('t_event_information');
        $this->db->affected_rows();
    }

    //查询活动信息
    public function event_query($currentpage,$tag,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('e.event_id,e.event_name,e.event_image,e.event_time.e.note,e.notice_num,e.partake_num,e.tag,
        e.fees,e.tag,a.area_name,t.merchant_name,t.address,t.contact,i.location,i.transport,s.sbu_name,g.day_detail
        ');
        if($tag!=''){
            $this->db->like('e.tag',$tag,'before');
            $this->db->like('e.tag',$tag,'after');
        }
        $this->db->from('t_event_information as e');
        $this->db->join('t_bas_area as a','a.area_id=e.area_id');
        $this->db->join('t_bas_merchant t','t.merchant_id=e.merchant_id');
        $this->db->join('t_bas_site i','t.site_id=i.site_id');
        $this->db->join('t_bas_subclass s','s.sub_id=e.sub_id');
        $this->db->join('t_time_arrange g','g.time_id=e.time_id');
        $this->db->order_by('e.event_id','desc');
        $this->db->limit($start_index,$pagesize);
        return $this->db->get();
    }

    //删除活动信息
    public  function event_delete($event_id){
        $this->db->where('event_id',$event_id);
        $this->db->delete('t_event_information');
    }
}

?>