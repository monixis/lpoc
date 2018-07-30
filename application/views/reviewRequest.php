<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <style>
	body{
		background: #ffffff;
	}
        table, tr {
            border: 1px solid black;
            background-color: transparent;
        }

        span.click{
			float: right;
			margin-top: -25px;
		}

		div.accordion{
			margin-bottom: 8px;
		}
    textarea {
      height: auto;
      width: auto;
      scroll-behavior: smooth;
      overflow-y: auto;
      overflow-x: hidden;
    }

    </style>
    <title>Library Room Reservation Request Admin View</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>	
    <link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">    
    <link rel="stylesheet" type="text/css" href="styles/useagreement.css" />
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/progress-wizard.min.css" />
    <?php
    $requestID= $_GET['requestID'];
    //researcher info
   //$sizeofRequests = sizeof($requests);
    $requesterName = $requestinfo[0];
    $requesterEmail = $requestinfo[1];
    $eventName = $requestinfo[2];
    $eventDesc = $requestinfo[3];
    $eventStartDate =$requestinfo[4];
    $eventEndDate = $requestinfo[5];
    $eventType = $requestinfo[6];
    $roomId = $requestinfo[7];
    $numOfPeople = $requestinfo[8];
    $eventDescLib = $requestinfo[9];
    $eventReq = $requestinfo[10];
    $status = $requestinfo[11];

    //room info
    $roomName = $roominfo[1];
    $roomLocation = $roominfo[2];
    $locDesc = $roominfo[3];
    $roomCapacity = $roominfo[4];
    $roomTechnology = $roominfo[5];
    $roomsplcon = $roominfo[6];



    /*$sizeofRequests = sizeof($requests);
    $requesterName = $researcher[0];
    $requesterEmail = $researcher[1];
    $eventName = $researcher[2];
    $eventDesc = $researcher[3];
    $eventStartDate =$researcher[4];
    $eventEndDate = $researcher[5];
    $eventType = $researcher[6];
    $roomId = $researcher[7];
    $numOfPeople = $researcher[8];
    $eventDescLib = $researcher[9];
    $eventReq = $researcher[10];
    $status = $researcher[11];*/
    

    if($status == 1){
        $formStatus = "Submitted";
    }elseif($status == 2){

        $formStatus = "Returned";
    }
    elseif($status == 3){
        $formStatus = "Approved";
    }
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            //status 1- submitted
            if("<?php echo $status ?>" ==1){
                document.getElementById('step1').className='warning';
                //document.getElementById("approve").style.display = "none";
               // document.getElementById("disapprove").style.display = "none";
                document.getElementById("complete").style.display="none";
               // document.getElementById("4").style.display="none";
               
            }else if("<?php echo $status ?>" ==2){ //status 2 - returned
                 //document.getElementById('step1').className='danger';
                document.getElementById('step1').className='danger';
                document.getElementById('step2').className='danger';
                document.getElementById('step3').className='';
                document.getElementById("approve").style.display = "none";
                document.getElementById("disapprove").style.display = "none";
                document.getElementById("complete").style.display="none";
               // document.getElementById("4").style.display="none";            
            }else if("<?php echo $status ?>" ==3){//status 3 - approved
                 //document.getElementById('step1').className='completed';
                 document.getElementById('step1').className='completed';
                document.getElementById('step2').className='completed';
                document.getElementById('step3').className='completed';
                //document.getElementById('step5').className='completed';
                document.getElementById("approve").style.display = "none";
                document.getElementById("disapprove").style.display = "none";
                document.getElementById("complete").style.display = "none";
                document.getElementById("instructions").style.display="none";
                document.getElementById("message").style.display = "none";
            }
            var inputemail = 0;


            /* validation ends */

            $('#formcontents').hide();
            var inst = 0;

            <!--?php if ($requestAddedBy == "Email") {?-->

            //document.getElementById("formcontents").style.display = "none";
            //document.getElementById("approve").style.display = "none";
            //document.getElementById("disapprove").style.display = "none";
            //document.getElementById("attachment").style.display = "none";
            //document.getElementById("submitInfo").style.display = "none";
            //document.getElementById("requests").style.display = "none";
            //document.getElementById("accept").style.display = "none";

            <!--?php } ?-->

            $('#startdatepicker').datepicker();
            $('#enddatepicker').datepicker();
            /*var requestsCnt = 0;
            var reqSize = "<//?php echo sizeof($requests)?>";
            var fields = $('div#request_input').html();
            for (var j= 0;j<reqSize; j++ ) {
                var request_input = "";
                requestsCnt = requestsCnt + 1;
                request_input = "request_input" + requestsCnt + "";
                var requests = "<div id=" + request_input + " style='border-bottom: 1px solid; padding: 10px;'>" + fields;
                $('div#formcontents').append(requests);
            }
            var tNc = '<//?php echo $termsAndConditions?>';
            if(tNc =="true"){
                $('#accept').prop('checked',true);
                $('#condofuse').prop('checked',true)    ;
                $('#cond_of_use').css({'color':'green', 'font-weight':'bold'});
                $('#accept-cond').css({'color':'green', 'font-weight':'bold'});

            }else{
                $('#accept-cond').css({'color':'#b31b1b', 'font-weight':'bold'});

            }
            requestsCnt = 0;*/
   
            //alert(requestsCnt);
            $('button#disapprove').click(function(){
                if ($('input#requesterName').val() == ""){
                    $('input#requesterName').css('border','1px solid red');
                }else if ($('input#requesterEmail').val() == ""){
                    $('input#requesterEmail').css('border','1px solid red');
                }else{
                    if ($('textarea#instructions').val()== 0){
                        $('textarea#instructions').css('border','1px solid red');
                    }else {
                        var startdate = $('input#startdatepicker').val();
                        var enddate = $('input#endpicker').val();
                        var requesterName = $('input#requesterName').val();
                        var requesterEmail = $('input#requesterEmail').val();
                        var eventName = $('input#eventName').val();
                		var eventDesc = $('textarea#eventDesc').val();
                		var eventType = $('input#eventType').val();
                        var roomId = $('input#roomId').val();
                        var numOfPeople = $('input#numOfPeople').val();
                        var eventDescLib = $('textarea#eventDescLib').val();
                        var eventReq = $('textarea#eventReq').val();
                        var instructions = $('textarea#instructions').val();
                        console.log(instructions);
                        $.post("<?php echo base_url("?c=lpoc&m=disapproveRequest&requestID=" . $requestID);?>", {
                          eventStartDate: startdate,
                          eventEndDate: enddate,
                          requesterName:requesterName,
                          requesterEmail:requesterEmail,
                          eventName:eventName,
                          eventDesc: eventDesc,
                		  eventDescLib: eventDescLib,
                  		  eventType: eventType,
                          roomId: roomId,
                          numOfPeople: numOfPeople,
                          eventReq : eventReq,
                          instructions:instructions
                      }).done(function (requestID) {
                            if (requestID > 0) {
                                $('#requestStatus').show().css('background', '#66cc00').append("#" + requestID + ":User Agreement Form has been disapproved and an email sent to " + requesterName);
                              // $('#stat').show().append("Status: Approved");
                              //document.getElementById('step1').className = 'completed';
                              document.getElementById('step1').className = 'danger';
                              document.getElementById('step2').className = 'danger';
                              document.getElementById('step3').className = 'danger';
                              //var htmlcleaned = $('#statusInfo h3').html().replace(/<br\s?\/?>/,'');
                              //  $('#statusInfo h3').html(htmlcleaned);
                              // $('#statusInfo').hide();

                          } else {
                              $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");

                          }
                          $("html, body").animate({scrollTop: 0}, 600);
                      });
                    }
                }
            });

            $('button#approve').click(function(){
                var email = $('input#requesterEmail').val();
                var selectEmail = prompt("Please select recipient emailId",email);

              if(selectEmail != null) {
                  if ($('input#requesterName').val() == "") {
                      $('input#requesterName').css('border', '1px solid red');
                  } else if ($('input#requesterEmail').val() == "") {
                      $('input#requesterEmail').css('border', '1px solid red');
                  } else {
                      var startdate = $('input#startdatepicker').val();
                        var enddate = $('input#endpicker').val();
                        var requesterName = $('input#requesterName').val();
                        var requesterEmail = selectEmail;
                        var eventName = $('input#eventName').val();
                		var eventDesc = $('textarea#eventDesc').val();
                		var eventType = $('input#eventType').val();
                        var roomId = $('input#roomId').val();
                        //var citystate = $('input#citystate').val();
                        var numOfPeople = $('input#numOfPeople').val();
                        var eventDescLib = $('textarea#eventDescLib').val();
                        var eventReq = $('textarea#eventReq').val();
                        var instructions = $('textarea#instructions').val();                    
                      $.post("<?php echo base_url("?c=lpoc&m=approveRequest&requestID=" . $requestID);?>", {
                          eventStartDate: startdate,
                          eventEndDate: enddate,
                          requesterName:requesterName,
                          requesterEmail:requesterEmail,
                          eventName:eventName,
                          eventDesc: eventDesc,
                		  eventDescLib: eventDescLib,
                  		  eventType: eventType,
                          roomId: roomId,
                          numOfPeople: numOfPeople,
                          eventReq : eventReq,
                          instructions: instructions
                      }).done(function ($requestID) {
                          if ($requestID > 0) {
                              $('#requestStatus').show().css('background', '#66cc00').append("#" + $requestID + ": User Agreement Form has been approved and confirmation mail sent to " + requesterName);
                              // $('#stat').show().append("Status: Approved");
                              //document.getElementById('step1').className = 'completed';
                              document.getElementById('step1').className = 'completed';
                              document.getElementById('step2').className = 'completed';
                              document.getElementById('step3').className = 'completed';
                              //var htmlcleaned = $('#statusInfo h3').html().replace(/<br\s?\/?>/,'');
                              //  $('#statusInfo h3').html(htmlcleaned);
                              // $('#statusInfo').hide();

                          } else {
                              $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");
                          }
                          $("html, body").animate({scrollTop: 0}, 600);
                      });

                  }
              }
            });//end of approve function
           $('button#complete').click(function() {

               var user_name =  $('input#name').val();
               var user_email =  $('input#email').val();
               var message = $('textarea#message').val();
              //  var m_data = new FormData();
                //m_data.append('user_name', $('input#name').val());
                //m_data.append('user_email', $('input#email').val());
                //m_data.append('message', $('textarea#message').val());

                //m_data.append('file_attach', $('input#uploaded_file')[0].files[0]);
                //m_data.append('file_attach', $('input#uploaded_file')[1].files[1]);
                //m_data.append('file_attach', $('input#uploaded_file')[2].files[2]);

            //    m_data.append('date', $('input#datepicker').val());
               $.post("<?php echo base_url("?c=lpoc&m=completetransaction&requestID=".$requestID);?>", {
                   user_name: user_name,
                   user_email:user_email,
                   message :message

               }).done(function (response) {
                   if(response>0){
                       $('#requestStatus').show().css('background', '#66cc00').append("Email has been sent to user");
                       document.getElementById('step1').className = 'completed';
                       document.getElementById('step2').className = 'completed';
                       document.getElementById('step3').className = 'completed';
                       document.getElementById('step4').className = 'completed';
                       //document.getElementById('step5').className = 'completed';
                   }else{

                       $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");

                   }


               });
/*                $.ajax({
                    type: "POST",
                    url: "<!--?php echo base_url("?c=lpoc&m=completetransaction&requestID=".$requestID);?>",
                    data: m_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function (response) {


                    }
                });*/
               $("html, body").animate({scrollTop: 0}, 600);

           });

            $('div#request_input').clone();

        });
        //});// end of document function
    </script>
</head>
<body>
<div id="headerContainer">
    <div id="header">
        <div id="logo">
        </div><!-- /logo -->
    </div>
</div>
<div id="menu">
    <div id="menuItems">
    </div><!-- /menuItems -->
</div><!-- /menu -->
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">

</div>
<div class= "content_container">
    <div class = "container_home_child" >
        
        <div class="content">
           
            <div id="researcherInfo"><h1 class="page_head" align="center" style="float: none;">Library Room Reservation Request Admin Form</h1></br>
                </br>
                <div id="requestStatus" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
                </div></br>
                <ul class="progress-indicator">
                 
                    <li id="step1" class="">
                        <span class="bubble"></span>
                        Submitted <br>
                    </li>
                    <li id="step2"  class="">
                        <span class="bubble"></span>
                        Returned <br>
                    </li>
                    <li id="step3" class="">
                        <span class="bubble"></span>
                        Approved
                    </li>
                
                </ul></br>
                <div id="confirmations"></div></br>
<!--                <div id="statusInfo">
                    <h3 align="right">Status: <!--?php /*echo $formStatus */?></h3></br></br>
                </div>
                <div id="stat" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; font-size: 12pt; text-align: right; padding-top: 10px; display: none;">
                </div>-->
                <div align="right">
                    <div  style="width:170px;height:30px; background: #b31b1b;" class="box" id="requestInf">

                        <h3 style="color: white;text-align: center; vertical-align:middle;line-height: 30px;">Request ID : <?php echo $requestID ?></h3>
                    </div>
                </div></br>
                <div class="accordion" id="2"><h4 id="2">Section 1: Event Information:</h4><span class="click">Click to Open/Close</span></div>
                <div class="formcontents" id="2-contents" aria-readonly="true">
                    <label class="label">Start Date:</label><br/><input type="text" id="startdatepicker" class="textinput"  value = "<?php echo $eventStartDate; ?>" style="width: 100px;"readonly/>
                    <label class="label">End Date:</label><br/><input type="text" id="enddatepicker" class="textinput"  value = "<?php echo $eventEndDate; ?>" style="width: 100px;"readonly/>
                    <label class="label">Requester&#39;s Name:</label><br/><input type="text" id="requesterName" name="requesterName" class="textinput" value = "<?php echo $requesterName; ?>"readonly/>
                    <label class="label">Requester&#39;s Email:</label><br/><input type="text" id="requesterEmail" name="requesterEmail" class="textinput"  value = "<?php echo $requesterEmail; ?>" readonly/>
                    <label class="label">Event Name:</label><br/><input type="text" id="eventName" class="textinput" value = "<?php echo $eventName; ?>" readonly />
          			<label class="label">Event Description:</label><br/><textarea id="eventDesc" class="readonlytext" readonly><?php echo $eventDesc; ?></textarea>
                    <label class="label">Event Type:</label><br/><input type="text" id="eventType" class="textinput" value = "<?php echo $eventType; ?>" readonly/>
                    <label class="label">Room Id:</label><br/><input type="text" id="roomId" class="textinput" value = "<?php echo $roomId; ?>" readonly/>
                    <label class="label">Room Name:</label><br/><input type="text" id="roomName" class="textinput" value = "<?php echo $roomName; ?>" readonly/>
                    <label class="label">Location:</label><br /><input type="text" id="roomLocation" class="textinput" value = "<?php echo $roomLocation; ?> Floor" readonly/>
                    <label class="label">Location Description: </label></br><input type="text" id="locDesc" class="textinput" value = "<?php echo $locDesc; ?>" readonly/>
                    <label class="label">Capacity: </label><input type="text" id="roomCapacity" class="textinput" value = "<?php echo $roomCapacity; ?>" readonly/>
                    <label class="label">Number of people:</label><br/><input type="text" id="numOfPeople" class="textinput" value = "<?php echo $numOfPeople; ?>" />
          			<label class="label">How the event relates to library:</label><br/><textarea id="eventDescLib" class="readonlytext" readonly><?php echo $eventDescLib; ?></textarea>
          			<label class="label">Special Event Requirements:</label><br/><textarea id="eventReq" class="readonlytext" readonly><?php echo $eventReq; ?></textarea>
                    </br></br>
                </div>  

                <?php
                if(sizeof($chatList)>0){
                    ?>
                <div class="accordion" id="1"><h4 align="left" id="1">Conversations</h4><span class="click">Click to Open/Close</span></div>
                <?php  }?>
                <div id="1-contents">

                    <!--table style="border: none; margin-top: -10px; margin-bottom: 10px; padding-left: 15px;"-->
                    <?php foreach ($chatList as $chat){ ?>
                        <!--tr>
							<?php echo "<td ><strong>".$chat['commentType'] . "</strong></p></td>";?>
							<?php echo "<td ><strong>DATE</strong></p></td>";?>
							<?php echo "<td ><strong>TIME</strong></p></td>";?>

						</tr>
						<tr>
							<?php echo "<td aria-autocomplete='inline'>".$chat['comment'] . "</td>";?>
							<?php echo "<td aria-autocomplete='inline'>".$chat['comment_add_date'] . "</td>";?>
							<?php echo "<td>".$chat['comment_add_time'] . "</td>";?>
						</tr-->
                        <div class="conversations">
                            <strong><?php echo "<td>".$chat['commentType']." - ". $chat['comment_add_date']." ". $chat['comment_add_time'] .": </td>";?></strong><br/>
                            <?php echo "<td aria-autocomplete='inline'>".$chat['comment'] . "</td>";?>
                        </div>

                    <?php } ?>
                </div>


                <div id ="instructions">
                    </br><label class="label">Optional Message (This will be part of the email sent to the researcher):</label><br/><textarea id="instructions" name="instructions" rows="8" cols="75" style="display: block; margin-bottom: 10px;" ></textarea>
                </div>
                <button class="btn" type="submit" id="approve">Approve</button>
                <button class="btn" type="button" id="disapprove">Return for review</button></br>

 				<div id="completeTransaction" style="visibility: hidden;">
                    <label class="label">Message:</label><br/><textarea id="message" name='message' rows="8" cols="75" style="display: block; margin-bottom: 10px;" ></textarea>
                    <button class="btn" type="button" id="complete">Complete Transaction</button>

                    <!--button class='btn' type="button" id="complete" name="submit" value="Complete Transaction"-->
                </div>

            </div>


        </div> <!-- content -->
    </div>

    <div class="bottom_container">
        <p class = "foot">
            James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
            <br />
            &#169; Copyright 2007-2016 Marist College. All Rights Reserved.
		<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href=<?php echo base_url("?c=lpoc&m=ack");?> target="_blank">Acknowledgements</a>
        </p>
    </div>
    <script>
        $('div.accordion').click(function(){
            var div =$(this).attr('id');
            if(div == '1'){
                $('div#1-contents').toggle();
            }else if (div == '2'){
                $('div#2-contents').toggle();
            }else if (div == '3'){
                $('div#3-contents').toggle();
            }else if (div == 'requests'){
                $('div#formcontents').toggle();
            }else if(div=='4'){

                $('div#copies_sent').toggle();

            }

        });
    </script>
</body>

</html>