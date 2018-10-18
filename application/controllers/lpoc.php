<?php
class lpoc extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        session_start();
    }

    private $limit = 10;

    /**
     * Load lpoc_model
     * getEvents method gets -Room information from db for the dropdowns
     * Load form view
     */
    public function index()
    {
        $date = date_default_timezone_set('US/Eastern');
        $this->load->model('lpoc_model');
        $data['events'] = $this->lpoc_model->getEvents();
        // $this->load->view('form', $data);
        $this->load->view('request');
    }

    /**
     * $q is ID for rooms
     * Calls getRooms method from db and returns json $rooms
     */
    public function getRooms($q)
    {
        $this->load->model('lpoc_model');
        $rooms = $this->lpoc_model->getRooms($q);
        echo json_encode($rooms);
    }

    /**
     * $q is room ID
     * Call getRoomInfo($q) to get details of the room info - returns json
     */
    public function getRoomInfo($q)
    {
        $this->load->model('lpoc_model');
        $roomInfo = $this->lpoc_model->getRoomInfo($q);
        echo json_encode($roomInfo);
    }
   
    /**Dummy function to view event info in success_view*/
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
     *Insert the new request data into database
     *If special requirement is not empty, add that details to chat table for conversation purposes
     *Send user and email about submitted request awaiting approval from library.

     */
    public function insertNewRequest()
    {
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $data = array(
            'eventName' =>  $this->input->post('eventName'),
            'eventDesc' => $this->input->post('eventDesc'),
            'startDate' => $this->input->post('startDate'),
            'endDate' => $this->input->post('endDate'),
            'startTime' => date('H:i',strtotime($this->input->post('startTime'))),
            'endTime' => date('H:i',strtotime($this->input->post('endTime'))),
            'eventId' => $this->input->post('eventId'),
            'selectedRoom' => $this->input->post('selectedRoom'),
            'noOfPeople' => $this->input->post('noOfPeople'),
            'describe' => $this->input->post('describe'),
            'specReq' => $this->input->post('specReq'),
            'reqName' => $this->input->post('reqName'),
            'emailId' => $this->input->post('emailId'),
            'status' => 1
        );
        $requesterEmail = $data['emailId'];
        $requesterName = $data['reqName'];
        $this->load->model('lpoc_model');
        $result = $this->lpoc_model->insertRequests($data);
        if($this->input->post('specReq')>0 ||$this->input->post('specReq')!= null)
        {
            $data = array(
                'comment' => $this->input->post('specReq'),
                'commentType' => "SPL REQ",
                'requestID' => $result
            );
            $chat_result = $this->lpoc_model->saveChat($data, 'chat');
        }
        if($result >0)
        {
            $requestID = $result;
            $reVal = $this->email_user($requesterName, $requesterEmail, $requestID);
            if($reVal < 0){
                echo $requestID;      
            }        
        } else {
            echo 0;
        }
    }

    /**
     * Function used to mail the requests link and details to user
     * $requesterName is the one initiating the request 
     * $requesterEmail is email ID for the requester
     * $requestID - request ID 
     * This function is only called when request is created / submitted
     */
    public function email_user($requesterName, $requesterEmail, $requestID)
    {
        $this->load->library('email');
        $this->load->model('lpoc_model');
        $config['protocol'] = "sendmail";
        $config['smtp_host'] = "tls://smtp.googlemail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "cannavinolibrary@gmail.com";
        $config['smtp_pass'] = "12601redfoxesLibrary";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
        $this->email->from('cannavinolibrary@gmail.com', 'James A. Cannavino Library');
        $this->email->to($requesterEmail);
      
            $this->email->subject("Library Room Reservation. Request Id: " . $requestID);

            $emailBody = '<html><body>';

            $emailBody .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';

            $emailBody .= "<h4>Dear $requesterName,<br/><br/> Your request has been received and is awaiting approval by the Library Programming and Outreach Committee. </h4></br></tr>";

            $emailBody .= "<tr><td colspan=2 font='colr:#3A5896;'><I>*Please contact a library staff if you have any further questions 845-575-3106.</I></td></tr>";

            $emailBody .= "</table>";

            $emailBody .= "</body></html>";
            $this->email->message($emailBody);

            if ($this->email->send()) {
                echo $requestID;
            } else {
                echo 0;
            }
     }

    /**
     * This function is for sending mails to user to notify about the approve/return status of the request
     * It uses 2 more fields than the previous versions of mail function - 
     *          $inst - instructions for user regarding approve/reject status
     *          $flag = to check if mail is to be sent for approval/return (both have different message bodies)
     * Also generates random strings to encode request ID in url
     * Uses GenerateRandomString method
     */
	public function email_user_apprRej($requesterName, $requesterEmail, $requestID, $inst,$flag){
        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['smtp_host'] = 'tls://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'cannavinolibrary@gmail.com';
        $config['smtp_pass'] = '12601redfoxesLibrary';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'html';
        $config['newline'] = '\r\n';
        $this->email->initialize($config);
        $this->load->library('email');
        $this->email->from('cannavinolibrary@gmail.com', 'James A. Cannavino Library');
        $this->email->to($requesterEmail);
        
             
      	$six_digit_random_string =  $this -> generateRandomString();
        $UUID=$six_digit_random_string.$requestID;
        $six_digit_random_string =  $this -> generateRandomString();
        $UUID = $UUID.$six_digit_random_string;

	    $url = base_url()."?c=lpoc&m=userRequest&requestID=".$UUID;

        $message = '<html><body>';

        $message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';
        if($flag == "TRUE"){
            //approved request
            $this->email->subject('Request Approved');
            $message .= "<br/><br/> <h4>Dear $requesterName,<br/><br/> Your Library Room Reservation Request has been appproved. Please check the link for additional instructions.</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a>  </td></tr>";
        } 
        else if($flag=="complete"){
            $this->email->subject('Request Completed');
            $message .= "<br/><br/> <h4>Dear $requesterName,<br/><br/> Your Library Room Reservation Request has been completed. Please check the link for additional report/event photographs.</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a>  </td></tr>";
        }else {
            //rejected request
            $this->email->subject('Request Returned');
            $message .= "<br/><br/> <h4>Dear $requesterName,<br/><br/> Your Library Room Reservation Request has been returned. Kindly check the  instructions and update the request information as requested.</h4><br/> <I>Link:</I><br/><a href='$url'> $url </a>  </td></tr>";
        }
        
        $message .= "<tr><td colspan=2 font='colr:#3A5896;'><I>Instructions:<br></I><h4>".$inst."</h4></td></tr>";
        $message .= "</table>";

        $message .= "</body></html>";

        $this->email->message($message);

       
        if ($this->email->send()) {
            echo $requestID;
        } else {
            echo 0;
        }
    }

    /**
     * Helper function, called inside email_user() to generate random string of alphanumeric characters
     */
    public function generateRandomString() {
	    $length = 6;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHI0123456789JKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
     }
	 		


    public function success(){
        $this->view->load('success_view');
    }

    /*
    * Verifies admin passcode input with passcode saved in db
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

    /**
     * Load all request from the database
     * Count all the requests 
     * Perform pagination and load admin_view with pagination links and total rows 
     */
    public function admin(){
        $this->load->model('lpoc_model');
        $query = $this->lpoc_model->allRequests($this->limit);
        $total_rows = $this->lpoc_model->countAllRequests();
        $this->load->helper('app');
        $pagination_links = pagination($total_rows, $this->limit);
        //add cas auth here very very carefully
        $this->load->view('admin_view', compact('query', 'pagination_links','total_rows'));
    }

    /**
     * Gets passcode from db and verify with user entry
     * Load all request from the database
     * Count all the requests 
     * Perform pagination and load admin_view with pagination links and total rows 
     */
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
     * function to fetch the request with requestID
     * loads reviewRequest view form
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
                        $row['eventStartDate'], $row['eventEndDate'], $row['startTime'], $row['endTime'], $row['eventType'],
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


    /**
     * This function fetches event requests with statuses and are loaded in admin view in admin page 
     * The requests are put in a table
     */
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

    /**
     * This function was created to Add event completion report
     * For that feature, we needed list of events which are approved and load them in page_view
     * This is kept for future reference
     */
    public function approvedToBeCompleted(){
        $status = $this->input->get('status');
        if($status != null) {
            $url = base_url("?c=lpoc&m=eventRequests&status=$status");
        }
        else{
            $url = null;
        }
        $this->load->model('lpoc_model');
        $query = $this->lpoc_model->ViewRequestsWithStatus($this->limit,$status);
        $total_rows = $this->lpoc_model->ViewcountWithStatus($status);
        $this->load->helper('status');
        $pagination_links = pagination($total_rows, $this->limit,$url);
        $this->load->view('page_view', compact('query', 'pagination_links','total_rows'));
    }

    //This is helper method used to count number of pages that will be needed to display the requests on admin page
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
     Return flag
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
            $flag="TRUE";
            $this->email_user_apprRej($requesterName, $requesterEmail, $requestID, $instruc,$flag);
        }
    }

 /*
     * Function to disapprove request/returned request.
     * Change the transactions status to 1. That enables the user to edit and resubmit the request.
     * Adds Instructions to the user.
     */
    public function disapproveRequest()
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
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");
        $this->load->model('lpoc_model');
        //updating researcher information
        $result = $this->lpoc_model->approveOrDisapprove_request($date,2,$requestID);
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
            $flag="FALSE";
            $this->email_user_apprRej($requesterName, $requesterEmail, $requestID, $instruc,$flag);
        }
    }

    /* 
     * function to fetch the request with requestID.
     * loads useRequest view form
     * This is the view that users see when they click the link in email
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
                        $row['eventStartDate'], $row['eventEndDate'], $row['startTime'], $row['endTime'], $row['eventType'],
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
     * Function to save/update request.
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
     * Function to update request.
     * Function updates request details.
     * Updates the status of the transaction to 1.That indicates that user submitted the form for approval.
     * Trigger email to librarian with URL to review the request.
     */
    public function submitRequest()
    {
        $requestID = $_POST['requestID'];
        //$requestID=substr($requestID,6,-6);
        //  $id= $this->input->post($researcherId);
        date_default_timezone_set('US/Eastern');
        $date = date("Y-m-d");

        $this->load->model('lpoc_model');
        //updating researcher information
        $data = array(
            'requesterName' =>$_POST['requesterName'], 
            'requesterEmail'=>$_POST['requesterEmail'], 
            'eventStartDate'=>$_POST['eventStartDate'], 
            'eventEndDate'=>$_POST['eventEndDate'],
            'startTime' => $_POST['startTime'],
            'endTime' => $_POST['endTime'],
            'eventName'=>$_POST['eventName'], 
            'eventDesc'=>$_POST['eventDesc'], 
            'eventDescLib'=>$_POST['eventDescLib'], 
            'numOfPeople'=>$_POST['numOfPeople'], 
            'eventReq'=>$_POST['eventReq'], 
            'requestID'=>$_POST['requestID']
        );
         $result = $this->lpoc_model->update_request($data);
        //echo $result;
        if($this->input->post('eventReq')>0 ||$this->input->post('eventReq')!= null)
        {
            $data1 = array(
                'comment' => $this->input->post('eventReq'),
                'commentType' => "SPL REQ",
                'requestID' => $_POST['requestID']
            );
            $chat_result = $this->lpoc_model->saveChat($data1, 'chat');
            if($result>0)
            {
                $reVal = $this->email_user($data['requesterName'], $data['requesterEmail'], $data['requestID']);
                if($reVal > 0){
                    echo $requestID;      
                }        
            } else {
                echo 0;
            }
        }
        /*if ($result > 0) { 
                $six_digit_random_string =  $this -> generateRandomString();
                $UUID=$six_digit_random_string.$requestID;
                $six_digit_random_string =  $this -> generateRandomString();
                $UUID = $UUID.$six_digit_random_string;
                echo $UUID;
            }*/
    }


    /**
     * Function to complete request.
     * Function allows to add completion comments for internal purposes.
     * Updates the status of the transaction to 4. That indicates that user request is completed.
     */
    
    public function completetransaction()
    {
        $comment = $_POST["message"];
        $requesterName = $_POST["requesterName"];
        $requesterEmail = $_POST["requesterEmail"];
        $requestID = $this->input->get('requestID');
        $status = 4;
        $this->load->model('lpoc_model');
        $response = $this->lpoc_model->updateStatus($status, $requestID);
        if($comment != null){
            //$comment = "NA";
            $data = array(
                'comment' => $comment,
                'commentType' => "MESSAGE",
                'requestID' => $requestID
            );
            $this->load->model('lpoc_model');
            $chat_result = $this->lpoc_model->saveChat($data, 'chat');
        }
        //use the below two lines to send mail (in case if needed in future)
        //$flag="complete";
        //return $this->email_user_apprRej($requesterName, $requesterEmail, $requestID,$comment,$flag);
        echo $requestID;
    }
}
?>
