<?php
class auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        session_start();

    }

	
	function dbAuth(){
		 $_SESSION['CAS'] = TRUE; 
		if (isset($_SESSION['LAST_SESSION']) && (time() - $_SESSION['LAST_SESSION'] > 900)) {
            if(!isset($_SESSION['CAS'])) {
                $_SESSION['CAS'] = false; // set the CAS session to false
            }
        }
        $authenticated = $_SESSION['CAS'];
        //URL accessable when the authentication works
		$casurl = "http%3A%2F%2Flocalhost%2Frepository%2F%3Fc%3Dauth%26m%3DdbAuth"; 
		  if (!$authenticated) {
            $_SESSION['LAST_SESSION'] = time(); // update last activity time stamp
            $_SESSION['CAS'] = true;
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas/?service='.$casurl.'">';
            exit;
        }
		
		if ($authenticated) {
            if (isset($_GET["ticket"])) {
                //set up validation URL to ask CAS if ticket is good
                $_url = "https://login.marist.edu/cas/validate";
              //  $serviceurl = "http://localhost:9090/repository-2.0/?c=repository&m=cas_admin";
               // $cassvc = 'IU'; //search kb.indiana.edu for "cas application code" to determine code to use here in place of "appCode"
                   //$ticket = $_GET["ticket"];
                $params = "ticket=$_GET[ticket]&service=$casurl";
                $urlNew = "$_url?$params";

                //CAS sending response on 2 lines. First line contains "yes" or "no". If "yes", second line contains username (otherwise, it is empty).
                $ch = curl_init();
                $timeout = 5; // set to zero for no timeout
                curl_setopt ($ch, CURLOPT_URL, $urlNew);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                ob_start();
                curl_exec($ch);
                curl_close($ch);
                $cas_answer = ob_get_contents();
                ob_end_clean();

                //split CAS answer into access and user
                list($access,$user) = preg_split("/\n/",$cas_answer,2);
                $access = trim($access);
                $user = trim($user);
                //set user and session variable if CAS says YES
                if ($access == "yes") {
                    $_SESSION['user'] = $user;
                    $user= str_replace('@marist.edu',"",$user);
					   $this->load->view('dbAuth');
                    }else{
                        echo "<h1>UnAuthorized Access</h1>";
                    }
                }//END SESSION USER
                else{
                    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
                }
            } else  {
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=https://login.marist.edu/cas?service='.$casurl.'">';
            }
        }
		
	}
	
?>
