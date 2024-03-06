<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("report_model");
        $this->load->model("datatables");
        $this->load->model("transaction_model");
        $this->load->model("User_model", 'user');


        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }

    public function purchase()
    {

        $push = [
            "pageTitle" => "Laporan Pembelian",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('purchase_report', $push);
        $this->load->view('footer', $push);
    }

    public function sales()
    {
        $push = [
            "pageTitle" => "Laporan Penjualan",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('sales_report', $push);
        $this->load->view('footer', $push);
    }

    public function service()
    {
        $push = [
            "pageTitle" => "Laporan Service",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('service_report', $push);
        $this->load->view('footer', $push);
    }

    public function salary()
    {
        $startDate = $this->input->get('start_date');
        $endDate = $this->input->get('end_date');
        $user = $this->input->get('user');

        $where = null;
        $userData = null;

        if ($startDate != null && $endDate != null) {
            $where['transactions.date >='] = $startDate;
            $where['transactions.date <='] = $endDate;
        }

        if ($user != null) {
            $where['mechanic_details.user_id'] = $user;
            $userData = $this->user->get(['id' => $user])->row();
        }

        $transactions = $this->transaction_model->getSalaryData($where); // Assuming you have a function in Transaction_model.php to fetch salary data

        $push = [
            "pageTitle" => "Laporan Salary",
            "dataAdmin" => $this->dataAdmin,
            "transactions" => $transactions,
            "user" => $userData
        ];

        $this->load->view('header', $push);
        $this->load->view('salary_report', $push);
        $this->load->view('footer', $push);
    }

    public function getUserMekanikData()
    {
        $term = $this->input->get('term');
        $data = $this->user_model->searchUserWhere($term, ['position' => 'Mekanik']);

        echo json_encode(['results' => $data]); // Sesuaikan format respons sesuai kebutuhan Select2
    }

    public function getUserData()
    {
        $term = $this->input->get('term');
        $data = $this->user_model->searchUser($term);

        echo json_encode(['results' => $data]); // Sesuaikan format respons sesuai kebutuhan Select2
    }

    public function filterTransactions()
    {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $user_id = $this->input->post('user_id');

        $transactions = $this->transaction_model->getFilteredData($start_date, $end_date, $user_id);

        // Kirim data ke tampilan
        $data = [
            "pageTitle" => "Filtered Transactions",
            "dataAdmin" => $this->dataAdmin,
            "transactions" => $transactions,
        ];

        $this->load->view('header', $data);
        $this->load->view('filtered_transactions', $data);
        $this->load->view('footer', $data);
    }


    // Controller function
    public function getTransactionDetails()
    {
        $transactionId = $this->input->post('transaction_id');
        $details = $this->transaction_model->getTransactionDetails($transactionId);

        $data = [
            'details' => $details,
        ];

        $this->load->view('transaction_details', $data);
    }





    function json($type = "sparepart", $start = 0, $end = 0)
    {

        $this->datatables->setSelect("details.*,products.type,DATE(transactions.date) as date,SUM(details.qty * details.price) as total,SUM(qty) as items,transactions.customer_name,consumers.telephone");
        $this->datatables->setTable("details");
        $this->datatables->setJoin("products", "`products`.`id` = `details`.`product_id`", "left");
        $this->datatables->setJoin("transactions", "`transactions`.`id` = `details`.`transaction_id`", "left");
        $this->datatables->setJoin("consumers", "`consumers`.`id` = `transactions`.`customer_id`", "left");
        $this->datatables->setWhere("products.type", $type);

        if ($start and $end) {
            $this->datatables->setWhere("DATE(date) >=", $start);
            $this->datatables->setWhere("DATE(date) <=", $end);
        } else {
            $this->datatables->setWhere("MONTH(date)", date("m"));
            $this->datatables->setWhere("YEAR(date)", date("Y"));
        }

        $this->datatables->setGroup("transaction_id");

        if ($type == "sparepart") {
            $this->datatables->setColumn([
                '<index>',
                '<get-date>',
                '<get-items>',
                '[rupiah=<get-total>]'
            ]);
            $this->datatables->setOrdering(["transaction_id", "date", "items", "total"]);
        } else {
            $this->datatables->setColumn([
                '<index>',
                '<get-customer_name>',
                '<get-telephone>',
                '<get-date>',
                '[rupiah=<get-total>]'
            ]);
            $this->datatables->setOrdering(["transaction_id", "customer", "plat", "date", "total"]);
        }

        $this->datatables->setSearchField("date");
        $this->datatables->generate();
    }

    function purchase_json($start = 0, $end = 0)
    {
        $this->datatables->setSelect("purchase.*,SUM(purchase_details.qty) as items,suppliers.name");
        $this->datatables->setTable("purchase_details");
        $this->datatables->setJoin("purchase", "purchase.id=purchase_details.purchase_id", "left");
        $this->datatables->setJoin("suppliers", "suppliers.id=purchase.supplier_id", "left");

        if ($start and $end) {
            $this->datatables->setWhere("DATE(date) >=", $start);
            $this->datatables->setWhere("DATE(date) <=", $end);
        } else {
            $this->datatables->setWhere("MONTH(date)", date("m"));
            $this->datatables->setWhere("YEAR(date)", date("Y"));
        }

        $this->datatables->setGroup("purchase_id");

        $this->datatables->setColumn([
            "<index>",
            "<get-name>",
            "[reformat_date=<get-date>]",
            "<get-items>",
            "[rupiah=<get-total>]"
        ]);

        $this->datatables->setOrdering(["id", "name", "date", "items", "total"]);
        $this->datatables->setSearchField("date");
        $this->datatables->generate();
    }

    function purchase_pdf($start = 0, $end = 0)
    {
        $query = $this->report_model->get_purchase($start, $end);

        if ($query->num_rows() > 0) {
            $fetch = $query->result();

            $push = [
                "fetch" => $fetch
            ];

            if ($start and $end) {
                $push["subtitle"] = date("l, d F Y", strtotime($start . " 00:00:00")) . " - " . date("l, d F Y", strtotime($end . " 00:00:00"));
            } else {
                $push["subtitle"] = date("F Y");
            }

            $title = "Laporan_pembelian";

            $this->load->library("pdf");

            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->filename = $title;
            $this->pdf->load_view('purchase_report_pdf', $push);
        }
    }

    function report_pdf($type = "sparepart", $start = 0, $end = 0)
    {
        $query = $this->report_model->get($type, $start, $end);

        if ($query->num_rows() > 0) {
            $fetch = $query->result();

            $push = [
                "fetch" => $fetch,
                "type" => $type
            ];

            if ($start and $end) {
                $push["subtitle"] = date("l, d F Y", strtotime($start . " 00:00:00")) . " - " . date("l, d F Y", strtotime($end . " 00:00:00"));
            } else {
                $push["subtitle"] = date("F Y");
            }

            $title = "Laporan_penjualan_" . $type;

            $this->load->library("pdf");

            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->filename = $title;
            $this->pdf->load_view('report_pdf', $push);
        }
    }

    function salary_pdf($startDate = null, $endDate = null)
    {
        $user = $this->input->get('user');

        $where = null;
        $userData = null;

        if ($startDate != null && $endDate != null) {
            $where['transactions.date >='] = $startDate;
            $where['transactions.date <='] = $endDate;
        }

        if ($user != null) {
            $where['mechanic_details.user_id'] = $user;
        }

        $transactions = $this->transaction_model->getSalaryData($where); // Assuming you have a function in Transaction_model.php to fetch salary data

        if (count($transactions) > 0) {
            $push = [
                "fetch" => $transactions
            ];

            if ($startDate and $endDate) {
                $push["subtitle"] = date("l, d F Y", strtotime($startDate . " 00:00:00")) . " - " . date("l, d F Y", strtotime($endDate . " 00:00:00"));
            } else {
                $push["subtitle"] = '';
            }

            $title = "Laporan_salary";

            $this->load->library("pdf");

            $this->pdf->setPaper('A4', 'portrait');
            $this->pdf->filename = $title;
            $this->pdf->load_view('salary_report_pdf', $push);
        }
    }
}
