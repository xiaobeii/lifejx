<?php
/**
 * Created by PhpStorm.
 * User: DELL-1
 * Date: 14-9-3
 * Time: 下午9:31
 */
class Merchant_model extends CI_Model{
    public function __construct() {
        parent::__construct ();
        $this->load->database();
        $this->load->library('session');
    }

    //插入商户信息
    public function merchant_insert($address,$contact,$license,$merchant_name,$person_id,$scope,$site_id,$store){
        $this->db->set('address',$address);
        $this->db->set('contact',$contact);
        $this->db->set('license',$license);
        $this->db->set('merchant_name',$merchant_name);
        $this->db->set('person_id',$person_id);
        $this->db->set('scope',$scope);
        $this->db->set('site_id',$site_id);
        $this->db->set('store',$store);
        $this->db->insert('t_bas_merchant');
    }

    //更新商户信息
    public function  merchant_update($address,$contact,$license,$merchant_name,$person_id,$scope,$site_id,$store,$merchant_id){
        $this->db->set('address',$address);
        $this->db->set('contact',$contact);
        $this->db->set('license',$license);
        $this->db->set('merchant_name',$merchant_name);
        $this->db->set('person_id',$person_id);
        $this->db->set('scope',$scope);
        $this->db->set('site_id',$site_id);
        $this->db->set('store',$store);
        $this->db->where('merchant_id',$merchant_id);
        $this->db->update('t_bas_merchant');
    }

    //删除用户信息
    public function merchant_delete($merchant_id){
        $this->db->where('merchant_id',$merchant_id);
        $this->db->delete('t_bas_merchant');
    }

}
?>