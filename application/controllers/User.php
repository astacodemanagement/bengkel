<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $dataAdmin;

    function __construct()
    {
        parent::__construct();

        if (!$this->session->auth) {
            redirect(base_url("auth/login"));
        }

        $this->load->model("user_model");
        $this->load->model("user_model");

        $this->dataAdmin = $this->user_model->get(["id" => $this->session->auth['id']])->row();
    }


    public function index()
    {

        $push = [
            "pageTitle" => "User",
            "dataAdmin" => $this->dataAdmin
        ];

        $this->load->view('header', $push);
        $this->load->view('user', $push);
        $this->load->view('footer', $push);
    }

    public function json()
    {
        $this->load->model("datatables");
        $this->datatables->setTable("users");
        $this->datatables->setColumn([
            '<index>',
            '<get-code>',
            '<get-name>',
            '<get-address>',
            '<get-telephone>',
            '<div class="text-center">
                <button type="button" class="btn btn-primary btn-sm btn-edit" data-id="<get-id>" title="Edit Data"><i class="fa fa-edit"></i></button>
                <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="<get-id>" data-name="<get-name>" title="Delete Data"><i class="fa fa-trash"></i></button>
            </div>'
        ]);
        
        $this->datatables->setOrdering(["id", "name", "address", "telephone", NULL]);
        $this->datatables->setSearchField(["name","code"]);
        $this->datatables->generate();
    }

    function get($id = 0)
    {
        $query = $this->user_model->get(["id" => $id]); // Corrected to use an associative array
        if ($query->num_rows()) {
            echo json_encode($query->row_array());
        }
    }
    

    function insert()
    {
        $this->proccess();
    }

    function edit($id = 0)
    {
        $this->proccess("edit", $id);
    }

    function delete($id = 0)
    {
        if ($id) {
            $response["status"] = TRUE;
            $response["msg"] = "Data berhasil dihapus";
    
            $this->user_model->delete_user($id); // Use the delete_user method
    
            echo json_encode($response);
        }
    }
    

    private function proccess($action = "add", $id = 0)
    {
        $code = $this->input->post("code");
        $name = $this->input->post("name");
        $telephone = $this->input->post("telephone");
        $position = $this->input->post("position");
        $birthplace = $this->input->post("birthplace");
        $birthdate = $this->input->post("birthdate");
        $joindate = $this->input->post("joindate");
        $level = $this->input->post("level");
        $address = $this->input->post("address");
        $username = $this->input->post("username");
        $password = $this->input->post("password");
    
        if (!$code || !$name || !$telephone || !$position || !$birthplace || !$birthdate || !$level || !$address || !$username) {
            
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data yang anda masukkan"
            ];
        }
        else if ($action == "add" && !$password) {
            $response = [
                "status" => FALSE,
                "msg" => "Periksa kembali data yang anda masukkan"
            ];
        } else {
            // Menggunakan password_hash untuk mengenkripsi password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $insertData = [
                "id" => NULL,
                "code" => $code,
                "name" => $name,
                "telephone" => $telephone,
                "position" => $position,
                "birthplace" => $birthplace,
                "birthdate" => $birthdate,
                "joindate" => $joindate,
                "level" => $level,
                "name" => $name,
                "address" => $address,
                "username" => $username,
                "password" => $hashedPassword  // Menggunakan password yang sudah dihash
            ];
    
            $response["status"] = TRUE;
    
            if ($action == "add") {
                $response['msg'] = "Data berhasil ditambahkan";
    
                $insertData["id"] = $this->user_model->insert_user($insertData);
            } else {
                $response['msg'] = "Data berhasil diedit";
    
                unset($insertData["id"]);
                
                if ($password == '' | $password == null) {
                    unset($insertData["password"]);
                }
    
                $this->user_model->set_user($id, $insertData);
            }
        }
    
        echo json_encode($response);
    }
    
}
