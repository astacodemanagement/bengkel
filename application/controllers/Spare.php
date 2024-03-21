<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spare extends CI_Controller {
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
            '<get-description>',
            '<get-stock>',
            '[showSparepartImageTable=<get-gambar>]',
            '<div class="text-center">
            <button type="button" class="btn btn-secondary btn-sm btn-detail" title="Detail Data" data-id="<get-id>" data-kode="<get-kode>" data-name="<get-name>" data-price="<get-price>" data-price1="<get-price1>" data-price2="<get-price2>" data-price3="<get-price3>" data-location="<get-location>" data-description="<get-description>" data-gambar="[showSparepartImage=<get-gambar>]"><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-primary btn-sm btn-edit" title="Edit Data" data-id="<get-id>" data-kode="<get-kode>" data-name="<get-name>" data-price="<get-price>" data-price1="<get-price1>" data-price2="<get-price2>" data-price3="<get-price3>" data-location="<get-location>" data-description="<get-description>" data-gambar="[showSparepartImage=<get-gambar>]"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" title="Delete Data"><i class="fa fa-trash"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["id","name","price","stock",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setSearchField(["name","description","kode"]);
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
        $location = $this->input->post("location");
        $description = $this->input->post("description");

        if(!$name OR !$price) {
            $response['status'] = FALSE;
            $response['msg'] = "Periksa kembali data yang anda masukkan";

            echo json_encode($response);
        } else {

            try {
                $insertData = [
                    "id" => NULL,
                    "kode" => $kode,
                    "name" => $name,
                    "price" => $price,
                    "price1" => $price1,
                    "price2" => $price2,
                    "price3" => $price3,
                    "location" => $location,
                    "description" => $description,
                    "type" => "sparepart",
                    "stock" => 0
                ];

                if (strlen($_FILES['gambar']['tmp_name']) > 0) {
                    $uploadPath = FCPATH.'uploads/sparepart/';
    
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
    
                    if (!$this->upload->do_upload('gambar')) {
                        $data['error'] = $this->upload->display_errors();
                        throw new Exception($this->upload->display_errors());
                    } else {
                        $insertData['gambar'] = $this->upload->data()['file_name'];
                    }

                    if ($id != 0) {
                        $product = $this->db->get_where('products', ['id' => $id])->row();
                        
                        if ($product->gambar != null) {
                            if (file_exists($uploadPath . '/' . $product->gambar)) {
                                unlink($uploadPath . '/' . $product->gambar);
                            }
                        }
                    }
                }
    
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

                echo json_encode($response);
            } catch (\Exception $e) {
                $response['status'] = FALSE;
                $response['msg'] = $e->getMessage();

                echo json_encode($response);
            }

        }
    }

     

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