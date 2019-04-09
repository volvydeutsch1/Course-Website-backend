<?php
  class Teachers extends Controller{

    public function __construct(){
        $this->teachersModel = $this->model('Teacher');
    }

    // Load Homepage
    public function index(){
      //Set Data
      $data = [
          'title' => 'Omnivox'
      ];

      // Load homepage view (api)
      $this->view($data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about view (api)
      $this->view($data);
    }

    public function register(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'name' => trim($_POST['name']),
            'password' => trim($_POST['password'])
        ];

        // inserting data in database and getting back teachers id
        $id = ["id" => $this->teachersModel->register($data)];

        // Loading teachers id to view
        $this->view($id);
    }
  }