<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-4
 * Time: 下午9:08
 */
class Server_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入服务信息表
    public function server_insert($server_name,$sex,$school,$degree,$root,$photo,$image,$certificate_one,$certificate_two,
        $certificate_three,$contact,$ce,$fees,$total_num,$person_id,$stime_id,$sub_id,$occupation_id,$area_id){
        $this->db->set('server_name',$server_name);
        $this->db->set('sex',$sex);
        $this->db->set('school',$school);
        $this->db->set('degree',$degree);
        $this->db->set('root',$root);
        $this->db->set('photo',$photo);
        $this->db->set('image',$image);
        $this->db->set('certificate_one',$certificate_one);
        $this->db->set('certificate_two',$certificate_two);
        $this->db->set('certificate_three',$certificate_three);
        $this->db->set('contact',$contact);
        $this->db->set('ce',$ce);
        $this->db->set('fees',$fees);
        $this->db->set('total_num',$total_num);
        $this->db->set('person_id',$person_id);
        $this->db->set('stime_id',$stime_id);
        $this->db->set('sub_id',$sub_id);
        $this->db->set('occupation_id',$occupation_id);
        $this->db->set('area_id',$area_id);
        $this->db->insert('t_server_information');
    }

    //更新服务信息
    public function server_update($server_name,$sex,$school,$degree,$root,$photo,$image,$certificate_one,$certificate_two,
        $certificate_three,$contact,$ce,$fees,$total_num,$person_id,$stime_id,$sub_id,$occupation_id,$area_id,$server_id){
        $this->db->set('server_name',$server_name);
        $this->db->set('sex',$sex);
        $this->db->set('school',$school);
        $this->db->set('degree',$degree);
        $this->db->set('root',$root);
        $this->db->set('photo',$photo);
        $this->db->set('image',$image);
        $this->db->set('certificate_one',$certificate_one);
        $this->db->set('certificate_two',$certificate_two);
        $this->db->set('certificate_three',$certificate_three);
        $this->db->set('contact',$contact);
        $this->db->set('ce',$ce);
        $this->db->set('fees',$fees);
        $this->db->set('total_num',$total_num);
        $this->db->set('person_id',$person_id);
        $this->db->set('stime_id',$stime_id);
        $this->db->set('sub_id',$sub_id);
        $this->db->set('occupation_id',$occupation_id);
        $this->db->set('area_id',$area_id);
        $this->db->where('server_id',$server_id);
        $this->db->update('t_server_information');
    }

    //删除服务信息
    public function server_delete($server_id){
        $this->db->where('server_id',$server_id);
        $this->db->delete('t_server_information');
    }

    //查询服务信息
    public function  server_query($currentpage,$pagesize){
        if($currentpage==0){
            $currentpage=1;
        }
        $start_index=($currentpage-1)*$pagesize;
        $this->db->select('s.server_name,s.sex,s.school,s.degree,s.root,s.photo,s.image,s.certificate_one,s.certificate_two,
            s.certificate_three,s.contact,s.ce,s.fees,s.total_num,p.person_name,t.stime_begin,t.stime_end,d.day_detail,
            k.week_name,b.sub_name,c.ctg_name,o.occupation_name,a.area_name');
        $this->db->from('t_server_information as s');
        $this->db->join('t_bas_person as p','s.person_id=p.person_id');
        $this->db->join('t_server_time as t','s.stime_id=t.stime_id');
        $this->db->join('t_day_arrange as d','t.day_id=d.day_id');
        $this->db->join('t_bas_week as k','t.week_id=k.week_id');
        $this->db->join('t_bas_subclass as b','b.sub_id=s.sub_id');
        $this->db->join('t_bas_category as c','b.ctg_id=c.ctg_id');
        $this->db->join('t_bas_occupation as o','s.occupation_id=o.occupation_id');
        $this->db->join('t_bas_area as a','s.area_id=a.area_id');
        $this->db->orderby('s.server_id','desc');
        $this->db->limit($start_index,$pagesize);
        $this->db->get();
    }
}
?>