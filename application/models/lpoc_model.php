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
        $sql = "SELECT rooms.roomId, rooms.Name FROM rooms INNER JOIN room_events ON rooms.roomId = room_events.roomid WHERE room_events.eventid = " . $type;
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{
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
    //LPOC models ends here 
    
	 /*
     * Insert details of the paper and author
     */
    public function insertDetails($paperId, $title, $name, $cwid, $email, $date,$status,$abstract,$licenseId, $deptId,$collectionId,$year)
    {
        $sql = "INSERT INTO repository(paperid,name, cwid, title, email, uploaddate,updatedate, status, abstract, licenseId, dept_id,collection_id,year) values ($paperId, '$title', '$name', '$cwid', '$email','$date','$date',$status,'$abstract',$licenseId, $deptId,$collectionId, '$year');";
		$this->db->simple_query($sql, array($title, $name, $cwid,$email, $date,$status,$abstract,$licenseId,$deptId,$collectionId));
		if ($this->db->affected_rows() > 0) {
            return $paperId;
		} else {
			return 0;
		}
    }
    public function insertDetailsWithLink($paperId, $title, $name, $cwid, $email, $date,$status,$abstract,$licenseId, $deptId,$collectionId,$year, $link){
        $sql = "INSERT INTO repository(paperid,name, cwid, title, email, uploaddate,updatedate, status, abstract, licenseId, dept_id,collection_id,year,url) values ($paperId, '$title', '$name', '$cwid', '$email','$date','$date',$status,'$abstract',$licenseId, $deptId,$collectionId, '$year','$link');";
        $this->db->simple_query($sql, array($title, $name, $cwid,$email, $date,$status,$abstract,$licenseId,$deptId,$collectionId,$link));
        if ($this->db->affected_rows() > 0) {
            return $paperId;
        } else {
            return 0;
        }

    }
    public function updateDetails($paperId, $title, $cwid, $name, $email, $date,$status,$abstract,$licenseId, $deptId,$collectionId,$year, $link){

        $this ->db ->trans_start();
        $this->db->where('paperid', $paperId);
        $this->db->update('repository',array('title' =>$title,'status'=> $status, 'name'=>$name,'cwid'=>$cwid,'email' => $email,'updatedate'=>$date,'licenseId'=> $licenseId,'dept_id' =>$deptId,'collection_id' => $collectionId,'year' => $year,'url' => $link,'abstract' => $abstract));
        $this->db->trans_complete();
        //$sql = "UPDATE repository set title='$title', status='$status', name='$name' , cwid='$cwid',email = '$email', updatedate='$date', licenseId= '$licenseId',dept_id ='$deptId', collection_id ='$collectionId', year = '$year', url = '$link'  ,abstract ='$abstract' where paperid='$paperId'";
        //$this->db->query($sql);
        if ($this->db->trans_status()) {
            return $paperId;
        }else{

            return 0;
        }
    }

    public function getAdmin($user){

        $sql = "SELECT * from admin WHERE cwid='$user'";
        $results = $this->db->query($sql);
        return $results->result();

    }
    public function checkPaperId($id){

        $sql = "SELECT repository.paperid FROM repository WHERE repository.paperid = $id";

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
     public function remove_paperTag($tagId, $paperId){
         $this ->db ->trans_start();
         $sql = "DELETE from papertags WHERE tid= '$tagId' and paperid='$paperId'";
         $this->db->query($sql);
         if ($this->db->affected_rows() > 0) {
             return $tagId;
         }else{

             return $this->db->_error_message() . print_r("");
         }
}
    public function updatePaperStatus($id, $status){

        $this ->db ->trans_start();
      //  $sql = "UPDATE repository set status='$status' WHERE paperid ='$id'";
       // $this->db->query($sql);
        $this->db->where('paperid', $id);
        $this->db->update('repository',array('status' =>$status ));
        $this->db->trans_complete();


        if ($this->db->trans_status()) {
            return 1;
        }else{

            return 0;
        }
    }
    public function getPaperDetails($id){

        $sql = "SELECT repository.paperid as paperid,repository.title, repository.updatedate , repository.name, repository.status,repository.url,repository.abstract, repository.cwid, repository.email, license.id, license.license, license.display, department.name as dept_name, collection.collection_name as coll_name, repository.year FROM repository INNER JOIN license ON repository.licenseId = license.id INNER JOIN department on repository.dept_id = department.dept_id INNER JOIN  collection on repository.collection_id= collection.collection_id WHERE repository.paperid = $id";
        $results = $this->db->query($sql);
        return $results->result();

    }
	public function getPaperTags($id){
        $sql = "SELECT  tags.tag, tags.tid FROM repository INNER JOIN papertags ON repository.paperid = papertags.paperid INNER JOIN tags ON papertags.tid = tags.tid WHERE repository.paperid = $id";
        $results = $this->db->query($sql);
        return $results->result();
    }
    public function deletePaperTags($paperid){
        $sql = "Delete from papertags where paperId= '$paperid'";
        $this->db->query($sql);
        if ($this->db->affected_rows() > 0) {
            return $paperid;
        }else{

            return $this->db->_error_message() . print_r("");
        }

    }
	public function getTags()
	{
		$sql = "SELECT tid, tag FROM tags";
		$results = $this->db->query($sql);
		return $results->result();
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
	 public function addATag($tagname)
    {
        if($tagname!= null) {
            $sql = "INSERT INTO tags(tag) Values ('$tagname');";
            $this->db->simple_query($sql, array($tagname));
            if ($this->db->affected_rows() > 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }
    public function mapTag($paperId,$tag){
            $this ->db ->trans_start();
            $sql = "Insert Into papertags(paperid, tid) VALUES ('$paperId',$tag)";
            $this->db->simple_query($sql, array($paperId,$tag));
             $this ->db ->trans_complete();
            if ($this->db->trans_status()) {
                return 1;
            }else{
                if($this->db->trans_status() === false) {
                    $this->db->trans_rollback();
                    return 0;

            }
        }
        $this ->db ->trans_commit();
    }
	 public function verifyTag($tagname)
    {
        $tagid = 0;
		$this->db->select('tid');
		$this->db->from('tags');
		$this->db->where('tag', $tagname);
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$tagid = $row->tid;
		}
		return $tagid;
    }
    public function verifyTagId($tagId)
    {
        $tagid = 0;
        $this->db->select('tid');
        $this->db->from('tags');
        $this->db->where('tid', $tagId);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            $tagid = $row->tid;
        }
        return $tagid;
    }
    public function getPaperTag($tid, $paperid){
        $this ->db ->trans_start();

        $sql = "Select * from papertags where tid='$tid' and paperid='$paperid'";
        $results = $this ->db -> query($sql);

        if($results !=null) {

            return $results -> result();

        } else{

            return 0;
        }
    }

    public function searchByTag($searchTerm)
    {
    	$sql = "SELECT DISTINCT  repository.title as 'title', repository.paperid as 'id', repository.url as 'url', repository.name as 'name',repository.updatedate as 'date',repository.abstract as 'abstract', repository.year as 'year', license.license as 'license', license.display as 'display' FROM repository INNER JOIN papertags ON repository.paperid = papertags.paperid INNER JOIN tags ON papertags.tid = tags.tid INNER JOIN license ON repository.licenseId = license.id WHERE repository.status ='2' and tags.tag = '" . $searchTerm ."'";
       // $sql ="SELECT repository.title as 'title', repository.url as 'url', repository.name as 'name', tags.tag as 'tag' FROM repository INNER JOIN papertags ON repository.paperid = papertags.paperid INNER JOIN tags ON papertags.tid = tags.tid WHERE repository.title LIKE ''%'.$searchTerm.'%''";
      //  $sql = "Select keywords.id from keywords where keywords='".$searchTerm."'";

        $results = $this -> db -> query($sql);
		return $results -> result();
    }
    public function searchByPaper($searchTerm){
        $sql ="SELECT DISTINCT repository.title as 'title',repository.paperid as 'id', repository.url as 'url', repository.name as 'name' , repository.updatedate as 'date' ,repository.abstract as 'abstract', repository.year as 'year', license.license as 'license', license.display as 'display' From repository INNER JOIN license ON repository.licenseID = license.id WHERE repository.status ='2' and repository.title LIKE '%$searchTerm%'";
        $results = $this -> db -> query($sql);
        return $results -> result();

    }
    public function searchKeywords($searchTerm){

        $sql = "Select DISTINCT keywords.type as 'type' from keywords where keywords='".$searchTerm."'";
        $results = $this -> db -> query($sql);
        return $results -> result();
    }

    public function searchByName($searchTerm){
        $sql ="SELECT DISTINCT repository.title as 'title',repository.paperid as 'id', repository.url as 'url', repository.name as 'name' , repository.updatedate as 'date' ,repository.abstract as 'abstract', repository.year as 'year', license.license as 'license', license.display as 'display' FROM repository INNER JOIN license ON repository.licenseId = license.id WHERE repository.status ='2' and repository.name LIKE '%$searchTerm%'";
        $results = $this -> db -> query($sql);
        return $results -> result();
    }
     public function getPapers($status){

         $this -> db -> trans_start();
         $sql = "Select paperId,title,cwid,updatedate,url from repository where status in ('$status');";
         $results = $this ->db -> query($sql);
         if($results!= null){

             return $results -> result();
         }else{

             return 0;
         }
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

    public function countWithStatus($status,$dept_id){


        $this -> db -> select('paperid');
        $this -> db -> from('repository');
        $this -> db -> where('status', $status);
        if($dept_id != 0 && $dept_id != null) {
        $this -> db -> where('dept_id', $dept_id);
        }
/*        $this -> db -> trans_start();
        $sql = "Select * from repository where status in $status and dept_id in $dept_id";
        $this ->db -> query($sql);*/

        return $this -> db -> count_all_results();
    }

    public function getPasscode($id){
        $this ->db ->trans_start();
        // $this ->db ->where('type','admin');
        // $results =   $this ->db ->get('passcode');
       // $type ='admin';
        $sql="SELECT pass FROM passcode WHERE id='$id';";
        $results = $this->db->query($sql);
        //   print_r($results-> result());
        if($results != null) {
            foreach($results->result() as $row) {
                $passcode = $row-> pass;
                return $passcode;
            }
        }
        else{
            return 0;
        }

    }
    public function getDepartments(){

        $this ->db ->trans_start();
        $sql = "SELECT  * FROM department";
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{

            return 0;
        }

    }
   
    public function getDept($dept_id){

        $this ->db ->trans_start();
        $sql = "SELECT  * FROM department where dept_id =$dept_id";
        $results = $this->db->query($sql);
        if($results !=null) {
            return $results->result();
        } else{

            return 0;
        }

    }
    public function papersWithStatus($limit=0, $status,$dept_id){
        $this->db->limit($limit);
        $this->db->offset($this ->input ->get('per_page'));
        $this->db-> where('status',$status);
        if($dept_id != null && $dept_id != 0) {
            $this->db->where('dept_id', $dept_id);
        }
        $this->db-> order_by('updatedate','desc');
        return $this->db->get('repository');
    }


}

?>