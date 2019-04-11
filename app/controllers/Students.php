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
            $_SESSION["account_type"] = "student";
            $_SESSION["student_id"] = $student->id;
            $_SESSION["student_name"] = $student->name;
            $this->view( ['accountType' => 'student', 'id' => $student->id, 'name' => $student->name] );
        }else{
            // $student returned false
            $err_msg = ['error' => 'Incorrect StudentId/Password'];
            $this->view($err_msg);
        }
    }

    public function logout(){
        if(isset($_SESSION["student_id"])){
            unset($_SESSION['account_type']);
            unset($_SESSION["student_id"]);
            unset($_SESSION["student_name"]);
            session_destroy();
        }
    }

    // add new submission
    public function addSubmission() {
        // check if caller is logged in student
        if(isset($_SESSION["student_id"])){
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data from POST input
            $data = [
                'studentid' => trim($_POST['studentid']),
                'assignmentid' => trim($_POST['assignmentid']),
                'text' => trim($_POST['text'])
            ];
            //Set Data
            $res_data = $this->studentsModel->addSubmission($data);

            // Load homepage / announcements view (api)
            $this->view($res_data);
        }else{
            // not logged in as student
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
        }

    }


    public function listAssignments() {
        // check if caller is logged in student
        if(isset($_SESSION["student_id"])){

            $id = $_SESSION['student_id'];
            //Set Data
            $data = $this->studentsModel->listAssignments($id);

            // Load homepage / announcements view (api)
            $this->view($data);
        }else{
            // not student
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
        }
    }

}