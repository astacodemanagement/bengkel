<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();
        $this->load->model("datatables");

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("report_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


	public function index()
	{
        $push = [
            "pageTitle" => "Dashboard",
            "dataAdmin" => $this->dataAdmin,
            "today_income" => $this->report_model->get_today_income(),
            "today_service" => $this->report_model->get_today_transaction("service"),
            "today_items_sold" => $this->report_model->get_today_transaction("sparepart"),
            "items_sold_out" => $this->report_model->get_sold_out()
        ];

        $now = date("m");

        $before = $now - 5;

        $arrayTitle = [];
        $arrayNumber = [];
        $arrayValueSparepart = [];
        $arrayValueService = [];

        $month = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];

        for($i = $before;$i <= $now;$i++) {
            if($i <= 0) {
                $temp = 12 + $i;
                $arrayTitle[] = '"'.$month[$temp - 1]." ".(date("Y") - 1).'"';
            } else {
                $temp = $i;
                $arrayTitle[] = '"'.$month[$temp - 1]." ".date("Y").'"';
            }
            $arrayNumber[] = str_pad($temp,2,0,STR_PAD_LEFT);
            $arrayValueSparepart[] = 0;
            $arrayValueService[] = 0;
        }

        $data1 = $this->report_model->get_graph($arrayNumber)->result();
        $data2 = $this->report_model->get_graph($arrayNumber,"service")->result();

        foreach($data1 as $row) {
            $key = array_search(str_pad($row->date,2,0,STR_PAD_LEFT),$arrayNumber);
            $arrayValueSparepart[$key] = $row->total;
        }
        foreach($data2 as $row) {
            $key = array_search(str_pad($row->date,2,0,STR_PAD_LEFT),$arrayNumber);
            $arrayValueService[$key] = $row->total;
        }

        $push["title"] = $arrayTitle;
        $push["valueService"] = $arrayValueService;
        $push["valueSparepart"] = $arrayValueSparepart;

		$this->load->view('header',$push);
		$this->load->view('dashboard',$push);
		$this->load->view('footer',$push);
    }

    public function datatable_konsumen_ultah()
    {
        $this->datatables->setTable("consumers");
        $this->datatables->setColumn([
            '<index>',
            '<get-code>',
            '<get-name>',
            '<get-birthdate>',
            '[hitungUmur=<get-birthdate>]'
        ]);
        $this->datatables->setOrdering(["id","name",NULL]);
        $this->datatables->setWhere("DAY(birthdate)", date('d'));
        $this->datatables->setWhere("MONTH(birthdate)", date('m'));
        $this->datatables->setSearchField(["name","kode"]);
        $this->datatables->generate();
    }

    public function datatable_pegawai_absen()
    {
        $this->datatables->setTable("absensi");
        $this->datatables->setSelect("absensi.*,users.name");
        $this->datatables->setJoin("users", "users.id = absensi.user_id", "inner");
        $this->datatables->setWhere("tanggal", date('Y-m-d'));
        $this->datatables->setColumn([
            '<div class="text-center"><index></div>',
            '<div class="text-center"><get-name></div>',
            '<div class="text-center"><get-tanggal></div>',
            '<div class="text-center">[waktuAbsen=<get-waktu>]</div>',
            '<div class="text-center">[statusAbsen=<get-status>]</div>',
            '<div class="text-center"><get-keterangan></div>'
        ]);
        $this->datatables->setOrdering(["id", "tanggal", "waktu", "status", NULL]);
        $this->datatables->setSearchField(['tanggal', 'status', 'keterangan']);
        $this->datatables->generate();
    }

    public function datatableIncome()
    {

    }

    public function datatable_stok_menipis()
    {
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-kode>',
            '<get-name>',
            '<get-description>',
            '<get-stock>',
            '<div class="text-center">
                <button type="button" class="btn btn-secondary btn-sm btn-detail" title="Detail Data" data-id="<get-id>" data-kode="<get-kode>" data-name="<get-name>" data-price="<get-price>" data-price1="<get-price1>" data-price2="<get-price2>" data-price3="<get-price3>" data-location="<get-location>" data-description="<get-description>" data-gambar="[showSparepartImage=<get-gambar>]"><i class="fa fa-eye"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["id","name","price","stock",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setWhere("stock >","0");
        $this->datatables->setWhere("stock <=","5");
        $this->datatables->setSearchField(["name","description","kode"]);
        $this->datatables->generate();
    }
    
}
