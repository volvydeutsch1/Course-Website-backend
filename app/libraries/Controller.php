<?php
/*
 *  CORE CONTROLLER CLASS
 *  Loads Models & Views
 */
class Controller {

    // Default method
    public function index(){
        // Do nothing
    }

    // Lets us load model from controllers
    public function model($model){
        // Require model file
        require_once '../app/models/' . $model . '.php';
        // Instantiate model
        return new $model();
    }

    // Lets us load view from controllers
    public function view($data = []){
        // we might need here some conditional statements
        // echo json api
        echo json_encode($data);
    }
}