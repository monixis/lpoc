<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Library Room Reservation Request</title>
<!--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
-->
 <!--   <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous"></script>-->
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="http://library.marist.edu/css/bootstrap.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://library.marist.edu/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="http://library.marist.edu/css/library.css" rel="stylesheet">
    <link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
    <script type="text/javascript" src="http://library.marist.edu/js/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <style>
        #loader-img{
            margin: 0 auto;
            display: block;
            margin-top: 35%;
        }

        #loader{
            width: auto;
            height: auto;
            position: absolute;
            z-index: 100;
            visibility:hidden;
            left:50%;
            top:60%;
        }

        input:invalid+span:after {
            position: absolute;
            content: '✖';
            padding-left: 5px;
        }

        input:valid+span:after {
            position: absolute;
            content: '✓';
            padding-left: 5px;
        }

    </style>
</head>

<body>
<div id="headerContainer">
    <a href="http://library.marist.edu/" target="_self"> <div id="header"></div> </a>
</div>
<a class="menu-link" href="#menu"><img src="http://library.marist.edu/images/r-menu.png" style="width: 20px; margin-top: 4px;" /></a>
<div id="menu">
    <div id="menuItems">
    </div>
</div>
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none;">

</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div id="main-container" class="container">
    <div class="jumbotron">
        <div class="container" style="margin-top: -36px;">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-12">
                    <div id="loader">
                        <img id="loader-img" alt="" src="http://library.marist.edu/images/pacman.gif" width="130" height="130" />
                    </div> <!-- loader -->
                    <h2 style="text-align: center; margin: 30px; font-size: 40px;">Library Room Reservation Request</h2>
                    <div id="requestStatus" style="width: auto; height:40px; margin-bottom: 7px; margin-top: -15px; color:#000000; font-size: 12pt; text-align: center; padding-top: 10px; display: none;"></div>
                    <form class="form-horizontal" >
                        <fieldset>
                            <!--div class="form-horizontal" id="fieldset"-->
                            <h3>Event Information:</h3>
                            <div class="form-horizontal" style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px; margin-bottom: 20px;"> 
                                <div id='author' name="author" class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">Event Name</label>
                                    <div class="col-md-4">
                                        <input id="eventName" name="eventName" type="text" placeholder="" class="form-control input-md" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Event Description</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="eventDesc" id="eventDesc" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
                                            Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Event Start Date</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="startDate" id="startDate" type="date" required/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="start-time">Start Time:</label>
                                    <div class="col-md-4">
                                        <input class="form-control" type="time" id="startTime" name="startTime" min="09:00" max="18:00" onchange="validateHhMm(this);" required />
                                    </div><span class="validity"></span>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Event End Date</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="endDate" id="endDate" type="date" required/>
                                    </div>
                                </div>   
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="end-time">End Time:</label>
                                    <div class="col-md-4">
                                        <input class="form-control" type="time" id="endTime" onchange="validateHhMm(this);" name="endTime"
                                        min="09:00" max="18:00" required />
                                    </div>
                                    <span class="validity"></span>
                                    <span class="col-md-4 hours">Library hours: 9AM to 6PM</span>
                                </div>

                                <div class="form-group">
                                <label class="col-md-4 control-label">Type of Event</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="eventsSelection">
                                            <?php foreach ($events as $events){ ?>
                                                <option value='<?php echo $events -> eventid ; ?>'><?php  echo $events -> type ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Available Rooms</label>
                                    <div class="col-md-4">
                                        <select class="form-control" id="availableRooms">
                                          
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea"></label>
                                    <div class="col-md-4" id="roomInfo">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="col-md-4 control-label"># of people</label>
                                    <div class="col-md-4">
                                    <input class="form-control" type="number" name="noOfPeople" id="noOfPeople" required/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Describe the event/how it relates to library</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="describe" id="describe" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
                                        Total word Count : <span id="describe_display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Special Meeting/Event Requirements</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" name="specReq" id="specReq" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
                                        Total word Count : <span id="specReq_display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>
                            </div>

                            <h3>Requester Contact Information:</h3>
                            <div class="form-horizontal" style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;"> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Requester Name</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="reqName" id="reqName" required/>
                                        
                                    </div>
                                </div>
                                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Requester Email</label>
                                    <div class="col-md-4">
                                        <input class="form-control" aria-describedby="emailHelp" name="emailId" id="emailId" type="email" data-fv-emailaddress-message="The value is not a valid email address"  required/>
                                    </div>
                                </div>    

                                <div class="form-group">  
                                    <label class="col-md-4 control-label"></label>                  
                                    <div class="col-md-8">
                                       <h5>I will be held responsible for all requested information as specified above.</h5>
                                       <label class="checkbox-inline"><input name="agree" type="checkbox" value="">I Agree</label><br/><br/>              
                                       <input type="submit" id="submit_prog" value='Submit' />
                                       <!--input type="button" id="check" value='check' /-->
                                    </div>
                                </div>
                                             
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div><!-- row -->
        </div><!-- container -->
    </div> <!-- jumbotron -->

    <br>

</div> <!-- main-container -->
<div  class="bottom_container">
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3106
        <br />
        &#169; Copyright 2007-2018 Marist College. All Rights Reserved.

        <a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href="http://library.marist.edu/repository/?c=repository&m=ack">Acknowledgements</a>
    </p>

</div>
<script type="text/javascript">
    function validateHhMm(inputField) {
        var isValid = /^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(inputField.value);

        if (isValid) {
            inputField.style.backgroundColor = '#bfa';
        } else {
            inputField.style.backgroundColor = '#fba';
        }

        return isValid;
    }
   
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
    
    $("#startDate").change(function () {
        var today = new Date();
        today.setHours(0,0,0,0);
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;

        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("startDate").value = "";
        } else if((Date.parse(startDate) < Date.parse(today))){
            alert("Start date should be greater than today");
            document.getElementById("startDate").value = "";
        }
    });

    $("#endDate").change(function () {
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;
        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("endDate").value = "";
        }
    });

    $('input#reqName').keydown(function (e) {
        if ((e.which == 9) && ($(this).val().length == 0)) {
            $(this).css('border', '1px solid red');
        } else {
            $(this).css('border', '1px solid #ccc');
        }
        if ((Date.parse(startDate) <= Date.parse(endDate))) {
            if(startTime >= endTime){
                alert("The end time is invalid.");
                document.getElementById("endTime").value = "";
              
            }
        }
    });

    $('input#reqEmail').keydown(function (e) {
        $(this).css('border', '1px solid #ccc');
    });

    

   $("form").submit(function(e) {  

        var eventId = $('select#eventsSelection').attr('value');
        var selectedRoom = $('select#availableRooms').attr('value');
        var eventName = $('input#eventName').val();
        var eventDesc = $('textarea#eventDesc').val();
        var startDate= $('input#startDate').val();
        var endDate= $('input#endDate').val();
        var startTime = document.getElementById("startTime").value;//time attribute only works with this format
        var endTime = document.getElementById("endTime").value;//time attribute only works with this format
        var noOfPeople= $('input#noOfPeople').val();
        var describe= $('textarea#describe').val();
        var specReq= $('textarea#specReq').val();
        var reqName= $('input#reqName').val();
        var emailId= $('input#emailId').val();
        $('fieldset').css('opacity','0.1');

        

	/* $.post('<//?php echo base_url().'lpoc/email_user'?>',{
				'emailId':emailId
			}).done(function(data){
                           alert(data);
			   window.open('<//?php echo base_url(); ?>',"_self");
                        });      */

       $.post('<?php echo base_url().'lpoc/insertNewRequest'?>',{
                'eventName':eventName,
                'eventDesc':eventDesc,
                'startDate':startDate,
                'endDate':endDate,
                'startTime' : startTime,
                'endTime':endTime,
                'eventId' : eventId,
                'selectedRoom': selectedRoom,
                'noOfPeople':noOfPeople,
                'describe':describe,
                'specReq':specReq,
                'reqName' :reqName,
                'emailId' :emailId
                }).done(function(requestID){
                    if(requestID > 0){
                      	//alert("this is request ID: " + requestID);
                        alert('Your Request id is # '+ requestID +' and awaiting approval. You will be notified once it has been approved')
			            window.open('<?php echo base_url(); ?>',"_self");                                               
                    } else {
                        $('#requestStatus').show().css('background', 'red').append(" Some error occured. Kindly contact system administrator.");
                    }
                });               
        });  
   
    $("select#eventsSelection").change(function () {
        var eventId = $(this).attr('value');
        var resultUrl = "<?php echo base_url("lpoc/getRooms")?>" + "/" + eventId;
        if(eventId){
            $.ajax({
                    url: resultUrl,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('select[id="availableRooms"]').empty();
                        $.each(data, function(key, value) {
                            $('select[id="availableRooms"]').append('<option value="'+ value.roomId +'">'+ value.Name +'</option>');
                        });
                    }
                });
            }else{
                $('select[id="availableRooms"]').empty();
            }
        var roomId = $("select#availableRooms").attr('value');
        var resultUrl = "<?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
        if(roomId){
            $.ajax({
                    url: resultUrl,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#roomInfo').empty();
                        $.each(data, function(key, value) {
                            $('#roomInfo').append('<p><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.Capacity + '</p></br>' );
                        });
                        var roomId = $("select#availableRooms").attr('value');
                        var selectedRoom = roomId;
                        var resultUrll = "<?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
                        if(roomId){
                            $.ajax({
                                    url: resultUrll,
                                    type: "GET",
                                    dataType: "json",
                                    success:function(data) {
                                        $('#roomInfo').empty();
                                        $.each(data, function(key, value) {
                                            $('#roomInfo').append('<p><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.Capacity + '</p></br>' );
                                        });
                                    }
                                });
                            }else{
                                $('select[name="availableRooms"]').empty();
                            }    
                    }
                });
            }else{
                $('select[name="availableRooms"]').empty();
            }
    }).change();

     $("select#availableRooms").change(function () {
        var roomId = $(this).attr('value');
        var selectedRoom = roomId;
        var resultUrl = "<?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
        if(roomId){
            $.ajax({
                    url: resultUrl,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#roomInfo').empty();
                        $.each(data, function(key, value) {
                            $('#roomInfo').append('<p><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.Capacity + '</p></br>' );
                        });
                    }
                });
            }else{
                $('select[name="availableRooms"]').empty();
            }
    }).change();

    $(window).load(function() { /* code here */
        var roomId = $("select#availableRooms").attr('value');
        var resultUrll = "<?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
        if(roomId){
            $.ajax({
                    url: resultUrll,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#roomInfo').empty();
                        $.each(data, function(key, value) {
                            $('#roomInfo').append('<p><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.Capacity + '</p></br>' );
                        });
                    }
                });
            }else{
                $('select[name="availableRooms"]').empty();
            }
        });

    $(document).ready(function(){
        var $submit = $("#submit_prog").hide(),
        $cbs = $('input[name="agree"]').click(function() {
            $submit.toggle( $cbs.is(":checked") );
        });
    });
       
 </script>
</body>
</html>