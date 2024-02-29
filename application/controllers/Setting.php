<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function shop_info()
	{

        $push = [
            "pageTitle" => "Pengaturan",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header',$push);
		$this->load->view('setting',$push);
        $this->load->view('footer',$push);
    }
	public function change_password()
	{

        $push = [
            "pageTitle" => "Ganti Password",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header',$push);
		$this->load->view('change_password',$push);
        $this->load->view('footer',$push);
    }

    public function save_info() {
        $name = $this->input->post("name");
        $address = $this->input->post("address");
        $image = null;

        if($name and $address) {
            if (strlen($_FILES['image']['tmp_name']) > 0) {
                $uploadPath = FCPATH . 'uploads/images/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, TRUE);
                }

                $this->load->library('upload');

                $config['upload_path']          = $uploadPath;
                $config['allowed_types']        = 'gif|jpg|jpeg|png';
                $config['overwrite']            = true;
                $config['max_size']             = 5120; // 5MB
                $config['encrypt_name'] = TRUE;

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    $shopInfo = $this->db->get('shop_info')->row();

                    if ($shopInfo) {
                        if ($shopInfo->image != null) {
                            unlink($uploadPath . '/' . $shopInfo->image);
                        }
                    }

                    $image = $this->upload->data()['file_name'];
                }
            }

            $response = [
                "status" => TRUE,
                "msg" => "Info bengkel telah diperbaharui"
            ];

            $this->user_model->set_shop(["name" => $name,"address" => $address, 'image' => $image]);
        } else {
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data anda"
            ];
        }

        echo json_encode($response);
    }

    function save_password() {
        $oldpw = $this->input->post("oldpw");
        $newpw1 = $this->input->post("newpw1");
        $newpw2 = $this->input->post("newpw2");

        if(!password_verify($oldpw,$this->dataAdmin->password)) {
            $response = [
                "status" => FALSE,
                "msg" => "Password lama yang anda masukkan salah"
            ];
        } else {
            if(!$newpw1 AND !$newpw2) {
                $response = [
                    "status" => FALSE,
                    "msg" => "Masukkan password baru"
                ];
            } else {
                if($newpw1 != $newpw2) {
                    $response = [
                        "status" => FALSE,
                        "msg" => "Ulangi password baru dengan benar"
                    ];
                } else {
                    $response = [
                        "status" => TRUE,
                        "msg" => "Password telah diganti"
                    ];

                    $this->user_model->set_user($this->dataAdmin->id,["password" => password_hash($newpw1,PASSWORD_BCRYPT)]);
                }
            }
        }

        echo json_encode($response);
    }
}
?>