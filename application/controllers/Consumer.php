<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumer extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("consumer_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function index()
	{

        $push = [
            "pageTitle" => "Konsumen",
            "dataAdmin" => $this->dataAdmin 
        ];

		$this->load->view('header',$push);
		$this->load->view('consumer',$push);
		$this->load->view('footer',$push);
    }
    
    public function json() {
        $this->load->model("datatables");
        $this->datatables->setTable("consumers");
        $this->datatables->setColumn([
            '<index>',
            '<get-code>',
            '<get-name>',
            '<get-address>',
            '<get-telephone>',
            '<div class="text-center">
            <button type="button" class="btn btn-secondary btn-sm btn-detail" title="Edit Data" data-id="<get-id>"><i class="fa fa-eye"></i></button>
            <button type="button" class="btn btn-primary btn-sm btn-edit" title="Edit Data" data-id="<get-id>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" title="Delete Data"><i class="fa fa-trash"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["id","name","address","telephone",NULL]);
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    function get($id = 0) {
        $query = $this->consumer_model->get($id);
        if($query->num_rows()) {
            echo json_encode($query->row_array());
        }
    }

    function insert() {
        $this->proccess();
    }

    function edit($id = 0) {
        $this->proccess("edit",$id);
    }

    function delete($id = 0) {
        if($id) {
            $response["status"] = TRUE;
            $response["msg"] = "Data berhasil dihapus";

            $this->consumer_model->delete($id);

            echo json_encode($response);
        }
    }

    private function proccess($action = "add",$id = 0) {
        $code = $this->input->post("code");
        $name = $this->input->post("name");
        $birthplace = $this->input->post("birthplace");
        $birthdate = $this->input->post("birthdate");
        $address = $this->input->post("address");
        $telephone = $this->input->post("telephone");
        $description = $this->input->post("description");
        $tipe = $this->input->post("tipe");

        if(!$name OR !$address OR !$telephone OR !$description OR !$tipe) {
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data yang anda masukkan"
            ];
        } else {
            $insertData = [
                "id" => NULL,
                "code" => $code,
                "name" => $name,
                "birthplace" => $birthplace,
                "birthdate" => $birthdate,
                "address" => $address,
                "telephone" => $telephone,
                "description" => $description,
                "tipe" => $tipe
            ];

            $response["status"] = TRUE;

            if($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
    
                $this->consumer_model->post($insertData);
            } else {
                $response['msg'] = "Data berhasil diedit";

                unset($insertData["id"]);
    
                $this->consumer_model->put($id,$insertData);
            }

        }

        echo json_encode($response);
    }
}
