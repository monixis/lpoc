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
                                        <textarea name="eventDesc" id="eventDesc" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
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
                                    <label class="col-md-4 control-label">Event End Date</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="endDate" id="endDate" type="date" required/>
                                    </div>
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
                                        <textarea name="describe" id="describe" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
                                        Total word Count : <span id="describe_display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Special Meeting/Event Requirements</label>
                                    <div class="col-md-4">
                                        <textarea name="specReq" id="specReq" style="height: 150px; overflow: auto; width: 400px;" required></textarea>
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
                                       <label class="checkbox-inline"><input name="agree" type="checkbox" value="">I Agree</label>              
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
    });
    $('input#reqEmail').keydown(function (e) {
        $(this).css('border', '1px solid #ccc');
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

    /*$("input#check").click(function(e){
        var eventId = $('select#eventsSelection').attr('value');
        var selectedRoom = $('select#availableRooms').attr('value');
        var eventName = $('input#eventName').val();
        var eventDesc = $('textarea#eventDesc').val();
        var startDate= $('input#startDate').val();
        var endDate= $('input#endDate').val();
        var noOfPeople= $('input#noOfPeople').val();
        var describe= $('textarea#describe').val();
        var specReq= $('textarea#specReq').val();
        var reqName= $('input#reqName').val();
        var email= $('input#emailId').val();
        console.log($('select#eventsSelection').attr('value'));
        console.log($('select#availableRooms').attr('value'));
        console.log($('input#eventName').val());
        console.log($('textarea#eventDesc').val());
        console.log($('input#startDate').val());
        console.log($('input#endDate').val());
        console.log($('input#noOfPeople').val());
        console.log($('textarea#describe').val());
        console.log($('textarea#specReq').val());
        console.log($('input#reqName').val());
        console.log($('input#emailId').val());
        $.ajax({
            type:'POST',
            url:'<//?php echo base_url().'lpoc/showdata';?>',
            data:{
                'eventName':eventName,
                'eventDesc':eventDesc,
                'startDate':startDate,
                'endDate':endDate,
                'eventId' : eventId,
                'selectedRoom': selectedRoom,
                'noOfPeople':noOfPeople,
                'describe':describe,
                'specReq':specReq,
                'reqName' :reqName,
                'emailId' :emailId
                }
        });

    });*/


    $("input#submit_prog").click(function( e ) {
        var eventId = $('select#eventsSelection').attr('value');
        var selectedRoom = $('select#availableRooms').attr('value');
        //alert(eventId);
        //var form_data = new FormData();
        var eventName = $('input#eventName').val();
        //alert(eventName);
        var eventDesc = $('textarea#eventDesc').val();
        var startDate= $('input#startDate').val();
        var endDate= $('input#endDate').val();
        var noOfPeople= $('input#noOfPeople').val();
        var describe= $('textarea#describe').val();
        var specReq= $('textarea#specReq').val();
        var reqName= $('input#reqName').val();
        var emailId= $('input#emailId').val();

        if(eventId == ""){
            $('select#eventsSelection').css('border', '1px solid red');
        } else if(selectedRoom == ""){
            $('select#availableRooms').css('border', '1px solid red');
        } else if(eventName == ""){
            $('input#eventName').css('border', '1px solid red');
        } else if(eventDesc == ""){
            $('textarea#eventDesc').css('border', '1px solid red');
        } else if(startDate == ""){
            $('input#startDate').css('border', '1px solid red');
        } else if(endDate == ""){
            $('input#endDate').css('border', '1px solid red');
        } else if(noOfPeople == ""){
            $('input#noOfPeople').css('border', '1px solid red');
        } else if(describe == ""){
            $('textarea#describe').css('border', '1px solid red');
        } else if(specReq == ""){
            $('textarea#specReq').css('border', '1px solid red');
        } else if(reqName == ""){
            $('input#reqName').css('border', '1px solid red');
        } else if(emailId == ""){
            $('input#emailId').css('border', '1px solid red');
        } else {
            $('select#eventsSelection').css('border', '1px solid #ccc');
            $('select#availableRooms').css('border', '1px solid #ccc');
            $('input#eventName').css('border', '1px solid #ccc');
            $('textarea#eventDesc').css('border', '1px solid #ccc');
            $('input#startDate').css('border', '1px solid #ccc');
            $('input#endDate').css('border', '1px solid #ccc');
            $('input#noOfPeople').css('border', '1px solid #ccc');
            $('textarea#describe').css('border', '1px solid #ccc');
            $('textarea#specReq').css('border', '1px solid #ccc');
            $('input#reqName').css('border', '1px solid #ccc');
            $('input#emailId').css('border', '1px solid #ccc');
            var atpos = emailId.indexOf("@");
            var dotpos = emailId.lastIndexOf(".");
            if (atpos<1 || dotpos<atpos+2 || dotpos+2>=emailId.length) {
                alert("Not a valid e-mail address");
                return false;
            }
       
        
        /*form_data.append('eventName', $('input#eventName').val());
        form_data.append('eventDesc', $('textarea#eventDesc').val());
        form_data.append('startDate', $('input#startDate').val());
        form_data.append('endDate', $('input#endDate').val());
        form_data.append('eventId', eventId);
        form_data.append('selectedRoom', selectedRoom);
        form_data.append('noOfPeople', $('input#noOfPeople').val());
        form_data.append('describe', $('textarea#describe').val());
        form_data.append('specReq', $('textarea#specReq').val());
        form_data.append('reqName', $('input#reqName').val());
        form_data.append('emailId', $('input#email').val());*/
        
        $('#loader').css('visibility','visible');
        $('fieldset').css('opacity','0.1');
        $.post('<?php echo base_url().'lpoc/insertNewRequest'?>',{
                'eventName':eventName,
                'eventDesc':eventDesc,
                'startDate':startDate,
                'endDate':endDate,
                'eventId' : eventId,
                'selectedRoom': selectedRoom,
                'noOfPeople':noOfPeople,
                'describe':describe,
                'specReq':specReq,
                'reqName' :reqName,
                'emailId' :emailId
                }).done(function(requestID){
                    alert("this is request ID:" + requestID);
                    if(requestID>0){
                        $('#requestStatus').show().css('background', '#66cc00').append(" A User Agreement Form has been sent to " + reqName);
                        } else {
                            $('#requestStatus').show().css('background', 'red').append(" Some error occured. Kindly contact system administrator.");
                        }
                });                
        }
        $("html, body").animate({scrollTop: 0}, 600);
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
