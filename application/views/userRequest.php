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

		form{
			width: 80%;
		}

	</style>
	<title>Library Room Reservation Request Form</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
	<link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/cloneRequests.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
	<link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">   
	<!--link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/style.css" />
	<link rel="stylesheet" type="text/css" href="http://library.marist.edu/archives/mainpage/mainStyles/main.css" /-->
	<link rel="stylesheet" type="text/css" href="styles/useagreement.css" />
	<link rel="stylesheet" type="text/css" href="styles/progress-wizard.min.css" />
	<!--script type="text/javascript" src="http://library.marist.edu/archives/mainpage/scripts/archivesChildMenu.js"></script-->

	<?php
		$requestID= $_GET['requestID'];
		$requestID = substr($requestID,6,-6);
		$requesterName = $requestinfo[0];
		$requesterEmail = $requestinfo[1];
		$eventName = $requestinfo[2];
		$eventDesc = $requestinfo[3];
		$eventStartDate =$requestinfo[4];
		$eventEndDate = $requestinfo[5];
		$startTime =$requestinfo[6];
		$endTime = $requestinfo[7];
		$eventType = $requestinfo[8];
		$roomId = $requestinfo[9];
		$numOfPeople = $requestinfo[10];
		$eventDescLib = $requestinfo[11];
		$eventReq = $requestinfo[12];
		$status = $requestinfo[13];

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
		elseif($status == 4){
			$formStatus = "Completed";
		// $formStatus = "Submitted";
		}
		$researcherUrl = base_url("index.php/lpoc/getResearcher?requestID=").$requestID;
	?>
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
			<!--p class="breadcrumb">
				<a href="http://library.marist.edu" class="map_link"><img src="http://library.marist.edu/images/home.png" class="fox2"/></a>
				> Forms > Reserve Forms
			</p-->

			<div id="researcherInfo"><h1 class="page_head" align="center" style="float: none;">Library Room Reservation Request Form</h1>
				<div id="requestStatus" style="width: auto; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;">
				</div>
				<div id ="progressstatus"></div>
				<div class="progress"></div>
				<div class="progress"></div>
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
				<form id="changeRequest" style="align:center;float:left;">
				<div class="formcontents container" id="2-contents" aria-readonly="true">
				
				
					<label class="label">RequestID:</label><br/>
						<input type="text" id="requestID" class="textinput"  value = "<?php echo $requestID; ?>" style="width: 100px;"readonly/>
				<?php if ($status ==1 || $status ==3 || $status ==4) { ?>
					
                    <label class="label">Requester&#39;s Name:</label><br/>
						<input type="text" id="requesterName" class="textinput" value = "<?php echo $requesterName; ?>"readonly/>
                    <label class="label">Requester&#39;s Email:</label><br/>
						<input type="text" id="requesterEmail" class="textinput"  value = "<?php echo $requesterEmail; ?>" readonly/>
                    <label class="label">Event Name:</label><br/>
						<input type="text" id="eventName" class="textinput" value = "<?php echo $eventName; ?>" readonly />
					<label class="label">Event Description:</label><br/>
					  	<textarea id="eventDesc" class="readonlytext" style="height: 150px; overflow: auto; width: 400px;" readonly><?php echo $eventDesc; ?></textarea>
					<label class="label">Start Date:</label><br/>
						<input type="text" id="startdatepicker" class="textinput"  value = "<?php echo $eventStartDate; ?>" style="width: 100px;"readonly/>
					<label class="label">Start Time:</label><br/>
						<input type="time" id="startTime" class="textinput"  value = "<?php echo $startTime; ?>" style="width: 100px;"readonly/>
					<label class="label">End Date:</label><br/>
						<input type="text" id="enddatepicker" class="textinput"  value = "<?php echo $eventEndDate; ?>" style="width: 100px;"readonly/>
					
                    <label class="label">End Time:</label><br/>
						<input type="time" id="endTime" class="textinput"  value = "<?php echo $endTime; ?>" style="width: 100px;"readonly/>
                    <!--label class="label">Event Type:</label><br/-->
						<input type="hidden" id="eventType" class="textinput" value = "<?php echo $eventType; ?>" readonly/>
                    <!--label class="label">Room Id:</label><br/-->
						<input type="hidden" id="roomId" class="textinput" value = "<?php echo $roomId; ?>" readonly/>
                    <label class="label">Room Name:</label><br/>
						<input type="text" id="roomName" class="textinput" value = "<?php echo $roomName; ?>" readonly/>
                    <label class="label">Location:</label><br />
						<input type="text" id="roomLocation" class="textinput" value = "<?php echo $roomLocation; ?> Floor" readonly/>
                    <label class="label">Location Description: </label></br>
						<input type="text" id="locDesc" class="textinput" value = "<?php echo $locDesc; ?>" readonly/>
                    <label class="label">Capacity: </label>
						<input type="text" id="roomCapacity" class="textinput" value = "<?php echo $roomCapacity; ?>" readonly/>
                    <label class="label">Number of people:</label><br/>
						<input type="text" id="numOfPeople" class="textinput" min="2" value = "<?php echo $numOfPeople; ?>" />
          			<label class="label">How the event relates to library:</label><br/>
					  	<textarea id="eventDescLib" class="readonlytext" style="height: 150px; overflow: auto; width: 400px;" readonly><?php echo $eventDescLib; ?></textarea>
          			<label class="label">Special Event Requirements:</label><br/>
					  	<textarea id="eventReq" class="readonlytext" style="height: 150px; overflow: auto; width: 400px;" readonly><?php echo $eventReq; ?></textarea>
                    </br></br>

				<?php } else { ?>
					
                    <label class="label">Requester&#39;s Name:</label><br/>
						<input type="text" id="requesterName" class="textinput" value = "<?php echo $requesterName; ?>" readonly/>
                    <label class="label">Requester&#39;s Email:</label><br/>
						<input type="email" id="requesterEmail" class="textinput"  value = "<?php echo $requesterEmail; ?>" readonly/>
                    <label class="label">Event Name:</label><br/>
						<input type="text" id="eventName" class="textinput form-control" value = "<?php echo $eventName; ?>" required pattern=".*\S+.*"/>
					<label class="label">Event Description:</label><br/>
						<textarea id="eventDesc" class="textinput" style="height: 150px; overflow: auto; width: 400px;" required pattern=".*\S+.*"><?php echo $eventDesc; ?></textarea>
					<label class="label">Start Date:</label><br/>
						<input type="text" id="startdatepicker" class="textinput"  value = "<?php echo $eventStartDate; ?>" style="width: 100px;"required/>
					<label class="label">Start Time:</label><br/>
						<input type="time" id="startTime" class="textinput"  value = "<?php echo $startTime; ?>" style="width: 100px;"required/>
					<label class="label">End Date:</label><br/>
						<input type="text" id="enddatepicker" class="textinput"  value = "<?php echo $eventEndDate; ?>" style="width: 100px;"required/>
                    <label class="label">End Time:</label><br/>
						<input type="time" id="endTime" class="textinput"  value = "<?php echo $endTime; ?>" style="width: 100px;"required/>
					<!--label class="label">Event Type:</label><br/-->
						<input type="hidden" id="eventType" class="textinput" value = "<?php echo $eventType; ?>" readonly/>
                    <!--label class="label">Room Id:</label><br/-->
						<input type="hidden" id="roomId" class="textinput" value = "<?php echo $roomId; ?>" readonly/>
                    <label class="label">Room Name:</label><br/>
						<input type="text" id="roomName" class="textinput" value = "<?php echo $roomName; ?>" readonly/>
                    <label class="label">Location:</label><br />
						<input type="text" id="roomLocation" class="textinput" value = "<?php echo $roomLocation; ?> Floor" readonly/>
                    <label class="label">Location Description: </label></br>
						<input type="text" id="locDesc" class="textinput" value = "<?php echo $locDesc; ?>" readonly/>
                    <label class="label">Capacity: </label>
						<input type="text" id="roomCapacity" class="textinput" value = "<?php echo $roomCapacity; ?>" readonly/>
                    <label class="label">Number of people:</label><br/>
						<input type="number" id="numOfPeople" class="textinput" value = "<?php echo $numOfPeople; ?>" required/>
						<div class="form-group">
          			<label class="label">How the event relates to library:</label><br/>
						<textarea class="textinput" id="eventDescLib" style="height: 150px; overflow: auto; width: 400px;" ><?php echo $eventDescLib; ?></textarea>
						</div>
					<label class="label">Special Event Requirements:</label><br/>
						<textarea class="textinput" id="eventReq" style="height: 150px; overflow: auto; width: 400px;" ><?php echo $eventReq; ?></textarea>
				
                    </br></br>
					<button class="btn" type="submit" id="submit">Submit</button>

				<? } ?>
                </div></form>
					
						

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
		//$(document).ready(function(){
			$('#startdatepicker').datepicker();
            $('#enddatepicker').datepicker();
			$('#num_error').hide();
			if(<?php echo $status ?> ==1){
				//SUBMITTED STATE
				document.getElementById('step1').className='warning';
				document.getElementById('step2').className='';
				document.getElementById('step3').className='';
				document.getElementById('step4').className='';
				document.getElementById("changeRequest").style.display = "none";
			}else if(<?php echo $status ?> ==2){//RETURNED STATE
				document.getElementById('step1').className='danger';
				document.getElementById('step2').className='danger';
				document.getElementById('step3').className='danger';
				document.getElementById('step4').className='danger';
			}else if(<?php echo $status ?> ==3){//APPROVED STATE
				document.getElementById('step1').className='completed';
				document.getElementById('step2').className='completed';
				document.getElementById('step3').className='completed';
				document.getElementById('step4').className='';
				document.getElementById("changeRequest").style.display = "none";
			}
			else if(<?php echo $status ?> ==4){//COMPLETED STATE
				document.getElementById('step1').className='completed';
				document.getElementById('step2').className='completed';
				document.getElementById('step3').className='completed';
				document.getElementById('step4').className='completed';
				document.getElementById("submit").style.display = "none";
			}
			$('#formcontents').hide();
			var text_max = 250;

			$('#message').keyup(function() {
				var text_length = $('#message').val().length;
				var text_remaining = text_max - text_length;
				$('#textarea_feedback').html(text_remaining + ' characters remaining');
			});

	/* Validation */
	$("#eventDesc").on('keyup', function(e) {
		var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
		if (words <= 250) {
			$('#display_count').text(words);
			//$('#word_left').text(200-words)
		}else{
			if (e.which !== 8) e.preventDefault();
		}
	});

    $("#describe").on('keyup', function(e) {
		var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
		if (words <= 250) {
			$('#describe_display_count').text(words);
			//$('#word_left').text(200-words)
		}else{
			if (e.which !== 8) e.preventDefault();
		}
    });

    $("#specReq").on('keyup', function(e) {
		var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
		if (words <= 250) {
			$('#specReq_display_count').text(words);
			//$('#word_left').text(200-words)
		}else{
			if (e.which !== 8) e.preventDefault();
		}
    });

     $("#startdatepicker").change(function () {
        var today = new Date();
        today.setHours(0,0,0,0);
        var startDate = document.getElementById("startdatepicker").value;
        var endDate = document.getElementById("enddatepicker").value;

        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("startdatepicker").value = "";
        } else if((Date.parse(startDate) < Date.parse(today))){
            alert("Start date should be greater than today");
            document.getElementById("startDate").value = "";
        }
    });

    $("#enddatepicker").change(function () {
        var startDate = document.getElementById("startdatepicker").value;
        var endDate = document.getElementById("enddatepicker").value;
        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("enddatepicker").value = "";
        }
    });

    $('input#reqName').keydown(function (e) {
        if ((e.which == 9) && ($(this).val().length == 0)) {
            $(this).css('border', '1px solid red');
        } else {
            $(this).css('border', '1px solid #ccc');
        }
    });
    $('input#reqEmail').keydown(function (e) {
        $(this).css('border', '1px solid #ccc');
    });

    
	/* validation ends */
	
	//alert(requestsCnt);	
	$('#changeRequest').submit(function(e) {
		var r = confirm("Do you want to submit the request?");
        if(r){
			var startDate= $('input#startDate').val();
			var endDate= $('input#endDate').val();
			var startTime = document.getElementById("startTime").value;//time attribute only works with this format
			var endTime = document.getElementById("endTime").value;//time attribute only works with this format
			if ((Date.parse(startDate) > Date.parse(endDate))) {
				alert("The event should end on same or later day.");
				document.getElementById("endDate").value = "";
				e.preventDefault();
			} else if((startTime > endTime) && (Date.parse(startDate) === Date.parse(endDate))) {
				alert("The Event end time should be later than start time. Please fill the form again.");
				document.getElementById("startTime").value = "";
				document.getElementById("endTime").value = "";
				$("html, body").animate({scrollTop: 0}, 600);
				e.preventDefault();
			} else {
				var text_max = 250;
				//add validation here for the whole form
				var eventName = $('input#eventName').val();
				var eventDesc = $('textarea#eventDesc').val();
				var startDate= $('input#startdatepicker').val();
				var endDate= $('input#enddatepicker').val();
				var startTime = document.getElementById("startTime").value;//time attribute only works with this format
				var endTime = document.getElementById("endTime").value;//time attribute only works with this format
				var numOfPeople= $('input#numOfPeople').val();
				var describe= $('textarea#eventDescLib').val();
				var specReq= $('textarea#eventReq').val();
				var reqName= $('input#requesterName').val();
				var emailId= $('input#requesterEmail').val();
				var requestID=$('input#requestID').val();
				$('fieldset').css('opacity','0.1');
				$.post('<?php echo base_url().'lpoc/submitRequest'?>',{
					'eventName':eventName,
					'eventDesc':eventDesc,
					'eventStartDate':startDate,
					'eventEndDate':endDate,
					'startTime' : startTime,
					'endTime':endTime,
					'numOfPeople':numOfPeople,
					'eventDescLib':describe,
					'eventReq':specReq,
					'requesterName' :reqName,
					'requesterEmail' :emailId,
					'requestID':requestID
				}).done(function(requestID){
					if(requestID > 0){
						$('#requestStatus').show().css('background', '#66cc00').append("#" + requestID + ":Your request has been received and is awaiting approval by the Library Programming and Outreach Committee.");
						document.getElementById('step1').className = 'warning';
						document.getElementById('step2').className='';
						document.getElementById('step3').className='';
						document.getElementById('step4').className='';
						$('#submit').attr('disabled', 'disabled'); 
                        document.getElementById("submit").style.display = "none";
						$("html, body").animate({scrollTop: 0}, 600); 
					} else {
						$('#requestStatus').show().css('background', 'red').append(" Some error occured. Kindly contact system administrator.");
						$("html, body").animate({scrollTop: 0}, 600);   
					}
				});  
			}  
		} e.preventDefault();           
	}); //end of submit function
			
			
	$('div#request_input').clone();
	$('div.accordion').click(function(){
		var div =$(this).attr('id');
		if(div == '1'){
			$('div#1-contents').toggle();
		}else if (div == '2'){
			$('#changeRequest').toggle();
		}else if (div == '3'){
			$('div#3-contents').toggle();
		}else if (div == 'requests'){
			$('div#formcontents').toggle();
		}
	});
	//	}); // end of document function
	</script>
</body>
</html>