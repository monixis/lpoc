<?php
class lpoc_model extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function getEvents(){
        $this ->db ->trans_start();
        $sql = "SELECT * FROM events ORDER BY type ASC";
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{
            return 0;
        }
    }

    public function getRooms($type){
        $this ->db ->trans_start();
        $sql = "SELECT rooms.roomId, rooms.Name, rooms.Capacity FROM rooms INNER JOIN room_events ON rooms.roomId = room_events.roomid WHERE room_events.eventid = " . $type;
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{
            return 0;
        }
    }

    /*public function insert_request($eventName,$eventDesc,$startDate,$endDate,$eventId,$selectedRoom,$noOfPeople,$desc,$specReq,$reqName,$emailId){
        $this ->db ->trans_start();
        $this->db->query("INSERT INTO requests(eventName,eventDesc,eventStartDate,eventEndDate,eventType,roomId,numOfPeople,eventDescLib,eventReq,requesterName,requesterEmail) values($eventName,$eventDesc,$startDate,$endDate,$eventId,$selectedRoom,$noOfPeople,$desc,$specReq,$reqName,$emailId,'0');");
        $this->db->trans_complete();
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return $this->db->_error_message().print_r("");
        }
    }*/
    public function insertRequests($data){
        $requestData = array(
            'eventName'=> $data['eventName'], 
            'eventDesc'=> $data['eventDesc'],
            'eventStartDate'=> $data['startDate'],
            'eventEndDate'=> $data['endDate'],
            'eventType' => $data['eventId'],
            'roomId'=>$data['selectedRoom'],
            'numOfPeople'=>$data['noOfPeople'],
            'eventDescLib'=> $data['describe'],
            'eventReq'=> $data['specReq'],
            'requesterName'=> $data['reqName'],
            'requesterEmail'=> $data['emailId'],
            'status'=>$data['status']);
        $this->db->insert('requests',$requestData);
        if ($this->db->affected_rows() > 0) {
            $requestID = 'requestID';
            $this->db->trans_complete();
            $maxval = $this->getmaxid($requestID,'requests');
            return $maxval;
         } else {
            return 0;
        }
    }

    public function getmaxid($col, $table)
    {
        $this->db->select_max($col);
        $query = $this->db->get($table);
        foreach ($query->result() as $row) {
            $maxval = $row->$col;
        }
        return $maxval;
    }

    public function saveChat($data, $table){
        $this ->db ->trans_start();
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() > 0) {
            $chatId = 'chat_id';
            $this->db->trans_complete();
            return $chatId;
        }else{
            return $this->db->_error_message().print_r("");
        }
    }

    public function getChat($requestID){
        $this ->db->trans_start();
        $sql = "SELECT * FROM chat where chat.requestID = '$requestID' ORDER BY chat.chatId DESC";
        $results = $this->db->query($sql, array($requestID));
        if($results != null) {
            return $results->result();
        }
        else{

            return 0;
        }
    }

    public function getRoomInfo($room){
        $this ->db ->trans_start();
        $sql = "SELECT * FROM rooms WHERE roomId = " . $room;
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{
            return 0;
        }
    }

    /**
     * get room information from the room ID - to display room information on reviewrequest view
     */

     public function getRoomWRoomId($roomId){
        $this ->db ->trans_start();
        $sql = "SELECT * FROM rooms WHERE roomId = " . $roomId;
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{
            return 0;
        }
     }
    //LPOC models ends here 
    
	 /*
     * Insert details of the paper and author
     */
    
    public function insertDetailsWithLink($paperId, $title, $name, $cwid, $email, $date,$status,$abstract,$licenseId, $deptId,$collectionId,$year, $link){
        $sql = "INSERT INTO repository(paperid,name, cwid, title, email, uploaddate,updatedate, status, abstract, licenseId, dept_id,collection_id,year,url) values ($paperId, '$title', '$name', '$cwid', '$email','$date','$date',$status,'$abstract',$licenseId, $deptId,$collectionId, '$year','$link');";
        $this->db->simple_query($sql, array($title, $name, $cwid,$email, $date,$status,$abstract,$licenseId,$deptId,$collectionId,$link));
        if ($this->db->affected_rows() > 0) {
            return $paperId;
        } else {
            return 0;
        }
    }
    
    public function getAdmin($user){

        $sql = "SELECT * from admin WHERE cwid='$user'";
        $results = $this->db->query($sql);
        return $results->result();

    }
   
    public function updateLink($url, $paperId){
        $this ->db ->trans_start();
        $this->db->where('paperid', $paperId);
        $this->db->update('repository',array('url' =>$url ));
        $this->db->trans_complete();
        //  $this->db->query("UPDATE repository set url = '$url' WHERE paperid= $paperId");

        //$sql = "UPDATE repository set url = '$url' WHERE paperid= $paperId";
        //$this->db->simple_query($sql,array($paperId));
        //if ($this->db->where('paperid', $paperId)->update('repository', array('url' => $url)))
        if($this->db->trans_status())
        {
            return 1;

        }else{

            return $this->db->_error_message() . print_r("");
        }
    }    
	
	public function getKeywords()
	{
		$sql = "SELECT * FROM keywords";
		$results = $this->db->query($sql);
		return $results->result();
    }
    	
	public function saveToHistory($id, $status, $comments,$date){
        $sql = "INSERT INTO repo_history(paperid,status, comments,date) values ($id,$status,'$comments','$date');";
        $this->db->simple_query($sql, array($id, $status, $comments,$date));
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getHistory($id){
        $this ->db ->trans_start();
        $sql = "SELECT  * FROM repo_history WHERE repo_history.paperid = $id order by repo_history.paperid DESC";
        $results = $this->db->query($sql, array($id));
        if($results !=null) {
            return $results->result();
        } else{

            return 0;
        }
    }
    public function allRequests($limit = 0){
        $this->db->limit($limit);
        $this->db->offset($this->input->get('per_page'));
        $this->db->order_by('requestID','desc');
        return $this->db->get('requests');
    }

    public function countAllRequests()
    {
        return $this->db->count_all_results('requests');
    }


    public function allPapers($limit = 0,$dept_id){
        if($dept_id != 0 && $dept_id != null) {
            $this->db->limit($limit);
            $this->db->where('dept_id', $dept_id);
            $this->db->offset($this->input->get('per_page'));
            $this->db->order_by('updatedate', 'desc');

        }else{
            $this->db->limit($limit);
            $this->db->offset($this->input->get('per_page'));
            $this->db->order_by('updatedate', 'desc');
        }
        return $this->db->get('repository');
    }

    public function count($dept_id){
        $this -> db -> trans_start();
        $this -> db -> select('paperid');
        $this -> db -> from('repository');
        if($dept_id != 0 && $dept_id != null) {
            $this->db->where('dept_id', $dept_id);
        }
        return $this -> db -> count_all_results();
    }
    public function getPasscode($id){
        $this->db->trans_start();
        // $this ->db ->where('type','admin');
        // $results =   $this ->db ->get('passcode');
       // $type ='admin';
        $sql="SELECT pass FROM passcode WHERE id='$id';";
        $results = $this->db->query($sql);
        //   print_r($results-> result());
        if($results != null) {
            foreach($results->result() as $row) {
                $passcode = $row->pass;
                return $passcode;
            }
        }
        else{
            return 0;
        }
    }

    public function getRequest($requestID)
    {
        $sql = "SELECT * FROM requests LEFT JOIN request ON requests.requestID = request.requestID where requests.requestID = $requestID ;";
        $results = $this->db->query($sql, array($requestID));
        return $results->result();
    } 
    /*
     * Fetch the request with $requestId
     */
    public function getRequestWithId($requestID)
    {
        $sql = "SELECT * FROM requests where requests.requestID = $requestID ;";
        $results = $this->db->query($sql);
        return $results->result();
    }

    public function RequestsWithStatus($limit = 0, $status){
        $this->db->limit($limit);
        $this->db->offset($this->input->get('per_page'));
        $this->db->where('status',$status);
        $this->db->order_by('requestID','desc');
        return $this->db->get('requests');
    }

    public function countWithStatus($status){
        $this->db->select('requestID');
        $this->db->from('requests');
        $this->db->where('status',$status);
        return $this->db->count_all_results();
    }

      /*
     * Function to update requests table
     */
    public function approveOrDisapprove_request($date,$status,$requestID)
    {
        $sql = "UPDATE requests SET  updatedate ='$date' , status= '$status' WHERE requestID='$requestID' ;";
        $this->db->query($sql);
        // $this->db->where('requestID', "15");
        //$this->db->update('requests', $data);
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }


    /*
    * Function to update request table
    */
    public function update_request($data)
    {
        // $requestData = array(
        //     'eventName'=> $data['eventName'], 
        //     'eventDesc'=> $data['eventDesc'],
        //     'eventStartDate'=> $data['eventStartDate'],
        //     'eventEndDate'=> $data['eventEndDate'],
        //     'numOfPeople'=>$data['numOfPeople'],
        //     'eventDescLib'=> $data['eventDescLib'],
        //     'eventReq'=> $data['eventReq'],
        //     'requesterName'=> $data['requesterName'],
        //     'requesterEmail'=> $data['requesterEmail'],
        //     'requestID'=>$data['requestID']);
        $sql = "UPDATE requests SET requesterName='".$data['requesterName']."', requesterEmail= '".$data['requesterEmail']."', eventStartDate = '".$data['eventStartDate']."',eventEndDate ='".$data['eventEndDate']."',eventName='".$data['eventName']."', eventDesc='".$data['eventDesc']."', eventDescLib ='".$data['eventDescLib']."' , numOfPeople ='".$data['numOfPeople']."' ,eventReq ='".$data['eventReq']."', status = 1 WHERE requestID='".$data['requestID']."' ;";
        $this->db->query($sql);

        // $this->db->where('userId', "15");
        //$this->db->update('researcher', $data);
        if ($this->db->affected_rows() > 0) {
            return $data['requestID'];
        } else {
            // return 0;
            return $this->db->_error_message() . print_r("");
        }
    }   
}

?>