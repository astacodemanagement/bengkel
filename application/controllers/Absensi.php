<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("absensi_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function index()
	{

        $push = [
            "pageTitle" => "Absensi",
            "dataAdmin" => $this->dataAdmin 
        ];

		$this->load->view('header',$push);
		$this->load->view('absensi',$push);
		$this->load->view('footer',$push);
    }
    
    public function json() {
        $this->load->model("datatables");
        $this->datatables->setTable("absensi");
        $this->datatables->setColumn([
            '<index>',
            '<get-tanggal>',
            '<get-jumlah_hari_kerja>',
            '<get-jumlah_masuk_kerja>',
            '<get-jumlah_absen_kerja>',
            '[number_format=<get-uang_harian>]',
            '[number_format=<get-bonus>]',
            '[number_format=<get-kasbon>]',
            '[number_format=<get-total_gaji>]',
            '<get-keterangan>',
            '<div class="text-center"><button type="button" class="btn btn-primary btn-sm btn-edit" title="Edit Data" data-id="<get-id>"><i class="fa fa-edit"></i></button>
            <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" title="Delete Data"><i class="fa fa-trash"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["id","name","address","telephone",NULL]);
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    function get($id = 0) {
        $query = $this->absensi_model->get($id);
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

            $this->absensi_model->delete($id);

            echo json_encode($response);
        }
    }

    private function proccess($action = "add",$id = 0) {
        $tanggal = $this->input->post("tanggal");
        $user = $this->input->post("user");
        $jumlah_hari_kerja = $this->input->post("jumlah_hari_kerja");
        $jumlah_masuk_kerja = $this->input->post("jumlah_masuk_kerja");
        $jumlah_absen_kerja = $this->input->post("jumlah_absen_kerja");
        $uang_harian = $this->input->post("uang_harian");
        $bonus = $this->input->post("bonus");
        $kasbon = $this->input->post("kasbon");
        $keterangan = $this->input->post("keterangan");
        $total_gaji = 0;

        if($tanggal == null OR $user == null OR $jumlah_hari_kerja == null OR $jumlah_masuk_kerja == null OR $jumlah_absen_kerja == null OR $uang_harian == null OR $bonus == null OR $kasbon == null) {
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data yang anda masukkan"
            ];
        } else {
            $insertData = [
                "id" => NULL,
                "tanggal" => $tanggal,
                "users_id" => $user,
                "jumlah_hari_kerja" => $jumlah_hari_kerja,
                "jumlah_masuk_kerja" => $jumlah_masuk_kerja,
                "jumlah_absen_kerja" => $jumlah_absen_kerja,
                "uang_harian" => $uang_harian,
                "bonus" => $bonus,
                "kasbon" => $kasbon,
                "total_gaji" => $total_gaji,
                "keterangan" => $keterangan
            ];

            $response["status"] = TRUE;

            if($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
    
                $this->absensi_model->post($insertData);
            } else {
                $response['msg'] = "Data berhasil diedit";

                unset($insertData["id"]);
    
                $this->absensi_model->put($id,$insertData);
            }

        }

        echo json_encode($response);
    }
}
