<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends CI_Controller {
    private $dataAdmin;

    function __construct() {
        parent::__construct();

        if(!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("transaction_model");
        $this->load->model("Consumer_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }
    
    public function getConsumerData() {
        $term = $this->input->get('term');
        $data = $this->Consumer_model->searchConsumer($term);
    
        echo json_encode(['results' => $data]); // Sesuaikan format respons sesuai kebutuhan Select2
    }

	public function index()
	{

        $push = [
            "pageTitle" => "Transaksi",
            "dataAdmin" => $this->dataAdmin 
        ];

		$this->load->view('header',$push);
		$this->load->view('transaction',$push);
		$this->load->view('footer',$push);
    }

    function insert($action = "sparepart") {
        $data = json_decode($this->input->raw_input_stream,TRUE);

        $customer_id = null;
        $customer_name = null;
        $customer_type = null;

        if ($data['customer'] != null) {
            $customer = $this->Consumer_model->get($data['customer'])->row();

            if ($customer) {
                $customer_id = $customer->id;
                $customer_name = $customer->name;
                $customer_type = $customer->tipe;
            }
        }

        // $customer = NULL;
        // $plat = NULL;

        // if($action == "service") {
        //     $customer = $data['customer'];
        //     $plat = $data['plat'];
        // }
        
        $push = [
            "id" => NULL,
            "code" => $this->generateTransactionCode(),
            "type" => $action,
            "total" => $data['total'],
            "mechanical_costs" => $data['mechanical_costs'],
            // "date" => date("Y-m-d H:i:s"),
            "customer_id" => $customer_id,
            "customer_name" => $customer_name,
            "plat" => $data['plat'],
            "km" => $data['km'],
            "car_type" => $data['car_type'],
            "description" => $data['description'],
            "date" => isset($data['date']) ? $data['date'] : null,

        ];

        $transaction_id = $this->transaction_model->create($push);

        $sparepart_batch = [];
        $service_batch = [];
        $stock_batch = [];
        $mechanic_batch = [];

        foreach($data['sparepart'] as $itemSp) {
            $temp = array();
            $price = $itemSp["price3"];

            if ($customer_type == 'Platinum') {
                $price = $itemSp["price1"];
            }

            if ($customer_type == 'Gold') {
                $price = $itemSp["price2"];
            }

            $temp["id"] = NULL;
            $temp["transaction_id"] = $transaction_id;
            $temp["product_id"] = $itemSp["id"];
            $temp["name"] = $itemSp["name"];
            $temp["price"] = $price;
            $temp["qty"] = $itemSp["qty"];

            $stocktmp = array();
            $stocktmp["id"] = $itemSp["id"];
            $stocktmp["stock"] = $itemSp["stock"] - $itemSp["qty"];

            $sparepart_batch[] = $temp;
            $stock_batch[] = $stocktmp;
        }

        foreach($data['service'] as $itemSrv) {
            $temp = array();
            $temp["id"] = NULL;
            $temp["transaction_id"] = $transaction_id;
            $temp["product_id"] = $itemSrv["id"];
            $temp["name"] = $itemSrv["name"];
            $temp["price"] = $itemSrv["price"];
            $temp["qty"] = $itemSrv["qty"];

            $service_batch[] = $temp;
        }

        foreach($data['mechanic'] as $itemMch) {
            $temp = array();
            $temp["id"] = NULL;
            $temp["transaction_id"] = $transaction_id;
            $temp["user_id"] = $itemMch["id"];
            $temp["cost"] = $itemMch["cost"];
            $temp["date"] = isset($itemMch["date"]) ? $itemMch["date"] : date("Y-m-d H:i:s");
            // $temp["date"] = date("Y-m-d H:i:s");

            $mechanic_batch[] = $temp;
        }

        if($sparepart_batch) {
            $this->transaction_model->post_details($sparepart_batch);
            $this->transaction_model->sparepart_update($stock_batch);
        }

        if($service_batch) {
            $this->transaction_model->post_details($service_batch);
        }

        if($mechanic_batch) {
            $this->transaction_model->post_mechanic_details($mechanic_batch);
        }

        $response = [
            "status" => TRUE,
            "type" => $action,
            "msg" => "Transaksi sukses",
            "id" => $transaction_id
        ];

        echo json_encode($response);
    }
    
    public function json_service() {
        $addFunc = "addServiceCart({id:<get-id>,name:'<get-name>',price:<get-price>})";

        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<get-name>',
            '<get-kode>',
            '[rupiah=<get-price>]',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success btn-add" onclick="'.$addFunc.'"><i class="fa fa-plus"></i></button>
                
            </div>'
        ]);
        $this->datatables->setOrdering(["name","price",NULL]);
        $this->datatables->setWhere("type","service");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }
    public function json_sparepart() {
        $base_url = $this->config->base_url();
        $addFunc = "addSparepartCart({id:<get-id>,name:'<get-name>',price:<get-price>,price1:<get-price1>,price2:<get-price2>,price3:<get-price3>,stock:<get-stock>,gambar:'$base_url/uploads/sparepart/<get-gambar>'})";
        $detailData = "detailData({id:<get-id>,name:'<get-name>',location:'<get-location>',description:'<get-description>',gambar:'$base_url/uploads/sparepart/<get-gambar>'})";

        $price = 'price3';

        if ($this->input->get('type') == 'Platinum') {
            $price = 'price1';
        }

        if ($this->input->get('type') == 'Gold') {
            $price = 'price2';
        }

        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<get-name>',
            '<get-kode>',
            '[rupiah=<get-' . $price . '>]',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success" onclick="'.$addFunc.'"><i class="fa fa-plus"></i></button>
                <button type="button" class="btn btn-sm btn-primary" onclick="'.$detailData.'"><i class="fa fa-eye"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["name","price",NULL]);
        $this->datatables->setWhere("type","sparepart");
        $this->datatables->setSearchField(["name","kode", "description"]);
        $this->datatables->generate();
    }

    public function json_mekanik() {
        $addFunc = "addMekanikCart({id:<get-id>,name:'<get-name>',cost:0})";

        $this->load->model("datatables");
        $this->datatables->setTable("users");
        $this->datatables->setColumn([
            '<get-name>',
            '',
            '0',
            '<div class="text-center">
                <button type="button" class="btn btn-sm btn-success" onclick="'.$addFunc.'"><i class="fa fa-plus"></i></button>
            </div>'
        ]);
        $this->datatables->setOrdering(["name",NULL]);
        $this->datatables->setWhere("position","Mekanik");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    private function generateTransactionCode()
    {
        $transaction = $this->db->order_by('id', 'desc')->get('transactions')->row();
        $initialCode = 'TRX';
        $codeLength = 10;
        $code = '0000000001';

        if ($transaction) {
            $transactionCode = preg_replace('/[^0-9]/', '', $transaction->code);
            $code = $transactionCode + 1;
        }

        return $initialCode . sprintf('%0'.$codeLength.'d', $code);
    }
}
