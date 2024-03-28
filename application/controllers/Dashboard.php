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

        if ($this->input->get('start_month') && $this->input->get('end_month')) {
            $startMonth = date('m', strtotime($this->input->get('start_month')));
            $endMonth = date('m', strtotime($this->input->get('end_month')));

            $this->datatables->setWhere("MONTH(birthdate) >= ", $startMonth);
            $this->datatables->setWhere("MONTH(birthdate) <= ", $endMonth);
        } else {
            $this->datatables->setWhere("DAY(birthdate)", date('d'));
            $this->datatables->setWhere("MONTH(birthdate)", date('m'));
        }

        $this->datatables->setSearchField(["name","kode"]);
        $this->datatables->generate();
    }

    public function datatable_pendapatan_hari_ini()
    {
        $this->datatables->setTable("transactions");
        $this->datatables->setColumn([
            '<index>',
            '<get-code>',
            '[rupiah=<get-total>]'
        ]);
        $this->datatables->setOrdering(["id","name",NULL]);
        $this->datatables->setWhere("DATE(date)", date('Y-m-d'));
        $this->datatables->setSearchField(["kode"]);
        $this->datatables->generate();
    }

    public function datatable_income()
    {
        $this->datatables->setTable("transactions");
        $this->datatables->setSelect("transactions.*,consumers.name");
        $this->datatables->setJoin("consumers", "consumers.id = transactions.customer_id", "left");
        $this->datatables->setColumn([
            '<index>',
            '<get-code>',
            '<get-name>',
            '[rupiah=<get-total>]'
        ]);
        $this->datatables->setOrdering(["id","name",NULL]);
        $this->datatables->setWhere("DATE(date)", date('Y-m-d'));
        $this->datatables->setSearchField(["kode"]);
        $this->datatables->generate();
    }

    public function datatable_pegawai_absen()
    {
        $this->datatables->setTable("absensi");
        $this->datatables->setSelect("absensi.*,users.name");
        $this->datatables->setJoin("users", "users.id = absensi.user_id", "inner");
        
        if ($this->input->get('start_month') && $this->input->get('end_month')) {
            $startMonth = date('Y-m-01', strtotime($this->input->get('start_month')));
            $endMonth = date('Y-m-t', strtotime($this->input->get('end_month')));

            $this->datatables->setWhere("tanggal >= ", $startMonth);
            $this->datatables->setWhere("tanggal <= ", $endMonth);
        } else {
            $this->datatables->setWhere("tanggal", date('Y-m-d'));
        }

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

    public function datatable_stok_menipis()
    {
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-kode>',
            '<get-name>',
            '<get-stock>'
        ]);
        $this->datatables->setOrdering(["id","name","price","stock",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setWhere("stock >","0");
        $this->datatables->setWhere("stock <=","5");
        $this->datatables->setSearchField(["name","description","kode"]);
        $this->datatables->generate();
    }

    public function datatable_stok_habis()
    {
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<index>',
            '<get-kode>',
            '<get-name>'
        ]);
        $this->datatables->setOrdering(["id","name","price","stock",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setWhere("stock","0");
        $this->datatables->setSearchField(["name","description","kode"]);
        $this->datatables->generate();
    }

    // public function datatable_sparepart_terlaris()
    // {
    //     $this->datatables->setTable("details");
    //     $this->datatables->setSelect("products.*, SUM(qty) as qty");
    //     $this->datatables->setJoin("products", "products.id = details.product_id", "inner");
    //     $this->datatables->setWhere("products.type", "sparepart");
    //     $this->datatables->setGroup("product_id");
    //     $this->datatables->setColumn([
    //         '<index>',
    //         '<get-kode>',
    //         '<get-name>',
    //         '<get-qty>'
    //     ]);
    //     $this->datatables->setSearchField(["name","kode"]);
    //     $this->datatables->generate();
    // }

    public function datatable_servis_selesai()
    {
        $this->datatables->setTable("details");
        $this->datatables->setSelect("products.*, DATE(transactions.date) as date, transactions.total, transactions.code");
        $this->datatables->setJoin("products", "products.id = details.product_id", "inner");
        $this->datatables->setJoin("transactions", "transactions.id = details.transaction_id", "inner");
        $this->datatables->setWhere("products.type", "service");
        
        if ($this->input->get('start_month') && $this->input->get('end_month')) {
            $startMonth = date('Y-m-01', strtotime($this->input->get('start_month')));
            $endMonth = date('Y-m-t', strtotime($this->input->get('end_month')));

            $this->datatables->setWhere("DATE(date) >= ", $startMonth);
            $this->datatables->setWhere("DATE(date) <= ", $endMonth);
        } else {
            $this->datatables->setWhere("DATE(date)", date('Y-m-d'));
        }

        $this->datatables->setColumn([
            '<index>',
            '<get-date>',
            '<get-code>',
            '<get-name>',
            '[rupiah=<get-total>]'
        ]);
        $this->datatables->setOrdering(["index", "date", "code", "name", "total"]);
        $this->datatables->setSearchField(["code", "name", "date", "total"]);
        $this->datatables->generate();
    }

    public function datatable_item_terjual()
    {
        $this->datatables->setTable("details");
        $this->datatables->setSelect("products.*, SUM(qty) as qty");
        $this->datatables->setJoin("products", "products.id = details.product_id", "inner");
        $this->datatables->setWhere("products.type", "sparepart");
        $this->datatables->setGroup("product_id");
        $this->datatables->setColumn([
            '<index>',
            '<get-kode>',
            '<get-name>',
            '<get-qty>'
        ]);
        $this->datatables->setOrdering(["index", "kode", "name", "qty"]);
        $this->datatables->setSearchField(["kode", "name", "qty"]);
        $this->datatables->generate();
    }
    
}
