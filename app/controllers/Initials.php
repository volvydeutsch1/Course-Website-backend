<?php
class Initials extends Controller
{

    public function __construct()
    {
        $this->initialModel = $this->model('Initial');
    }

    // Load Homepage (announcements)
    public function index(){

    }

    // getting all announcements
    public function getAnnouncements()
    {
        //Set Data
        $data = $this->initialModel->getAnnouncements();

        // Load homepage / announcements view (api)
        $this->view($data);
    }

}