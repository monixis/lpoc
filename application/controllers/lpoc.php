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

    public function showdata(){
        $data = array(
            'eventName' =>  $this->input->post('eventName'),
            'eventDesc' => $this->input->post('eventDesc'),
            'startDate' => $this->input->post('startDate'),
            'endDate' => $this->input->post('endDate'),
            'eventId' => "default",//$this->input->post('eventId'),
            'selectedRoom' => "default",//$this->input->post('selectedRoom'),
            'noOfPeople' => $this->input->post('noOfPeople'),
            'describe' => $this->input->post('describe'),
            'specReq' => $this->input->post('specReq'),
            'reqName' => $this->input->post('reqName'),
            'emailId' => $this->input->post('emailId'),
            'status' => 0
        );
        $this->load->view('success_view',$data);
    }

    


/*
     *Function to create new request.
     *
     */

    public function insertNewRequest()
    {
        date_default_timezone_set('US/Eastern');
        $date = date("m/d/Y");

        $data = array(
            'eventName' =>  $this->input->post('eventName'),
            'eventDesc' => $this->input->post('eventDesc'),
            'startDate' => $this->input->post('startDate'),
            'endDate' => $this->input->post('endDate'),
            'eventId' => $this->input->post('eventId'),
            'selectedRoom' => $this->input->post('selectedRoom'),
            'noOfPeople' => $this->input->post('noOfPeople'),
            'describe' => $this->input->post('describe'),
            'specReq' => $this->input->post('specReq'),
            'reqName' => $this->input->post('reqName'),
            'emailId' => $this->input->post('emailId'),
            'status' => 1
        );
        $this->load->model('lpoc_model');
        $result = $this->lpoc_model->insertRequests($data);
        if($this->input->post('specReq')>0 ||$this->input->post('specReq')!= null) {
            $data = array(
                'comment' => $this->input->post('specReq'),
                'commentType' => "SPL REQ",
                'requestID' => $result
            );
        $chat_result = $this->lpoc_model->saveChat($data, 'chat');
        if($result >0){
            $requestID = $result;
            echo $requestID;
        } else {
            echo 0;
        }
    }
}

    public function success(){
        $this->view->load('success_view');
    }

    /*
 * Verifies admin passcode input with passcode saved in db
 *
 */
    public function admin_verify(){
        $apasscode = $this->input->get('pass');
        $this->load->model('lpoc_model');
        $passcode = $this->lpoc_model -> getPasscode(1);
        if($passcode == $apasscode){
        $authorized =1;
        }else{
        $authorized=0;
        }
        echo $authorized;
    }

    public function admin(){
        $this->load->model('lpoc_model');
        $query = $this->lpoc_model->allRequests($this->limit);
        $total_rows = $this->lpoc_model->countAllRequests();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        //add cas auth here very very carefully
        $this->load->view('admin_view', compact('query', 'pagination_links','total_rows'));
    }

    public function getRequests(){
        $apasscode= $this-> input-> get('pass');
        $this->load->model('lpoc_model');
        $passcode = $this->lpoc_model -> getPasscode(1);
        if($passcode == $apasscode){
        $query = $this->lpoc_model->allRequests($this->limit);
        $total_rows = $this->lpoc_model->countAllRequests();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        $this->load->view('admin', compact('query', 'pagination_links','total_rows'));
       } else{
            echo "<h1 align='center' style=\"color:#B31B1B;\" >401 - Unauthorized access</h1>";
        }
    }

    /*
     * function to fetch the researcher with requestID
     * loads reviewUseAgreement view form
     */
    public function reviewRequest()
    {
        /*WORKING*/
        $this->load->model('lpoc_model');
        $requestID = $this->input->get('requestID');
        $result = $this->lpoc_model->getRequestWithId($requestID);
        $chat_array =  $this->lpoc_model->getChat($requestID);
        if($chat_array>0) {
            $chat_list = json_decode(json_encode($chat_array), true);
            //   print_r($chat_list);
            $data['chatList'] = $chat_list;
        }
        if ($result != null) {
            $requestinfo = array();
            $info = json_decode(json_encode($result), true);
            $data['requestID'] = $requestID;
            foreach ($info as $row) {
                
                $request = array();
                if (sizeof($requestinfo) == 0) {
                    array_push($requestinfo, $row['requesterName'], $row['requesterEmail'], $row['eventName'], $row['eventDesc'],
                        $row['eventStartDate'], $row['eventEndDate'], $row['eventType'],
                        $row['roomId'], $row['numOfPeople'], $row['eventDescLib'], $row['eventReq'], $row['status']);
                    $data['requestinfo'] = $requestinfo;
                    $roomId = $row['roomId'];
                }
            }
            $roomInfo = $this->lpoc_model->getRoomWRoomId($roomId);
            if ($roomInfo != null) {
                $roominfo = array();
                $info = json_decode(json_encode($roomInfo), true);
                $data['requestID'] = $requestID;
                foreach ($info as $row) {
                    
                    $request = array();
                    if (sizeof($roominfo) == 0) {
                        array_push($roominfo, $row['roomId'], $row['Name'], $row['Location'], $row['LocDesc'],
                            $row['Capacity'], $row['Technology'],
                            $row['Special Considerations']);
                        $data['roominfo'] = $roominfo;
                    }
                }
            $this->load->view('reviewRequest', $data);
        }else{
            echo "please provide valid requestID";
        }
    }
}
//useagreement requests - eventrequests (renamed)
    public function eventRequests(){
        $status = $this->input->get('status');
        if($status != null) {
            $url = base_url("?c=lpoc&m=eventRequests&status=$status");
        }
        else{
            $url = null;
        }
        $this->load->model('lpoc_model');
        $query = $this->lpoc_model->RequestsWithStatus($this->limit,$status);
        $total_rows = $this->lpoc_model->countWithStatus($status);
        $this->load->helper('status');
        $pagination_links = pagination($total_rows, $this->limit,$url);
        $this->load->view('page_view', compact('query', 'pagination_links','total_rows'));
    }

    public function pages(){
        $this->load->model('lpoc_model');
        $query = $this->lpoc_model->allRequests($this->limit);
        $total_rows = $this->lpoc_model->countAllRequests();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        $this->load->view('page_view', compact('query', 'pagination_links','total_rows'));
    }

    /*
     *Function to approve request.
     *Trigger email to user about the approval status.
     */
    public function approveRequest()
    {
        $requestID = $this->input->get('requestID');
        if(isset($_POST['instructions'])){
            $instruc = $_POST['instructions'];
        } else {
            $instruc = "This is an instruction";
        }
        if(isset($_POST['requesterName'])){
            $requesterName = $_POST['requesterName'];
        } else {
            $requesterName = "Deep";
        }
        if(isset($_POST['requesterEmail'])){
            $requesterEmail = $_POST['requesterEmail'];
        } else {
            $requesterEmail = "deep.dand1992@gmail.com";
        }
        
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $this->load->model('lpoc_model');
        //updating request information
        $result = $this->lpoc_model->approveOrDisapprove_request($date,3,$requestID);
        if($instruc != null){
            $data = array(
                'comment' => $instruc,
                'commentType' => "INSTRUCTIONS",
                'requestID' => $requestID
            );
            $this->load->model('lpoc_model');
            $chat_result = $this->lpoc_model->saveChat($data, 'chat');
            if ($chat_result > 0) {
                echo "success";
            }
        }
        if($result>0){
            $this->load->library('email');
            $config['protocol'] = 'sendmail';
            $config['smtp_host'] = 'tls://smtp.gmail.com';
            $config['smtp_port'] = '465';
            $config['smtp_user'] = 'maristarchives@gmail.com';
            $config['smtp_pass'] = 'redfoxesArchives';
            $config['charset'] = 'utf-8';
            $config['mailtype'] = 'html';
            $config['newline'] = '\r\n';
            $this->email->initialize($config);
            $this->load->library('email');
            $this->email->from('maristarchives@gmail.com', 'Marist Archives');
            $this->email->to($_POST['requesterEmail']);
            $this->email->cc('deep.dand1992@gmail.com');
            $this->email->subject('Approved');
            
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$requestID;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            $url = base_url()."?c=lpoc&m=userRequest&requestID=".$UUID ;

            $message = '<html><body>';

            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3> <br/><h3>COPY/USE AGREEMENT REQUEST</h3> ";

            $message .= "<br/><br/> <h4>Dear ,<br/><br/> Your Library Room Reservation Request has been appproved, we will send you the requested copies shortly</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a>  </td></tr>";
            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>".$_POST['instructions']."</h4></td></tr>";
            $message .= "</table>";

            $message .= "</body></html>";

            $this->email->message($message);

            $this->email->send();

            
            echo $requestID;
        }
    }

 /*
     * Function to disapprove request/returned request.
     * Change the transactions status to 1. That enables the user to edit66 and resubmit the request.
     * Adds Instructions to the user.
     */
    public function disapproveRequest()
    {
        $requestID = $this->input->get('requestID');
        //$instr = $_POST['instructions'];
       // $reqName = $_POST['requesterName'];
        //$reqEmail = $_POST['requesterEmail'];
        // $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $this->load->model('lpoc_model');
        //updating researcher information
        $result = $this->lpoc_model->approveOrDisapprove_request($date,2,$requestID);
        if($_POST['instructions'] != null){
            $data = array(
                'comment' => $_POST['instructions'],
                'commentType' => "INSTRUCTIONS",
                'requestID' => $requestID
            );
            $this->load->model('lpoc_model');
            $chat_result = $this->lpoc_model->saveChat($data, 'chat');
            if ($chat_result > 0) {
                echo "success";
            }
        }
        if($result>0){
           $this->load->library('email');
            $config['protocol'] = "sendmail";
            $config['smtp_host'] = "tls://smtp.gmail.com";
            $config['smtp_port'] = "465";
            $config['smtp_user'] = "maristarchives@gmail.com";
            $config['smtp_pass'] = "redfoxesArchives";
            $config['charset'] = "utf-8";
            $config['mailtype'] = "html";
            $config['newline'] = "\r\n";
            $this->email->initialize($config);
            $this->email->from('maristarchives@gmail.com', 'Marist Archives');
            $this->email->to($_POST['requesterEmail']);
          //  $this->email->cc('dheeraj.karnati1@marist.edu');
            //  $this->email->cc('another@another-example.com');
            //$this->email->bcc('them@their-example.com');
            $this->email->subject('Returned for review');
            $greeting        = "Dear ".$_POST['requesterName'];
            $messageOne     = "As we found some errors in the form, we have returned it for review. Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form) ";
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$requestID;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            $url = base_url()."?c=lpoc&m=userRequest&requestID=".$UUID ;
            $instructions = $_POST['instructions'];
            $message = '<html><body>';

            $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

            $message .= "<tr ><td align='center'><img src='https://s.graphiq.com/sites/default/files/10/media/images/Marist_College_2_220374.jpg'  /><h3> Marist Archives and Special Collection </h3><h3>COPY/USE AGREEMENT REQUEST</h3> ";

            $message .= "<br/><br/> <h4>$greeting ,<br /><br />As we found some errors in the form, we have returned it for review.  Please click on the below link to resubmit the form (Please follow the instructions provided in the bottom of the form)</h4><br/> <I>Link:</I><br/><a href='$url'>$url</a>  </></tr>";

            //$message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Link:<br></I> $url </td></tr>";
            $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>$instructions</h4></td></tr>";
            $message .= "</table>";

            $message .= "</body></html>";


            $this->email->message($message);
            //echo $requestID;
            if($this->email->send()){
                echo $requestID;
            }else{
                echo "failed to send email";
            }

        }
    }

        /*changed name from useAgreement -> userRequest
     * function to fetch the researcher with requestID.
     * loads useAgreement view form
     */
    public function userRequest()
    {
        /*WORKING*/
        $this->load->model('lpoc_model');
        $requestID = $this->input->get('requestID');
        $requestID=substr($requestID,6,-6);

        $result = $this->lpoc_model->getRequestWithId($requestID);
        $chat_array =  $this->lpoc_model -> getChat($requestID);
        if($chat_array>0) {
            $chat_list = json_decode(json_encode($chat_array), true);
            //   print_r($chat_list);
            $data['chatList'] = $chat_list;
            }
        if($result!=null) {
            $requestinfo = array();
            $info = json_decode(json_encode($result), true);
            $data['requestID'] = $requestID;
            foreach ($info as $row) {
                
                $request = array();
                if (sizeof($requestinfo) == 0) {
                    array_push($requestinfo, $row['requesterName'], $row['requesterEmail'], $row['eventName'], $row['eventDesc'],
                        $row['eventStartDate'], $row['eventEndDate'], $row['eventType'],
                        $row['roomId'], $row['numOfPeople'], $row['eventDescLib'], $row['eventReq'], $row['status']);
                    $data['requestinfo'] = $requestinfo;
                    $roomId = $row['roomId'];
                }
            }
            $roomInfo = $this->lpoc_model->getRoomWRoomId($roomId);
            if ($roomInfo != null) {
                $roominfo = array();
                $info = json_decode(json_encode($roomInfo), true);
                $data['requestID'] = $requestID;
                foreach ($info as $row) {
                    
                    $request = array();
                    if (sizeof($roominfo) == 0) {
                        array_push($roominfo, $row['roomId'], $row['Name'], $row['Location'], $row['LocDesc'],
                            $row['Capacity'], $row['Technology'],
                            $row['Special Considerations']);
                        $data['roominfo'] = $roominfo;
                    }
                }
            $this->load->view('userRequest', $data);
        }else{
            echo "please provide valid requestID";
        }
    }else{
            echo '<html>', "\n"; // I'm sure there's a better way!
            echo '<head>', "\n";
            echo '</head>', "\n";
            echo '<body>', "\n";
            echo '<h1 align="center">404: User Not Found</h1>', "\n";
            echo '</body>', "\n";
            echo '</html>', "\n";
        }
    }

    /*
     * Function to save/update researcher.
     * to update the existing researcher and request.
     */
    public function saveRequest()
    {
        $requestID = $this->input->get('requestID');
        $requestID=substr($requestID,6,-6);
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $this->load->model('lpoc_model');
        //updating researcher information
        $result = $this->lpoc_model->update_request($requestID);
        //echo $result;
        if ($result > 0) {
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID=$six_digit_random_string.$requestID;
            $six_digit_random_string =  $this -> generateRandomString();
            $UUID = $UUID.$six_digit_random_string;
            echo $UUID;
        }
    }

    /*
     * Function to submit/update request.
     * Function updates request details.
     * Updates the status of the transaction to 1.That indicates that user submitted the form for approval.
     * Trigger email to librarian with URL to review the request.
     */
    public function submitRequest()
    {
        $requestID = $this->input->get('requestID');
        $requestID=substr($requestID,6,-6);
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $this->load->model('lpoc_model');

        if($_POST['eventReq']>0 ||$_POST['eventReq']!= null) {
                $data = array(
                    'comment' => $_POST['eventReq'],
                    'commentType' => "SPL REQ",
                    'requestID' => $requestID
                );
                $this->load->model('lpoc_model');
                $chat_result = $this->lpoc_model->saveChat($data, 'chat');
                if ($chat_result > 0) {
                }
        }

        //updating researcher information
            $result = $this->lpoc_model->update_request($_POST['requesterName'], $_POST['requesterEmail'], $_POST['eventStartDate'], $_POST['eventEndDate'],
                $_POST['eventName'], $_POST['eventDesc'], $_POST['eventDescLib'], $_POST['eventType'], $_POST['roomId'], $_POST['numOfPeople'], $_POST['eventReq'], $requestID);
        //echo $result;
        if ($result > 0) { 
                $six_digit_random_string =  $this -> generateRandomString();
                $UUID=$six_digit_random_string.$requestID;
                $six_digit_random_string =  $this -> generateRandomString();
                $UUID = $UUID.$six_digit_random_string;
                echo $UUID;
            }
        }
}
?>
