<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("product_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function index()
	{

        $push = [
            "pageTitle" => "Sparepart",
            "dataAdmin" => $this->dataAdmin 
        ];

		$this->load->view('header',$push);
		$this->load->view('sparepart',$push);
		$this->load->view('footer',$push);
    }
    
    public function json() {
        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-kode>',
            '<get-name>',
            '[rupiah=<get-price>]',
            '[rupiah=<get-price1>]',
            '[rupiah=<get-price2>]',
            '[rupiah=<get-price3>]',
            '<get-stock>',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" data-kode="<get-kode>" data-name="<get-name>" data-price="<get-price>" data-price1="<get-price1>" data-price2="<get-price2>" data-price3="<get-price3>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>"><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id","name","price","stock",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    function insert() {
        $this->process();
    }

    function update($id) {
        $this->process("edit",$id);
    }

    private function process($action = "add",$id = 0) {
        $name = $this->input->post("name");
        $kode = $this->input->post("kode");
        $price = $this->input->post("price");
        $price1 = $this->input->post("price1");
        $price2 = $this->input->post("price2");
        $price3 = $this->input->post("price3");
        $gambar = $this->input->post("gambar");

        if(!$name OR !$price) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";
        } else {
            $insertData = [
                "id" => NULL,
                "kode" => $kode,
                "name" => $name,
                "price" => $price,
                "price1" => $price1,
                "price2" => $price2,
                "price3" => $price3,
                "gambar" => $gambar,
                "type" => "sparepart",
                "stock" => 0
            ];

            $response['status'] = TRUE;

            if($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
                $this->product_model->post($insertData);
            } else {
                unset($insertData['id']);
                unset($insertData['type']);
                unset($insertData['stock']);

                $response['msg'] = "Data berhasil diedit";
                $this->product_model->put($id,$insertData);
            }

        }

        echo json_encode($response);
    }

    // private function process($action = "add", $id = 0) {
    //     $name = $this->input->post("name");
    //     $kode = $this->input->post("kode");
    //     $price = $this->input->post("price");
    //     $price1 = $this->input->post("price1");
    //     $price2 = $this->input->post("price2");
    //     $price3 = $this->input->post("price3");
    
    //     if (!$name || !$price) {
    //         $response['status'] = FALSE;
    //         $response['msg'] = "Periksa kembali data yang Anda masukkan";
    //     } else {
    //         $insertData = [
    //             "kode" => $kode,
    //             "name" => $name,
    //             "price" => $price,
    //             "price1" => $price1,
    //             "price2" => $price2,
    //             "price3" => $price3,
    //             "type" => "sparepart",
    //             "stock" => 0
    //         ];
    
    //         // Jika ada file gambar yang diunggah
    //         if (!empty($_FILES['gambar']['name'])) {
    //             $config['upload_path'] = './assets/upload/';
    //             $config['allowed_types'] = 'gif|jpg|jpeg|png';
    //             $config['max_size'] = 2048; // 2MB
    
    //             $this->load->library('upload', $config);
    
    //             if ($this->upload->do_upload('gambar')) {
    //                 $upload_data = $this->upload->data();
    //                 $insertData['gambar'] = 'assets/upload/' . $upload_data['file_name'];
    //             } else {
    //                 $response['status'] = FALSE;
    //                 $response['msg'] = $this->upload->display_errors();
    //                 echo json_encode($response);
    //                 return;
    //             }
    //         }
    
    //         $response['status'] = TRUE;
    
    //         if ($action == "add") {
    //             $response['msg'] = "Data berhasil ditambahkan";
    //             $this->product_model->post($insertData);
    //         } else {
    //             $response['msg'] = "Data berhasil diedit";
    //             $this->product_model->put($id, $insertData);
    //         }
    //     }
    
    //     echo json_encode($response);
    // }

    function delete($id) {
        $response = [
            'status' => FALSE,
            'msg' => "Data gagal dihapus"
        ];

        if($this->product_model->delete($id)) {
            $response = [
                'status' => TRUE,
                'msg' => "Data berhasil dihapus"
            ];
        }

        echo json_encode($response);
    }
}