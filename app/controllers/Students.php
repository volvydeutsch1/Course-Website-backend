<?php
class Students extends Controller
{

    public function __construct(){
        $this->studentsModel = $this->model('Student');
    }

    public function index(){

    }

    public function register(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data = [
            'name' => trim($_POST['name']),
            'password' => trim($_POST['password'])
        ];

        // inserting data in database and getting back students id
        $id = ["id" => $this->studentsModel->register($data)];

        // Loading students id to view
        $this->view($id);
    }

    public function login(){

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data from POST input
        $data = [
            'id' => trim($_POST['id']),
            'password' => trim($_POST['password'])
        ];

        // Getting back all info of student on success or false, storing it in $student
        $student = $this->studentsModel->login($data);

        if ($student) {
            $_SESSION["student_id"] = $student->id;
            $_SESSION["student_name"] = $student->name;
            $this->view( ['accountType' => 'student', 'id' => $student->id, 'name' => $student->name] );
        }
    }

    public function logout(){
        unset($_SESSION["student_id"]);
        unset($_SESSION["student_name"]);
    }

    // add new submission
    public function addSubmission($data) {

    }


    public function listAssignments($id) {

    }
}