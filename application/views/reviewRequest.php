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
    if($requestinfo[4] != null){
        $eventStartDate =$requestinfo[4];
        $eventEndDate = $requestinfo[5];
        $startTime =$requestinfo[6];
        $endTime = $requestinfo[7];
    } else {
        $eventStartDate ="NA";
        $eventEndDate = "NA";
        $startTime = "NA";
        $endTime = "NA";
    }
    //if($requestinfo[8] != null){
        $eventType = $requestinfo[8];
        $roomId = $requestinfo[9];
    /*} else {
        $eventType = "NA";
        $roomId = "Please Enter Room ID";
    }*/
    $numOfPeople = $requestinfo[10];
    $scheType = $requestinfo[11]; //old- $eventDescLib = $requestinfo[11];
    $negotiable = $requestinfo[12];
    $eventReq = $requestinfo[13];
    $status = $requestinfo[14];
    $foodFlag = $requestinfo[15];
    /*if($requestinfo[15] != ''){
        $roomName = $requestinfo[15];
        $roomLoc = $requestinfo[16];
    } else {*/
        $roomName = "NA";
        $roomLoc = "NA";
    //}

    //room info
    // $roomName = $roominfo[1];
    // $roomLocation = $roominfo[2];
    // $locDesc = $roominfo[3];
    // $roomCapacity = $roominfo[4];
    // $roomTechnology = $roominfo[5];
    // $roomsplcon = $roominfo[6];
    
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
            if(<?php echo $status ?> ==1){
                document.getElementById('step1').className='warning';
                document.getElementById('step2').className='';
                document.getElementById('step3').className='';
                document.getElementById('step4').className='';
             
               
                //document.getElementById("complete").style.display="none";
                //document.getElementById("completeTransaction").style.display = "none";
               
            }else if(<?php echo $status ?> ==2){ //status 2 - returned
                document.getElementById('step1').className='danger';
                document.getElementById('step2').className='danger';
                document.getElementById('step3').className='';
                document.getElementById('step4').className='';
                document.getElementById("approve").style.display = "none";
                document.getElementById("disapprove").style.display = "none";
                //document.getElementById("completeTransaction").style.display = "none";
            }else if(<?php echo $status ?> ==3){//status 3 - approved
                document.getElementById('step1').className='completed';
                document.getElementById('step2').className='completed';
                document.getElementById('step3').className='completed';
                document.getElementById('step4').className='';
                document.getElementById("approve").style.display = "none";
                document.getElementById("disapprove").style.display = "none";
                document.getElementById("instructions").style.display="none";
            }
            else if(<?php echo $status ?> ==4){//status 4 - completed
                document.getElementById('step1').className='completed';
                document.getElementById('step2').className='completed';
                document.getElementById('step3').className='completed';
                document.getElementById('step4').className='completed';
                document.getElementById("approve").style.display = "none";
                document.getElementById("disapprove").style.display = "none";
                document.getElementById("instructions").style.display="none";
            }
            var inputemail = 0;
            /* validation ends */
            $('#formcontents').hide();
            var inst = 0;
            
            $('button#disapprove').click(function(e){
                if ($('input#requesterName').val() == ""){
                    $('input#requesterName').css('border','1px solid red');
                    e.preventDefault();
                }else if ($('input#requesterEmail').val() == ""){
                    $('input#requesterEmail').css('border','1px solid red');
                    e.preventDefault();
                }else{
                    if ($('textarea#instructions').val()== 0){
                        $('textarea#instructions').css('border','1px solid red');
                        e.preventDefault();
                    }else {
                        var r = confirm("Do you want to return the request?");
                        if(r){
                            var requesterName = $('input#requesterName').val();
                            var requesterEmail = $('input#requesterEmail').val();
                            var instructions = $('textarea#instructions').val();
                            var requestID = $('input#requestID').val();
                            $.post("<?php echo base_url("?c=lpoc&m=disapproveRequest&requestID=" . $requestID);?>", {
                            requesterName:requesterName,
                            requesterEmail:requesterEmail,
                            instructions:instructions
                        }).done(function (requestID) {
                            if (requestID > 0) {
                                $('#requestStatus').show().css('background', '#66cc00').append("#" + requestID + ":Library room reservation request Form has been returned and an email sent to " + requesterName);
                                document.getElementById('step1').className = 'danger';
                                document.getElementById('step2').className = 'danger';
                                document.getElementById('step3').className = 'danger';
                                document.getElementById('step4').className = 'danger';
                                $('#instructions').empty();
                                $('#instructions').attr('disabled', 'disabled'); 
                                $('#disapprove').attr('disabled', 'disabled'); 
                                $('#approve').attr('disabled', 'disabled'); 
                                document.getElementById("disapprove").style.display = "none";
                                document.getElementById("approve").style.display = "none";
                                $('html, body').animate({scrollTop: 0}, 600);
                            } else {
                                $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");
                            }
                                $("html, body").animate({scrollTop: 0}, 600);
                            });
                        } e.preventDefault();
                    }
                }
            });

            $('button#approve').click(function(e){
    
                var email = $('input#requesterEmail').val();
                var selectEmail = email;//prompt("Please select recipient emailId",email);
                if(selectEmail != null) {
                  if ($('input#requesterName').val() == "") {
                      $('input#requesterName').css('border', '1px solid red');
                      e.preventDefault();
                  } else if ($('input#requesterEmail').val() == "") {
                      $('input#requesterEmail').css('border', '1px solid red');
                      e.preventDefault();
                  } else if ($('input#roomId').val() == "") {
                      $('input#roomId').css('border', '1px solid red');
                      e.preventDefault();
                  } else {
                    var r = confirm("Do you want to approve the request?");
                    if(r){
                        var requesterName = $('input#requesterName').val();
                        var requesterEmail = selectEmail;
                        var startdate = $('input#startdatepicker').val();
                        var enddate = $('input#enddatepicker').val();
                        var startTime = document.getElementById("startTime").value;//time attribute only works with this format
                        var endTime = document.getElementById("endTime").value;//time attribute only works with this format
                        var roomId = $('input#roomId').val();
                        var instructions = $('textarea#instructions').val();        
                        var requestID = $('input#requestID').val();
                        $.post("<?php echo base_url("?c=lpoc&m=approveRequest&requestID=" . $requestID);?>", {
                          requesterName:requesterName,
                          requesterEmail:requesterEmail,
                         /* eventName:eventName,
                          eventDesc: eventDesc,*/
                          eventStartDate: startdate,
                          eventEndDate: enddate,
                          startTime: startTime,
                          endTime:endTime,
                  		//  eventType: eventType,
                          roomId: roomId,
                        /*  numOfPeople: numOfPeople,
                          eventReq : eventReq,*/
                          instructions: instructions,
                          requestID: requestID
                        }).done(function ($requestID) {
                            console.log($requestID);
                            if ($requestID > 0) {
                                $('#requestStatus').show().css('background', '#66cc00').append("#" + $requestID + ": Library room reservation request Form has been approved and confirmation mail sent to " + requesterName);
                                document.getElementById('step1').className = 'completed';
                                document.getElementById('step2').className = 'completed';
                                document.getElementById('step3').className = 'completed';
                                document.getElementById('step4').className = '';
                                $('#instructions').empty();
                                $('#instructions').attr('disabled', 'disabled'); 
                                $('#disapprove').attr('disabled', 'disabled'); 
                                $('#approve').attr('disabled', 'disabled'); 
                                document.getElementById("disapprove").style.display = "none";
                                document.getElementById("approve").style.display = "none";
                                $('html, body').animate({scrollTop: 0}, 600);
                            } else {
                                $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");
                            }
                        $("html, body").animate({scrollTop: 0}, 600);
                      });
                    } e.preventDefault();
                }
              }
            });//end of approve function

           $('button#completed').click(function(e) {
               var r = confirm("Do you want to complete the request?");
               if(r){
                   var message = $('textarea#message').val();
                   var reqName= $('input#requesterName').val();
                   var emailId= $('input#requesterEmail').val();
                   $.post("<?php echo base_url("?c=lpoc&m=completetransaction&requestID=" . $requestID);?>", {
                        'requesterName':reqName,
                        'requesterEmail':emailId,
                        'stauts': 4,
                        'message' :message
                    }).done(function (requestID) {
                        if(requestID > 0){
                            $('#requestStatus').show().css('background', '#66cc00').append("#" + requestID + ":The request has been now marked Complete.");
                            document.getElementById('step1').className = 'completed';
                            document.getElementById('step2').className = 'completed';
                            document.getElementById('step3').className = 'completed';
                            document.getElementById('step4').className = 'completed';
                            $('#instructions').empty();
                            $('#instructions').attr('disabled', 'disabled'); 
                            $('#completed').attr('disabled', 'disabled'); 
                            document.getElementById("completed").style.display = "none";
                            document.getElementById("message").style.display = "none";
                            $('html, body').animate({scrollTop: 0}, 600);
                        } else {
                        $('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator");
                        }
                    });
                    $("html, body").animate({scrollTop: 0}, 600);
                } e.preventDefault();
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
            <div id="researcherInfo"><h1 class="page_head" align="center" style="float: none;">Library Room Reservation Request Admin Form</h1>
            
                <div id="requestStatus" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
                </div>
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
                    <li id="step4" class="">
                        <span class="bubble"></span>
                        Completed
                    </li>
                </ul></br>
                <div id="confirmations"></div></br>
                <div align="right">
                    <div  style="width:170px;height:30px; background: #b31b1b;" class="box" id="requestInf">
                        <h3 style="color: white;text-align: center; vertical-align:middle;line-height: 30px;">Request ID : <?php echo $requestID ?></h3>
                        <input type="hidden" id="requestID" class="textinput"  value = "<?php echo $requestID; ?>" style="width: 100px;"readonly/>
                    </div>
                </div></br>
                <div class="accordion" id="2"><h4 id="2">Section 1: Event Information:</h4><span class="click">Click to Open/Close</span></div>
                <div class="formcontents container" id="2-contents" aria-readonly="true">
                    <label class="label">Requester&#39;s Name:</label><br/><input type="text" id="requesterName" name="requesterName" class="textinput" value = "<?php echo $requesterName; ?>"readonly/>
                    <label class="label">Requester&#39;s Email:</label><br/><input type="email" id="requesterEmail" name="requesterEmail" class="textinput"  value = "<?php echo $requesterEmail; ?>" readonly/>
                    <label class="label">Event Name:</label><br/><input type="text" id="eventName" class="textinput" value = "<?php echo $eventName; ?>" readonly />
          			<label class="label">Event Description:</label><br/><textarea id="eventDesc" class="readonlytext" style="height: 150px; overflow: auto; width: 400px;" readonly><?php echo $eventDesc; ?></textarea>
                               

                      <label class="label">Number of people:</label><br/><input type="text" id="numOfPeople" class="textinput" value = "<?php echo $numOfPeople; ?>" readonly/>         			
                      <label class="label">Will food be served?: <?php echo ucfirst($foodFlag); ?></label><br /><br />
                      <label class="label">Special Event Requirements:</label><br/><textarea id="eventReq" class="readonlytext" style="height: 150px; overflow: auto; width: 400px;" readonly><?php echo $eventReq; ?></textarea>
                         
                    <?php 
                        if($scheType != 'NA'){
                           ?>   <label class="label" style="color: #b31b1b; font-style: italic"><?php echo ucfirst($requesterName); ?> is <?php echo $scheType; ?> about the event schedule. Please assist with the scheduling. Date should be in yyyy-mm-dd format.</label><br /><br />
                                <!--label class="label">Start Date:</label><br/><input class="form-control textinput" name="startDate" id="startdatepicker" type="date"/> </br> 
                                <label class="label">Start Time:</label><br/><input class="form-control textinput" type="time" id="startTime" name="startTime"  /></br>
                                <label class="label">End Date:</label><br/><input class="form-control textinput" name="endDate" id="enddatepicker" type="date"/> </br > 
                                <label class="label">End Time:</label><br/><input class="form-control textinput" type="time" id="endTime" name="startTime"  /></br-->
                        <?php }?>
                                <label class="label">Start Date:</label><br/><input type="text" id="startdatepicker" class="textinput"  value = "<?php echo $eventStartDate; ?>"  />
                                <label class="label">Start Time:</label><br/><input type="time" id="startTime" class="textinput"  value = "<?php echo $startTime; ?>" style="width: 150px;" />
                                <label class="label">End Date:</label><br/><input type="text" id="enddatepicker" class="textinput"  value = "<?php echo $eventEndDate; ?>" />                        
                                <label class="label">End Time:</label><br/><input type="time" id="endTime" class="textinput"  value = "<?php echo $endTime; ?>" style="width: 150px;" />
                       
                     <?php  
                        if($negotiable != 'NA'){
                           ?> <label class="label" style="color: #b31b1b; font-style: italic">The schedule for the event is <?php echo $negotiable ; ?>.</label><br /><br />
                        <?php } 
                    ?>    
                      <label class="label">Assigned Room:</label><br/><input type="text" id="roomId" class="textinput" value = "<?php echo $roomId; ?>"  />         			
                       
                    </br></br>
                </div>  
                <?php
                if(sizeof($chatList)>0){
                    ?>
                <div class="accordion container" id="1"><h4 align="left" id="1">Conversations</h4><span class="click">Click to Open/Close</span></div>
                <?php  }?>
                <div id="1-contents" class="container">
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
                <div id ="instructions" class="container">
                    </br><label class="label">Optional Message (This will be part of the email sent to the researcher):</label><br/><textarea id="instructions" name="instructions" rows="8" cols="75" style="display: block; margin-bottom: 10px; width: 100%; font-size: 15px;" ></textarea>
                </div>
                <button class="btn" type="submit" id="approve">Approve</button>
                <button class="btn" type="button" id="disapprove">Return for review</button></br>
                <?php 
                date_default_timezone_set("America/New_York");
                // $eventEndDate = strtotime($eventEndDate);
                // $endDate = date('Y/m/d',$eventEndDate);
                
                if($status == 3){ ?>
                <div id="completeTransaction" class="container" name="completeTransaction" style="display:block">
                <?php echo form_open_multipart('lpoc/do_upload');?>
                </form><br /><br />
                    <label class="label">Click the link below to add event completion report</label><br/><br />
                    <a href="https://goo.gl/forms/ockpp3uGjfzZC5O33" target="_blank" role="button"><button class="btn" type="button" id="complete">Event Completion report</button></a>
                    <br /><br />
                    <label class="label">Message:</label><br/>
                    <textarea id="message" name='message' rows="8" cols="75" style="display: block; margin-bottom: 10px;width: 100%; font-size: 18px;" ></textarea>
                    <button class="btn" type="button" id="completed">Complete Transaction</button>
                    
                </div>

            <? } else if($status == 4) { ?>
                <label class="label">Click the link below see event completion report</label><br/><br />
                <a href="https://docs.google.com/forms/d/1a4IxafZpq7mXk-kgvw0P1Vj0YASswBNwbb_vioKdRDI/edit#responses" target="_blank" role="button"><button class="btn" type="button" id="complete">Event Completion report</button></a>
                <br /><br />
            <? } ?>
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