<?php
  class Pages extends Controller{
    public function __construct(){
     
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
  }