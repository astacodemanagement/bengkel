<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchase extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("supplier_model");
        $this->load->model("purchase_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {
        if(!hasPermission('pembelian stok', 'index')) {
            show_error('Access Denied');
        }

        $push = [
            "pageTitle" => "Pembelian Stock",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('purchase', $push);
        $this->load->view('footer', $push);
    }

    public function detail($id = 0)
    {
        $query = $this->purchase_model->get($id);
        if ($query->num_rows() > 0) {
            $response = $query->row_array();
            $response["items"] = $this->purchase_model->get_details($id)->result_array();
            echo json_encode($response);
        }
    }

    public function new()
    {
        if (!hasPermission('pembelian stok', 'add')) {
            show_error('Access Denied');
        }

        $push = [
            "pageTitle" => "Tambah Pembelian Stock",
            "dataAdmin" => $this->dataAdmin,
            "suppliers" => $this->supplier_model->get()->result()
        ];

        $this->load->view('header', $push);
        $this->load->view('purchase_compose', $push);
        $this->load->view('footer', $push);
    }

    public function json()
    {
        $actionDatatable = '';

        if (hasPermission('pembelian stok', 'detail')) {
            $actionDatatable .= '<button type="button" class="btn btn-sm btn-warning btn-view" title="Lihat Data" data-id="<get-id>"><i class="fa fa-eye"></i></button>';
        }

        if (hasPermission('pembelian stok', 'edit')) {
            $actionDatatable .= '<a href="[base_url=purchase/print/<get-id>]" class="btn btn-primary btn-sm ml-1" title="Print Data"><i class="fa fa-print"></i></a>';
        }

        if (hasPermission('pembelian stok', 'delete')) {
            $actionDatatable .= '<a href="#" class="btn btn-danger btn-sm btn-delete ml-1" title="Delete Data" data-id="<get-id>" data-href="<?= base_url("purchase/delete"); ?><i class="fa fa-trash"></i></a>';
        }

        $this->load->model("datatables");
        $this->datatables->setSelect("purchase.*,suppliers.name");
        $this->datatables->setTable("purchase");
        $this->datatables->setJoin("suppliers", "suppliers.id = purchase.supplier_id", "left");
        $this->datatables->setColumn([
            '<index>',
            '[reformat_date=<get-date>]',
            '<get-name>',
            '[rupiah=<get-total>]',
            '<div class="text-center">'. $actionDatatable .'</div>'
        ]);
        $this->datatables->setOrdering(["id", "date", "name", "total", NULL]);
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    public function json_product()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("products");
        $this->datatables->setColumn([
            '<get-name>',
            '<div class="text-center"><button type="button" class="btn btn-warning btn-sm btn-choose" data-id="<get-id>" data-name="<get-name>" data-stock="<get-stock>"><i class="fa fa-check"></i></button></div>'
        ]);
        $this->datatables->setOrdering(["name", NULL]);
        $this->datatables->setWhere("type", "sparepart");
        $this->datatables->setSearchField("name");
        $this->datatables->generate();
    }

    public function create()
    {
        $data = json_decode($this->input->raw_input_stream, TRUE);

        if (!$data['supplier_id'] or !$data['total']) {
            $response = [
                "status" => FALSE,
                "msg" => "Harap periksa kembali data anda"
            ];
        } else {
            $response = [
                "status" => TRUE,
                "msg" => "Data pembelian telah ditambahkan"
            ];

            $insertData = [
                "id" => NULL,
                "date" => date("Y-m-d H:i:s"),
                "total" => $data["total"],
                "supplier_id" => $data["supplier_id"],
                "description" => $data['description']
            ];

            $purchase_id = $this->purchase_model->post($insertData);

            $items_batch = [];
            $stock_batch = [];

            foreach ($data["details"] as $detail) {
                $temp = array();
                $temp["id"] = NULL;
                $temp["purchase_id"] = $purchase_id;
                $temp["product_id"] = $detail["product_id"];
                $temp["price"] = $detail["price"];
                $temp["qty"] = $detail["qty"];

                $tempStock = array();
                $tempStock["id"] = $detail["product_id"];
                $tempStock["stock"] = $detail["product_stock"] + $detail["qty"];

                $items_batch[] = $temp;
                $stock_batch[] = $tempStock;
            }

            $this->purchase_model->post_details($items_batch);
            $this->purchase_model->update_stock($stock_batch);
        }

        echo json_encode($response);
    }

    function print($id = 0)
    {
        $query = $this->purchase_model->get($id);

        if ($query->num_rows() > 0) {
            $fetch = $query->row();

            $push = [
                "fetch" => $fetch,
                "details" => $this->purchase_model->get_details($id)->result()
            ];

            $title = "Invoice";

            $this->load->library("pdf");

            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->filename = $title;
            $this->pdf->load_view('purchase_pdf', $push);
        }
    }
    public function delete($id = 0)
    {
        if ($id) {
            $response["status"] = FALSE;
            $response["msg"] = "Gagal menghapus data pembelian";

            $query = $this->purchase_model->get($id);
            if ($query->num_rows() > 0) {
                $this->purchase_model->delete($id);
                $response["status"] = TRUE;
                $response["msg"] = "Data pembelian berhasil dihapus";
            }

            echo json_encode($response);
        }
    }
}
