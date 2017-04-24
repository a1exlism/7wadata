<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Graphic extends MY_Controller
{
    private $user_id;

    public function __construct()
    {
        parent::__construct();

        $this->load->model('excels');
        $this->load->model('user');
        $this->load->model('projects');

        $this->user_id = $this->user->get_user_id($this->session->userdata('user_id'));

        if ($this->session_check() != 1) {
            echo '认证失败, 请重新登录';
            sleep(0.3);
            redirect('/user/login', 'location', 301);
        }
    }

    public function index($proj_id = 1)
    {
        $this->project($proj_id);
    }

    public function project($proj_id = 1)
    {
        $this->load->view('user/header', array(
            'username' => $this->session->userdata('user_id')
        ));

        $proj_nums = $this->get_proj_nums();

        if (empty($proj_nums)) {
            $this->load->view('user/proj_error');
        } elseif ($this->user->has_privilege($this->user_id, 'is_graphic') != 1) {
            $this->load->view('user/not_allowed');
        } else {
            $this->load->view('user/graphic', array(
                'proj_nums' => $proj_nums,
            ));
        }
        $this->load->view('user/footer');
    }
    
    public function get_proj_nums()
    {
        return $this->projects->proj_nums($this->user_id);
    }

    public function get_excel_id_arr($proj_id = 1)
    {
        $proj_id = $this->uri->segment(3) || 1;
        $res = $this->projects->get_excel_ids($this->user_id, $proj_id)->result();
        $arr = [];
        foreach ($res as $val) {
            array_push($arr, $val->{'excel_id'});
        }
        return $arr;
    }

    public function get_excels_results()
    {
        $excel_arr = $this->get_excel_id_arr(1);
        $contents = $this->excels->select_excels($excel_arr);

        echo json_encode($contents);
    }


    public function test()
    {
        echo "<pre>";
        // echo ($this->proj_id);
        echo "</pre>";
    }
}
