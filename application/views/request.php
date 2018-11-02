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
    <title>Application for Event or Exhibit in the James A. Cannavino Library</title>
  
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
    <link href="http://library.marist.edu/css/library.css" rel="stylesheet">
    <link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">
    <link href="styles/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    
        #overlay {
    position: fixed; /* Sit on top of the page content */
    display: none; /* Hidden by default */
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0; 
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    z-index: 10; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
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
<div id="miniMenu" style="width: 100%;border: 1px solid black; border-bottom: none">

</div>

<!-- Main jumbotron for a primary marketing message or call to action -->

           <div id='overlay'> </div>
<div id="main-container" class="container">
    <div class="jumbotron" style="background: white">
    <h2 style="text-align: center; font-size: 32px;">Application for Event or Exhibit in the James A. Cannavino Library</h2>
        <div id="userType" class="container" style=""><!--removed margin top - margin-top: -36px; for now-->
            <!-- Example row of columns -->
                <div class="col-md-12" style="background: white">
                    <div id="loader">
                        <img id="loader-img" alt="" src="http://library.marist.edu/images/pacman.gif" width="130" height="130" />
                    </div> <!-- loader -->
                    

                    <div id='staff' name='staff' class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                        <a href="" data-toggle="modal" data-target="#myModal"><span class="fas fa-user fa-5x"></span></a>
                        <p>Marist faculty/Staff</p>

                        </div>
                    </div>    
                    
                    <div id='student' name='student' class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                                                 
                            <a><span class="fas fa-user-graduate fa-5x"></span></a>
                            <p>Marist Student</p>

                        </div>   
                    </div>
                    
                    <div id='community' name='community' class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                            <!--span class="glyphicon glyphicon-user" style="font-size: 85px"></span-->
                            <a ><span class="fas fa-users fa-5x"></span></a>
                            <p>Community member</p>

                        </div>   
                    </div>
                                                
                </div><!-- col-md-12 -->            
           </div><!-- container -->

            <div id="formDiv" style="z-index: 10; position: relative; background: #ffffff;">
            <form class="form-horizontal" style="display:none">
                <fieldset style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px; margin-bottom: 20px;background:rgba(106,106,106,0.1);">
                    <button type="button" class="close" aria-label="Close">
                        <span aria-hidden="true" style="color:red;font-size:45px;">&times;</span>
                    </button>

                    <div class="form-horizontal" id="0View" style="display: none"> 
                        <h2>Sponser Information:</h2>
                            <div class="form-group">
                                <label class="col-md-4 control-label">
                                Do you have any on campus sponser?</label>
                                <div class="col-md-4">
                                    <input class="form-control" name="sponser" id="sponser"  pattern=".*\S+.*"/>
                                    <span aria-hidden="true" style="color:blue;">Type name of sponser. If you do not have a sponser, write NA.</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <button id="1" name="next" type="button" class="btn btn-dark" style="float:right" >Next</button>
                                </div>
                            </div>    
                    </div>  <!-- div 0 ends -->    

                    <div class="form-horizontal" id="1View" style="display: none"> 
                        <h2>Contact Information (Page 1 of 4):</h2>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Requester Name</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="reqName" id="reqName" required pattern=".*\S+.*"/>
                                    </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Requester Email</label>
                                    <div class="col-md-4">
                                        <input class="form-control" aria-describedby="emailHelp" name="emailId" id="emailId" type="email" data-fv-emailaddress-message="The value is not a valid email address"  required pattern=".*\S+.*"/>
                                    </div>
                            </div>
                            

                            <div class="form-group">
                                <div class="col-md-8">
                                     <button id="2" name="next" type="button" class="btn btn-dark" style="float:right" >Next</button>
                                     <button id="0" name="prev" type="button" class="btn btn-dark" style="float:right; margin-right:250px;display:none;" >Previous</button>
                                </div>
                            </div>    
                    </div>  <!-- div 1 ends -->      

                    <div class="form-horizontal" id="2View" style="display: none"> 
                        <h2>Event Information:</h2>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textinput">Event Name</label>
                            <div class="col-md-4">
                                <input id="eventName" name="eventName" type="text" placeholder="" class="form-control input-md" required pattern=".*\S+.*">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="textarea">Event Description</label>
                            <div class="col-md-4">
                                <textarea class="form-control" name="eventDesc" id="eventDesc" style="height: 150px; overflow: auto; width: 400px;" pattern=".*\S+.*"></textarea>
                                    Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <button id="3" name="next" type="button" class="btn btn-dark" style="float:right" >Next</button>
                                <button id="1" name="prev" type="button" class="btn btn-dark" style="float:right; margin-right:250px" >Previous</button>
                            </div>
                        </div> 
                    </div><!-- div 2 ends -->  

                    <div class="form-horizontal" id="3View" style="display: none"> 
                        <h2>Event Schedule:</h2>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Is the Schedule?</label>
                            <div class="col-md-4">
                                <input type="radio" id="undecided" name="scheType" value="undecided"/>Undecided
                                <input type="radio" id="negotiable" name="scheType" value="negotiable" />Negotiable
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Event Start Date</label>
                            <div class="col-md-4">
                                <input class="form-control" name="startDate" id="startDate" type="date"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="start-time">Start Time:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="time" id="startTime" name="startTime"  /> 
                                <!--onchange="startvalidateHhMm(this);" -->
                            </div><span class="validity"></span>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Event End Date</label>
                            <div class="col-md-4">
                                <input class="form-control" name="endDate" id="endDate" type="date"/>
                            </div>
                        </div>   

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="end-time">End Time:</label>
                            <div class="col-md-4">
                                <input class="form-control" type="time" id="endTime" name="endTime"/>
                                <!--onchange="endvalidateHhMm(this);" -->
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label class="col-md-4 control-label">Flexible with schedule?</label>
                            <div class="col-md-4">
                                <input class="form-control" name="negotiable" id="negotiable" type="checkbox" style="width:auto;height:auto;" />
                            </div>
                        </div> -->

                        <div class="form-group" style="text-align:center;">
                        <span aria-hidden="true" style="color:blue;">Note: text to help users understand this page.</span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <button id="4" name="next" type="button" class="btn btn-dark" style="float:right" >Next</button>
                                <button id="2" name="prev" type="button" class="btn btn-dark" style="float:right; margin-right:250px" >Previous</button>
                            </div>
                        </div> 
                    </div> <!-- div 3 ends -->

                    <div class="form-horizontal" id="4View" style="display: none"> 
                        <h2>Event Information:</h2>
                        <!-- <div class="form-group">
                            <label class="col-md-4 control-label">Type of Event</label>
                                <div class="col-md-4">
                                    <select class="form-control" id="eventsSelection">
                                        <//?php foreach ($events as $events){ ?>
                                            <option value='<//?php echo $events -> eventid ; ?>'><//?php  echo $events -> type ?></option>
                                        <//?php } ?>
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
                        </div> -->

                        <div class="form-group">
                            <label class="col-md-4 control-label">Number of people</label>
                            <div class="col-md-4">
                                <input class="form-control" type="number" name="noOfPeople" id="noOfPeople" required min="2"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Will food be served?</label>
                            <div class="col-md-4">
                                <!-- <input class="form-control" type="number" name="noOfPeople" id="noOfPeople" required min="2"/> -->
                                <input type="radio" name="yes_no" value="yes" checked />Yes
                                <input type="radio" name="yes_no" value="no" />No
                            </div>
                        </div>
                            
                    <!-- <div class="form-group">
                        <label class="col-md-4 control-label" for="textarea">Describe the event/how it relates to library</label>
                        <div class="col-md-4">
                            <textarea class="form-control" name="describe" id="describe" style="height: 150px; overflow: auto; width: 400px;" required pattern=".*\S+.*"></textarea>
                            Total word Count : <span id="describe_display_count">0</span> words(Maximum words allowed: 250).
                        </div>
                    </div> -->
                                
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="textarea">Special Meeting/Event Requirements</label>
                                <div class="col-md-4">
                                    <textarea class="form-control" name="specReq" id="specReq" style="height: 150px; overflow: auto; width: 400px;"></textarea>
                                    Total word Count : <span id="specReq_display_count">0</span> words(Maximum words allowed: 250).
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8">
                                    <!--button id="5" name="next" type="button" class="btn btn-dark" style="float:right" >Next</button-->
                                    <button type="submit" id="5" class='btn btn-dark' value='Submit' style="float:right" >Submit</button>
                                    <button id="3" name="prev" type="button" class="btn btn-dark" style="float:right; margin-right:250px" >Previous</button>
                                </div>
                            </div> 
                        </div>
                    </div><!--div 4 ends-->
                </fieldset>
            </form>
           </div>
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
    
    $('button').click(function(e){
        var id = $(this).attr('id');
        var name = $(this).attr('name');
        var flag=0;
        // document.getElementsByTagName("body").style.opacity = "0";
        if((id==1 && name=='next')){
            console.log("in id");
            var sponser = $('input#sponser').val();
            
            if(sponser == ""){
                flag = 0;
                alert("Please enter sponser name or write NA.");
            } else {
                console.log("yes");
                flag = 1;
            }
        }
        if((id==2 && name=='next')){
            console.log("in id");
            var reqName = $('input#reqName').val();
            var email = $('input#emailId').val();
            if(reqName == ""){
                flag = 0;
                alert("Please enter requester name.");
            } else if(email == ""){
                flag = 0;
                alert("Please enter Email ID.");
            } else if(!( /(.+)@(.+){2,}\.(.+){2,}/.test(email) )){
                flag = 0;
                alert("Please enter valid email adddress");
            } else if(( /(.+)@(.+){2,}\.(.+){2,}/.test(email) ) && (reqName != "")){
                console.log("yes");
                flag = 1;
            }
        }
        // if((id==3 && name=='next') || (id==1 && name=='prev'))
        if(id==3 && name=='next'){
            var eventName = $('input#eventName').val();
            //var eventDesc = $('textarea#eventDesc').val();
            if(eventName == ""){
               flag = 0;
               alert("Please provide event name.");
            // } else if(eventDesc == ""){
            //     flag=0;
            //     alert("Please provide event description.");
            } else if((eventName != "")){ //&& (eventDesc != "")){
               flag = 1;
            }          
        }
        // if((id==4  && name=='next') || (id==2 && name=='prev'))
        if(id==4  && name=='next'){
        //4 th is last view to think other logic for validation    startdate, enddate, start  time, end time validation here
            var startDate= document.getElementById("startDate").value;
            var endDate= document.getElementById("endDate").value;
            var schetype = $('input:radio[name="scheType"]:checked').val();

            // console.log(startDate);console.log(endDate);
            
            var startTime = document.getElementById("startTime").value;//time attribute only works with this format
            var endTime = document.getElementById("endTime").value;//time attribute only works with this format
            console.log(startTime);console.log(endTime);
            if(schetype == "negotiable"){
                if((startDate== "") || (endDate== "") || (startTime== "") || (endTime== "")){
                    flag=0;
                    alert("Please enter the schedule");
                } else if (startDate== "") {
                    flag=0;
                    alert("Please enter start date.");
                } else if(endDate == "") {
                    flag=0;
                alert("Please enter end date.");
                } else if (startTime== "") {
                    flag=0;
                    alert("Please enter start time.");
                } else if (endTime== "") {
                    flag=0;
                    alert("Please enter end time.");
                } else if((startTime > endTime) && (Date.parse(startDate) === Date.parse(endDate))) {
                    flag=0;
                    alert("The Event end time should be later than start time. Please fill the time again.");
                } else {
                    flag=1;
                }
            } else if(schetype == "undecided") {
                flag = 1;
            }
        }
        if(flag==1){
            if (name == 'next'){
                var curr = id - 1;
                var curr = "#" + curr + "View";
                var next = "#" + id + "View";
               // $(curr).fadeTo(1000, 0.2);
               //document.getElementById("overlay").style.display = "block";
                setTimeout(function(){
                    $(curr).css('display', 'none');
                    $(next).css('display', 'block');
                    $(next).css('opacity', '1');
                }, 500);
                     
            }
            else {
                console.log("There are empty fields on this page.");
            }
        }else {
            if (name == 'prev'){
                var prev = "#" + id + "View";
                var curr = ++id;
                var curr = "#" + curr + "View";
                // $(curr).css('display', 'none');
                // $(prev).css('display', 'block');

              //  $(curr).fadeTo(1000, 0.2);
                setTimeout(function(){
                    $(curr).css('display', 'none');
                    $(prev).css('display', 'block');
                    $(prev).css('opacity', '1');
                }, 500);
            }
        } 
    });

    $(window).load(function() { /* code here */
        /**  
        var roomId = $("select#availableRooms").attr('value');
        var resultUrll = "<//?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
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
        } */

        $('#student').click(function(){
            console.log("clicked student");
            $("#1View").scrollTop();    
            $('#overlay').css('display', 'block');        
                    
           // setTimeout(function(){
                $('.form-horizontal').show();
                $('.form-horizontal').css("display:block");
                $('#userType').css('display','none');
                $('#0View').css('display','none');
                $('#1View').css('display','block');
                $('#1View').css('opacity','1');
                $("#0").hide();
                $('#2View').css('display','none');
                $('#3View').css('display','none');
                $('#4View').css('display','none');
           // }, 500);
        });

        $('input[type=radio][name=scheType]').click(function(){
            if(this.value == "undecided"){
                $('#startDate').attr('disabled',true);
                $('#endDate').attr('disabled',true);
                $('#endTime').attr('disabled',true);
                $('#startTime').attr('disabled',true);
            } else {
                $('#startDate').attr('disabled',false);
                $('#endDate').attr('disabled',false);
                $('#endTime').attr('disabled',false);
                $('#startTime').attr('disabled',false);
            }
        });

        $('#staff').click(function(){
            console.log("clicked student");
            $("#1View").scrollTop();
            $('#overlay').css('display', 'block');        

            setTimeout(function(){
                $('.form-horizontal').show();
                $('#userType').css('display','none');
                $('#0View').css('display','none');
                $('#1View').css('display','block');
                $('#1View').css('opacity','1');
                $("#0").hide();
                $('#2View').css('display','none');
                $('#3View').css('display','none');
                $('#4View').css('display','none');
            }, 500);
        });

        $('#community').click(function(){
            console.log("clicked community");
            $("#0View").scrollTop();
            $('#overlay').css('display', 'block');        
            setTimeout(function(){
                $('.form-horizontal').show();
                $('#userType').css('display','none');
                $('#0View').css('display','block');
                $('#0View').css('opacity','1');
                $("#0").show();
                $('#1View').css('display','none');
                $('#2View').css('display','none');
                $('#3View').css('display','none');
                $('#4View').css('display','none');
            }, 500);
        });

        $('.close').click(function(){
            $('.form-horizontal').hide();
            $('#userType').css('display','block');
            $('#userType').css('opacity','1');
            $('#overlay').css('display', 'none');        
        });
    });

    /*    $("select#availableRooms").change(function () {
        var roomId = $(this).attr('value');
        var selectedRoom = roomId;
        var resultUrl = "<//?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
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

    $("select#eventsSelection").change(function () {
        var eventId = $(this).attr('value');
        var resultUrl = "<//?php echo base_url("lpoc/getRooms")?>" + "/" + eventId;
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
        var resultUrl = "<//?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
        if(roomId){
            $.ajax({
                url: resultUrl,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#roomInfo').empty();
                    $.each(data, function(key, value) {
                        $('#roomInfo').append('<div><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.Capacity + '</div>' );
                    });
                    var roomId = $("select#availableRooms").attr('value');
                    var selectedRoom = roomId;
                    var resultUrll = "<//?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
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
    }).change(); */


    $("#eventDesc").on('keyup', function(e) {
        var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
        if (words <= 250) {
            $('#display_count').text(words);
            //$('#word_left').text(200-words)
        }else{
            if (e.which !== 8) e.preventDefault();
        }
    });

    // $("#describe").on('keyup', function(e) {
    //     var words = $.trim(this.value).length ? this.value.match(/\S+/g).length : 0;
    //     if (words <= 250) {
    //         $('#describe_display_count').text(words);
    //         //$('#word_left').text(200-words)
    //     }else{
    //         if (e.which !== 8) e.preventDefault();
    //     }
    // });

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
        var today = new Date();
        today.setHours(0,0,0,0);
        var startDate = document.getElementById("startDate").value;
        var endDate = document.getElementById("endDate").value;
        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("endDate").value = "";
        } else if((Date.parse(endDate) < Date.parse(today))){
            alert("End date is in past, please make correction.");
            document.getElementById("endDate").value = "";
        }
    });

    $("form").submit(function(e) {  
        var startDate= $('input#startDate').val();
        var endDate= $('input#endDate').val();
        var startTime = document.getElementById("startTime").value;//time attribute only works with this format
        var endTime = document.getElementById("endTime").value;//time attribute only works with this format
        console.log(startTime);
        console.log(endTime);
        console.log($('input:radio[name="scheType"]:checked').val());
        console.log($('input:radio[name="yes_no"]:checked').val());
        if ((Date.parse(startDate) > Date.parse(endDate))) {
            alert("The event should end on same or later day.");
            document.getElementById("endDate").value = "";
            e.preventDefault();
        } else if((startTime > endTime) && (Date.parse(startDate) === Date.parse(endDate))) {
            alert("The Event end time should be later than start time. Please fill the time again.");
            document.getElementById("startTime").value = "";
            document.getElementById("endTime").value = "";
            e.preventDefault();
            //window.location.href = '<//?php echo base_url() ?>';
        } else {
            var r = confirm("Do you want to submit the request?");
            if(r){
                // var eventId = $('select#eventsSelection').attr('value');
                // var selectedRoom = $('select#availableRooms').attr('value');
                var eventName = $('input#eventName').val();
                var eventDesc = $('textarea#eventDesc').val();
                var startDate= $('input#startDate').val();
                var endDate= $('input#endDate').val();
                var startTime = document.getElementById("startTime").value;//time attribute only works with this format
                var endTime = document.getElementById("endTime").value;//time attribute only works with this format
                var noOfPeople= $('input#noOfPeople').val();
                // var describe= $('textarea#describe').val();
                var specReq= $('textarea#specReq').val();
                var reqName= $('input#reqName').val();
                var emailId= $('input#emailId').val();
                var scheType = $('input:radio[name="scheType"]:checked').val();
                var foodFlag = $('input:radio[name="yes_no"]:checked').val();//document.querySelector('input[name="yes_no"]:checked').value;
;//$('input#yes_no').val();
                $('fieldset').css('opacity','0.1');
                $.post('<?php echo base_url().'lpoc/insertNewRequest'?>',{
                    'eventName':eventName,
                    'eventDesc':eventDesc,
                    'startDate':startDate,
                    'endDate':endDate,
                    'startTime' : startTime,
                    'endTime':endTime,
                    //'eventId' : eventId,
                    //'selectedRoom': selectedRoom,
                    'noOfPeople':noOfPeople,
                    // 'describe':describe,
                    'specReq':specReq,
                    'reqName' :reqName,
                    'emailId' :emailId,
                    'scheType' : scheType,
                    'foodFlag' : foodFlag
                    }).done(function(requestID){
                    if(requestID > 0){
                        //alert("this is request ID: " + requestID);
                        alert('Your Request id is # '+ requestID +' and awaiting approval. You will be notified once it has been approved')
                        window.open('<?php echo base_url(); ?>',"_self");                                        
                    } else {
                        $('#requestStatus').show().css('background', 'red').append(" Some error occured. Kindly contact system administrator.");
                    }
                });       
            }
            e.preventDefault();
        }       
    });  
</script>

</body>
</html>