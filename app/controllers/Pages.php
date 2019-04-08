<?php
  class Pages extends Controller{
    public function __construct(){
     
    }

    // Load Homepage
    public function index(){
      //Set Data
      $data = [
        'title' => 'Welcome To TraversyMVC'
      ];

      // Load homepage api
      echo json_encode($data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about api
      echo json_encode($data);
    }
  }