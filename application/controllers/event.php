<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct() {
        parent::__construct ();
        $this-> load->model('event_model');
        //$this->load->helper(array('form', 'url'));
    }

    //初次载入
    //参数还没有定义
    public function index()
    {
        $res = $this->event_model -> event_query(1,0,20);
        $data['res'] = $res;


        $this->load->view('mianHeader');
        $this->load->view('eventBodyView', $data);
        $this->load->view('mainFooter');
    }

    //根据需要分页获取其他的活动，AJAX调用
    public function get_other_event($currentpage,$tag,$pagesize)
    {
        //错误预警判断

        //调用DB
        $res = $this->event_model -> event_query($currentpage, $tag, $pagesize);
        $data['res'] = $res;

        return $data;
    }

    //获取活动页Banner大图
    public  function get_banner_picture()
    {

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */