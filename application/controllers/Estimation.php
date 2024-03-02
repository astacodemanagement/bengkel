<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estimation extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();
        $this->load->model('Consumer_model'); // Sesuaikan dengan nama model yang Anda buat

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("transaction_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }



    public function getConsumerData()
    {
        $term = $this->input->get('term');
        $data = $this->Consumer_model->searchConsumer($term);

        echo json_encode(['results' => $data]); // Sesuaikan format respons sesuai kebutuhan Select2
    }


    public function index()
    {

        $push = [
            "pageTitle" => "Estimasi",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('estimation', $push);
        $this->load->view('footer', $push);
    }

    function insert($action = "sparepart")
    {
        $data = json_decode($this->input->raw_input_stream, TRUE);

        $customer_id = null;
        $customer_name = null;

        if (isset($data['customer'])) {
            if ($data['customer'] != null) {
                $customer = $this->Consumer_model->get($data['customer'])->row();

                if ($customer) {
                    $customer_id = $customer->id;
                    $customer_name = $customer->name;
                }
            }
        }

        $estimationData = [
            "type" => $action,
            "total" => $data['total'],
            "date" => date("Y-m-d H:i:s"),
            "customer_id" => $customer_id,
            "customer_name" => $customer_name
        ];

        $detail_batch = [];

        foreach ($data['sparepart'] as $itemSp) {
            $temp = array();
            $temp["product_id"] = $itemSp["id"];
            $temp["name"] = $itemSp["name"];
            $temp["price"] = $itemSp["price"];
            $temp["qty"] = $itemSp["qty"];

            $detail_batch[] = $temp;
        }

        foreach ($data['service'] as $itemSrv) {
            $temp = array();
            $temp["product_id"] = $itemSrv["id"];
            $temp["name"] = $itemSrv["name"];
            $temp["price"] = $itemSrv["price"];
            $temp["qty"] = $itemSrv["qty"];

            $detail_batch[] = $temp;
        }

        $this->session->set_userdata('estimation_detail', $detail_batch);
        $this->session->set_userdata('estimation', $estimationData);

        $response = [
            "status" => TRUE,
            "type" => $action,
            "msg" => "Transaksi sukses",
            "id" => 0
        ];

        echo json_encode($response);
    }

    public function json_service()
    {
        $addFunc = "addServiceCart({id:<get-id>,name:'<get-name>',price:<get-price>})";

        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<get-name>',
            '[rupiah=<get-price>]',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success btn-add" onclick="' . $addFunc . '"><i class="fa fa-plus"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["name", "price", NULL]);
        $this->datatables->setWhere("type", "service");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }
    public function json_sparepart()
    {
        $addFunc = "addSparepartCart({id:<get-id>,name:'<get-name>',name:'<get-kode>',price:<get-price>,stock:<get-stock>})";

        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<get-name>',
            '<get-kode>',
            '[rupiah=<get-price>]',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success" onclick="' . $addFunc . '"><i class="fa fa-plus"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["name", "price", NULL]);
        $this->datatables->setWhere("type", "sparepart");
        $this->datatables->setSearchField("name","kode");
        $this->datatables->generate();
    }
    public function json_mekanik()
    {
        $addFunc = "addMekanikCart({id:<get-id>,name:'<get-name>',upah:0})";

        $this->load->model("datatables");
        $this->datatables->setTable("users");
        $this->datatables->setColumn([
            '<get-name>',
            '0',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success" onclick="' . $addFunc . '"><i class="fa fa-plus"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["name", NULL]);
        $this->datatables->setWhere("position", "Mekanik");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    public function print()
    {
        $arrDetail = [];

        foreach($this->session->userdata('estimation_detail') as $sess) {
            $arrDetail[] = (object)$sess;
        }

        $push["fetch"] = (object)$this->session->userdata('estimation');
        $push["details"] = (object)$arrDetail;
        $push["customer"] = $this->session->userdata('estimation')['customer_id'] != null ? $this->Consumer_model->get($this->session->userdata('estimation')['customer_id'])->row() : null;

        $title = "Invoice";

        $this->load->library("pdf");

        $this->pdf->setPaper('A4', 'portrait');
        $this->pdf->filename = $title;

        $this->pdf->load_view("service_sales_pdf", $push);
    }
}
