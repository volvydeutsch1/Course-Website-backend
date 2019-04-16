<?php
class Students extends Controller {

    public function __construct(){

        // Sanitize POST data
        if(isset($_POST)){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        }

        $this->studentsModel = $this->model('Student');
        $this->initialModel = $this->model('Initial');

        $headers = getallheaders();

        // No Authorization header was sent
        if(!isset($headers['Authorization'])){
            // not logged in as student echo error message and exit
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
            exit;
        }

        $verified = $this->initialModel->verifyToken($headers['Authorization']);

        if($verified == false || $verified->student_id == false){
            // not logged in as student echo error message and exit
            $err_msg = ['error' => 'you are not logged in as a student'];
            $this->view($err_msg);
            exit;
        }
    }


    public function getAnnouncements() {

        $data = [
            'student_id' => $_POST['student_id']
        ];

        //Set Data
        $data = $this->studentsModel->getAnnouncements($data['student_id']);

        // Load result page api
        $this->view($data);

    }

    // add new submission
    public function addSubmission() {

        // Init data from POST input
        $data = [
            'studentid' => trim($_POST['studentid']),
            'assignmentid' => trim($_POST['assignmentid']),
            'text' => trim($_POST['text'])
        ];

        //Set Data
        $res_data = $this->studentsModel->addSubmission($data);

        // Load result page api
        $this->view($res_data);

    }


    public function listAssignments() {

        $data = [
            'student_id' => $_POST['student_id']
        ];

        //Set Data
        $data = $this->studentsModel->listAssignments($data['student_id']);

        // Load result page api
        $this->view($data);

    }

    // add new AnnouncementRead
    public function addAnnouncementRead() {

        // Init data from POST input
        $data = [
            'studentid' => $_POST['studentid'],
            'announcementid' => $_POST['announcementid']
        ];

        //Set Data
        $res_data = $this->studentsModel->addAnnouncementRead($data);

        // Load result page api
        $this->view($res_data);

    }

}
