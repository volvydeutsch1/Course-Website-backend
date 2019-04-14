<?php
class Initials extends Controller {

    public function __construct(){

        // Sanitize POST data
        if(isset($_POST)){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }

        $this->initialModel = $this->model('Initial');
    }


    // getting all announcements
    public function getAnnouncements(){

        //Set Data
        $data = $this->initialModel->getAnnouncements();

        // Load homepage / announcements view (api)
        $this->view($data);
    }

    public function register(){

        // Init data
        $data = [
            'accountType' => trim($_POST['accountType']),
            'name' => trim($_POST['name']),
            'password' => trim($_POST['password'])
        ];

        // inserting data in database and getting back teacher / student ID
        $id = ["id" => $this->initialModel->register($data)];

        // Loading teacher / student ID to view
        $this->view($id);
    }

    public function login(){

        // Init data from POST input
        $data = [
            'accountType' => trim($_POST['accountType']),
            'id' => trim($_POST['id']),
            'password' => trim($_POST['password'])
        ];

        // Getting back all info of logged in account on success or false, storing it in $logged_in
        $logged_in = $this->initialModel->login($data);

        if ($logged_in) {
            $token = $this->initialModel->setToken($logged_in->id, $data['accountType']);
            $this->view( ['token' => $token, 'accountType' => $data['accountType'], 'id' => $logged_in->id, 'name' => $logged_in->name] );
        }else{
            // $logged_in returned false
            $err_msg = ['error' => 'Incorrect Id/Password'];
            $this->view($err_msg);
        }
    }

    public function logout(){

        // Delete token
        $headers = getallheaders();
        $this->initialModel->clearToken($headers['Authorization']);
    }

}