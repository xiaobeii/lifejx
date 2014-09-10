<?php

class Person_model extends CI_Model {

    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //注册人员信息列表
    public function regetister($person_no,$password,$person_name,$telephone,$person_icon,$birthday,$sex,$avocation,$occupation_id,$address){
        $data=array(
           'person_no'=> $person_no,
            'password'=> $password,
            'person_name'=> $person_name,
            'telephone'=> $telephone,
            'person_icon'=> $person_icon,
            'birthday'=> $birthday,
            'sex'=> $sex,
            'avocation'=> $avocation,
            'occupation_id'=> $occupation_id,
            'address'=> $address
        );
        $this->db->insert('t_bas_person',$data);
    }

    //验证登入信息,通过控制器进行页面跳转控制
   public function login_status($person_no,$password){
       $this->db->select('person_no','person_name','person_icon');
       $this->db->from('t_bas_person');
       $condition="person_no= $person_no AND password= $password";
       $this->db->where($condition);
       $query=$this->db->get();
      if($query-> now_rows()>0){
          $newdata=array('status'=>'yes');
          $this->session->set_userdata($newdata);
       return true;
      }
       $olddata=array('status'=>'no');
       $this->session->set_userdata($olddata);
       return false;
   }

    //删除人员注册信息
    public function  person_delete($person_id){
        $this->db->where('person_id',$person_id);
        $this->db->delete('t_bas_person');
    }

}
?>