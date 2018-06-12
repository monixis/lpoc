<?php
class lpoc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    private $limit = 10;

    public function index()
    {
        $date = date_default_timezone_set('US/Eastern');
        $this->load->model('lpoc_model');
        $data['events'] = $this->lpoc_model->getEvents();
        $this->load->view('form', $data);
    }

    public function getRooms($q)
    {
        $this->load->model('lpoc_model');
        $rooms = $this->lpoc_model->getRooms($q);
        echo json_encode($rooms);
    }

    public function getRoomInfo($q)
    {
        $this->load->model('lpoc_model');
        $roomInfo = $this->lpoc_model->getRoomInfo($q);
        echo json_encode($roomInfo);
     }
}

?>
