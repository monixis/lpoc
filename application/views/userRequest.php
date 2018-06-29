<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
	<style>
		table, tr {
			border: 1px solid red;
		}

		span.click{
			float: right;
			margin-top: -25px;
		}

		div.accordion{
			margin-bottom: 8px;
		}
		.progress {
			display: block;
			text-align: center;
			width: 0;
			height: 9px;
			background: #07bb6c;
			transition: width 12.5s;
			border-color: #0c0c0c;
		}
		.progress.hide {
			opacity: 0;
			transition: opacity 2.3s;
		}
		.progress.status {
			top:3px;
			left:5%;
			position:absolute;
			display:inline-block;
			color: #000000;
		}
		select{
      width: 230px;
      height: 35px;
      padding: 6px 12px;
      font-size: 14px;
      color: #555;
      background-color: #fff;
      vertical-align: middle;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

	</style>

	<title>Use Agreement Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="http://library.marist.edu/archives/icon/box.png" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/cloneRequests.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" />
	<link rel="stylesheet" type="text/css" href="styles/useagreement.css" />
	<link rel="stylesheet" type="text/css" href="styles/progress-wizard.min.css" />
	<script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script>

	<?php
	/*$requestID= $_GET['requestID'];
	//researcher info
	$sizeofRequests = sizeof($requests);
	$userName = $researcher[0];
	$country = $researcher[1];
	$countryy = $researcher[1];
	$state = $researcher[2];
	$city = $researcher[3];
	$address =$researcher[4];
	$emailId = $researcher[5];
	$zipCode = $researcher[6];
	$date = $researcher[7];
	$phoneNumber = $researcher[8];
	$status = $researcher[9];
	$attachment = $researcher[10];
	$userInitials = $researcher[11];
	$termsAndCond = $researcher[12];
	$attachemntLink = $researcher[14];
	$requestID = $requestID;*/
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
	
	if($status == 1){
        $formStatus = "Submitted";
        //$formStatus = "Initiated";
    }elseif($status == 2){

        $formStatus = "Returned";
    }
    elseif($status == 3){
        $formStatus = "Approved";
       // $formStatus = "Submitted";
    }
	$researcherUrl = base_url("index.php/lpoc/getResearcher?requestID=").$requestID;
	?>

	<script type="text/javascript">

		function verifyEmail(email){
   			var atpos = email.indexOf("@");
    		var dotpos = email.lastIndexOf(".");
    		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        		return false;
    			}
			}

		$(document).ready(function(){
			$('#num_error').hide();

			 if("<?php echo $status ?>" ==1){
                document.getElementById('step1').className='warning';
                //document.getElementById("approve").style.display = "none";
               // document.getElementById("disapprove").style.display = "none";
                
               // document.getElementById("4").style.display="none";
               
            }else if("<?php echo $status ?>" ==2){ //status 2 - returned
                 //document.getElementById('step1').className='danger';
                document.getElementById('step1').className='danger';
                document.getElementById('step2').className='danger';
                document.getElementById('step3').className='';
                
               // document.getElementById("4").style.display="none";            
            }else if("<?php echo $status ?>" ==3){//status 3 - approved
                 //document.getElementById('step1').className='completed';
                 document.getElementById('step1').className='completed';
                document.getElementById('step2').className='completed';
                document.getElementById('step3').className='completed';
                //document.getElementById('step5').className='completed';
                
            }
			var inputemail = 1;
			var inputaccept = 0;
			$('#formcontents').hide();
			var text_max = 140;
			$('#textarea_feedback').html(text_max + ' characters remaining');

			$('#message').keyup(function() {
				var text_length = $('#message').val().length;
				var text_remaining = text_max - text_length;

				$('#textarea_feedback').html(text_remaining + ' characters remaining');
			});

			<?php  if($status == 2 || $status ==3 ) {?>
			document.getElementById("save").style.display = "none";
			document.getElementById("submit").style.display = "none";
			<?php } ?>

			<?php if ($status == 3) {?>
		/*	document.getElementById("save").style.display = "none";
			document.getElementById("submit").style.display = "none";
			document.getElementById("uploaded_file").style.display = "none";
			document.getElementById("messages").style.display = "none";
            document.getElementById("att").style.display="none";
			document.getElementById("buttonAdd-request").style.display="none";
			document.getElementById("buttonRemove-request").style.display="none";
			document.getElementById("addOrRem").style.display="none";*/

	        
			//requestsReadOnly
			//document.getElementById("submitInfo").style.display = "none";

			<?php } ?>

			/* Validation */
			$('input#name').keydown(function(e){
				if((e.which == 9) && ($(this).val().length == 0)){
					$(this).css('border','1px solid red');
				}else{
					$(this).css('border','1px solid #ccc');
				}
			});

			$('input#initials').keydown(function(e){
				if((e.which == 9) && ($(this).val().length == 0)){
					$(this).css('border','1px solid red');
				}else{
					$(this).css('border','1px solid #ccc');
				}
			});

			$('input#email').keydown(function(e){
					$(this).css('border','1px solid #ccc');
			});

			$('input#accept[type="checkbox"]').click(function(){
				if($(this).prop("checked") == true){
					$('#accept-cond').css({'color':'green', 'font-weight':'bold'});
					inputaccept = 1
				}
				else if($(this).prop("checked") == false){
					$('#accept-cond').css({'color':'#b31b1b', 'font-weight':'bold'});
					inputaccept = 0;
				}
			});
			$('input#condofuse[type="checkbox"]').click(function() {
				if($(this).prop("checked") == true) {
					$('#cond_of_use').css({'color':'green', 'font-weight':'bold'});
					inputaccept = 1

				}else if($(this).prop("checked") == false){
					$('#cond_of_use').css({'color':'#b31b1b', 'font-weight':'bold'});
					inputaccept = 0;
				}
			});

/*			$('#NumConditions').on('change', function() {
				if($(this).val()!=10) {
					$("#NumConditions").css('backgroundColor', this.style.backgroundColor);
					$('#num_error').show();
				}else{

					$('#num_error').hide();

				}
				});*/
				/* validation ends */
			$('#startdatepicker').datepicker();
            $('#enddatepicker').datepicker();
			//alert(requestsCnt);
			$('button#save').click(function(){
				var startdate = $('input#startdatepicker').val();
                var enddate = $('input#endpicker').val();
                var requesterName = $('input#requesterName').val();
                var requesterEmail = $('input#requesterEmail').val();
				var eventName = $('input#eventName').val();
				var eventDesc = $('textarea#eventDesc').val();
				var eventType = $('input#eventType').val();
				//var citystate = $('input#citystate').val();
				var numOfPeople = $('input#numOfPeople').val();
				var eventDescLib = $('textarea#eventDescLib').val();
				var eventReq = $('textarea#eventReq').val();
				var instructions = $('textarea#instructions').val();
				var message = $('textarea#message').val();
				if($('#accept').prop('checked')){
					termsAndConditions = "true";
				}
				$.post("<?php echo base_url("?c=lpoc&m=saveRequest&requestID=".$requestID);?>", {
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
					message:message
				}).done(function ($requestID) {
					if ($requestID != null) {
						$('#requestStatus').show().css('background','#66cc00').append("Form saved successfully. Please submit for approval");
						//	alert("Form saved successfully for requestID:"  + requestID);
					}else
					{
						$('#requestStatus').show().css('background','#b31b1b').append("Something wrong with the form. Contact Administrator");
						// alert("Falied to save use agreement form"+requestID);
					}
					$("html, body").animate({ scrollTop: 0}, 600);
				});
			});

			$('button#submit').click(function() {
					//validations
					if ($('input#name').val() == "") {
						$('input#name').css('border', '1px solid red');
						$('div#2-contents').show();
						$("html, body").animate({scrollTop: 0}, 600);
					} else if (verifyEmail($('input#email').val()) == false) {
						$('input#email').css('border', '1px solid red');
						$("html, body").animate({scrollTop: 0}, 600);
					} else if ($('input#initials').val() == "") {
						$('input#initials').css('border', '1px solid red');
						$('div#3-contents').show();
						$("html, body").animate({scrollTop: 1000}, 600);
					} else if ($(this).prop("checked") == false) {
						$('#accept-cond').css({'color': '#b31b1b', 'font-weight': 'bold'});
						$('#cond_of_use').css({'color': '#b31b1b', 'font-weight': 'bold'});
						$('div#3-contents').show();
					}
					else {

						<?php  if($status == 1 || $status == 2) {?>
						var startdate = $('input#startdatepicker').val();
                        var enddate = $('input#endpicker').val();
                        var requesterName = $('input#requesterName').val();
                        var requesterEmail = $('input#requesterEmail').val();
                        var eventName = $('input#eventName').val();
                		var eventDesc = $('textarea#eventDesc').val();
                		var eventType = $('input#eventType').val();
                        var roomId = $('input#roomId').val();
                        //var citystate = $('input#citystate').val();
                        var numOfPeople = $('input#numOfPeople').val();
                        var eventDescLib = $('textarea#eventDescLib').val();
                        var eventReq = $('textarea#eventReq').val();
						
						$.post("<?php echo base_url("?c=lpoc&m=submitRequest&requestID=" . $requestID);?>", {
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
						}).done(function (requestID) {
							if (requestID != null) {
								$('#requestStatus').show().css('background', '#66cc00').append("Form submitted successfully. We'll get back to you shortly");
								$("html, body").animate({scrollTop: 0}, 600);
								document.getElementById('step1').className = 'warning';
								document.getElementById('step2').className = 'warning';
								document.getElementById('step3').className = '';
							else {
								$('#requestStatus').show().css('background', '#b31b1b').append("Something wrong with the form. Contact Administrator.");
								$("html, body").animate({scrollTop: 0}, 600);
							}
						});
						document.getElementById("submit").disabled = true;
						document.getElementById("save").disabled = true;
						<?php }else{ ?>
						alert("This form has already been submitted. Unfortunately cannot be edited now!");
						<?php } ?>
					}
				}
			}else{
					$('#requestStatus').show().css('background', '#b31b1b').append("<div id='message'>Uploaded file size should be less than 2 MB</div>");
					setTimeout(function () {
						$('#requestStatus').hide();
					}, 3000);

				}
				//$("html, body").animate({scrollTop: 0}, 600);
			}); //end of submit function
			$('div#request_input').clone();
		}); // end of document function
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
<div class= "content_container">
	<div class = "container_home_child" >
		<div class = "ref_box">
			<table>
				<th class = "search_drop_header" colspan="4">Library Resources</th>
				<tr>
					<td class = "search_drop"><a href="http://voyager.marist.edu/vwebv/searchBasic"><img src ="http://library.marist.edu/images/library_catalog_red.png" title="Library Catalog"></a></td>
					<td class = "search_drop"><a href="http://libguides.marist.edu/"><img src ="http://library.marist.edu/images/library_pathfinders_red.png" title="Pathfinders"></a></td>
					<td class = "search_drop"><a href="http://library.marist.edu/forms/ask.php"> <img src ="http://library.marist.edu/images/ask_a_librarian_red.png" title="Ask A Librarian"></a></td>
					<td class = "search_drop_last"><a href="http://site.ebrary.com.online.library.marist.edu/lib/marist/home.action"><img src ="http://library.marist.edu/images/ebrary_small.png" title ="ebrary"></a></td>
				</tr>
			</table>
		</div>
		<div class="content">
			<p class="breadcrumb">
				<a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
				> Forms > Reserve Forms
			</p>

			<div id="researcherInfo"><h1 class="page_head" style="float: none;">Use Agreement Form</h1></br>

				<div id="requestStatus" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
				</div></br>
				<div id ="progressstatus"></div></br></br>
				<div class="progress"></div>
				<div class="progress"></div>
				</br></br>
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
				<div align="right">
					<div  style="width:170px;height:30px; background: #b31b1b;" class="box" id="requestInf">

						<h3 style="color: white;text-align: center; vertical-align:middle;line-height: 30px;">Request ID : <?php echo $requestID ?></h3>
					</div>
				</div></br>
<!--				<div id="statusInfo">

					<h3 align="right">Status: <?php /*echo $formStatus */?></h3></br></br>

				</div>-->
<!--				<div id="stat" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; font-size: 12pt; text-align: right; padding-top: 10px; display: none;">
				</div>-->
				<!--change: showing conversation for any status value -->
				<?php if ($status>0) {?>
					<?php
					if(sizeof($chatList)>0){
						?><div class="accordion" id="1"><h4 align="left" id="1" >Conversations</h4><span class="click">Click to Open/Close</span></div>
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
				<?php } ?>
				<div class="accordion" id="2"><h4 id="2">Section 1: Researcher's Information:</h4><span class="click">Click to Open/Close</span></div>
				<div class="formcontents" id="2-contents" aria-readonly="true">
                    <label class="label">Start Date:</label><br/><input type="text" id="startdatepicker" class="textinput"  value = "<?php echo $eventStartDate; ?>" style="width: 100px;"readonly/>
                    <label class="label">End Date:</label><br/><input type="text" id="enddatepicker" class="textinput"  value = "<?php echo $eventEndDate; ?>" style="width: 100px;"readonly/>
                    <label class="label">Requester&#39;s Name:</label><br/><input type="text" id="requesterName" class="textinput" value = "<?php echo $requesterName; ?>"readonly/>
                    <label class="label">Requester&#39;s Email:</label><br/><input type="text" id="requesterEmail" class="textinput"  value = "<?php echo $requesterEmail; ?>" readonly/>
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

						<button class="btn" type="submit" id="submit">Submit</button>
						<button class="btn" type="button" id="save">Save</button>

			</div>
			</div> <!-- researcherInfo -->


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
			}

		});
	</script>
</body>
</html>
