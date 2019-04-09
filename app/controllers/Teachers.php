<?php
  class Teachers extends Controller{

    public function __construct(){
        $this->teachersModel = $this->model('Teacher');
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

    public function login($data){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Getting back all info of teacher on success or false
        $teacher = $this->teachersModel->login($data);

        if($teacher){
            $_SESSION["teacher_id"] = $teacher->id;
            $_SESSION["teacher_name"] = $teacher->name;
        }
    }

    public function logout(){
        unset($_SESSION["teacher_id"]);
        unset($_SESSION["teacher_name"]);
    }

      // add new announcement
      public function addAnnouncement($data) {

      }

      // delete announcement
      public function deleteAnnouncement($id) {

      }

      // add new assignment
      public function addAssignment($data) {

      }

      // delete announcement
      public function deleteAssignment($id) {

      }

      // list of assignments by TeacherID
      public function listAssignments($id) {

      }

      // list of student submissions for AssignmentID
      public function listSubmissions($id) {

      }

      // update submission grade
      public function updateSubmission($data) {

      }
  }