<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("absensi_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();

        // Load the Shop_info library
        $this->load->library('Shop_info');
    }


    public function index()
    {
        $uangHarian = $this->shop_info->get_shop_uang_harian();
        $push = [
            "pageTitle" => "Absensi",
            "uangHarian" => $uangHarian,
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('absensi', $push);
        $this->load->view('footer', $push);
    }

    public function getUserData()
    {
        $term = $this->input->get('term');
        $data = $this->user_model->searchUser($term);

        echo json_encode($data);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("absensi");

        if ($this->input->get('action') == 'filter' && $this->input->get('start_date') && $this->input->get('end_date')) {
            $this->datatables->setWhere("tanggal >=", $this->input->get('start_date'));
            $this->datatables->setWhere("tanggal <=", $this->input->get('end_date'));
        }
        
        $this->datatables->setWhere("user_id", $this->input->get('user'));

        $this->datatables->setColumn([
            '<div class="text-center"><index></div>',
            '<div class="text-center"><get-tanggal></div>',
            '<div class="text-center">[waktuAbsen=<get-waktu>]</div>',
            '<div class="text-center">[statusAbsen=<get-status>]</div>',
            '<div class="text-center"><get-keterangan></div>'
        ]);
        $this->datatables->setOrdering(["id", "tanggal", "waktu", "status", NULL]);
        $this->datatables->setSearchField(['tanggal', 'status', 'keterangan']);
        $this->datatables->generate();
    }

    public function hitung_absen()
    {
        header('Content-Type: application/json');

        $this->db->select('SUM(bonus_absen) as bonus_absen, count(id) as jumlah_masuk');
        $this->db->where(['user_id' => $this->input->get('user'), 'status' => 'MASUK']);

        if ($this->input->get('action') == 'filter' && $this->input->get('start_date') && $this->input->get('end_date')) {
            $this->db->where(["tanggal >=" => $this->input->get('start_date'), "tanggal <=" => $this->input->get('end_date')]);
        }

        $absen = $this->db->get('absensi')->row();

        echo json_encode($absen);
    }

    function get($id = 0)
    {
        $query = $this->absensi_model->get($id);
        if ($query->num_rows()) {
            echo json_encode($query->row_array());
        }
    }

    function checkin()
    {
        $this->proccess();
    }

    private function proccess()
    {
        $user = $this->input->post("user");
        $userAbsen = $this->db->get_where('absensi', ['user_id' => $user, 'tanggal' => date('Y-m-d')])->row();

        if ($user == null) {
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data yang anda masukkan"
            ];
        } else if ($userAbsen) {
            $response = [
                "status" => FALSE,
                "msg" => "Karyawan sudah melakukan absensi"
            ];
        } else {
            $maxWaktu = '08:15';
            $status = 'MASUK';
            $bonusAbsen = $this->input->post("bonus_absen");
            $keterangan = $this->input->post("keterangan");
            $uangHarian = $this->shop_info->get_shop_uang_harian() ?? 0;

            if (strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d') . ' ' . $maxWaktu)) {
                $status = 'TERLAMBAT';
                $bonusAbsen = 0;
            }

            $insertData = [
                "id" => NULL,
                "tanggal" => date('Y-m-d'),
                "user_id" => $user,
                "waktu" => date("H:i"),
                "bonus_absen" => $bonusAbsen,
                "uang_harian" => $uangHarian,
                "status" => $status,
                "keterangan" => $keterangan
            ];

            $response["status"] = TRUE;

            $response['msg'] = "Data berhasil ditambahkan";

            $this->absensi_model->post($insertData);
        }

        echo json_encode($response);
    }
}
