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
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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

    </style>
</head>

<body>
<?php
/**
 * array details
 * array(category-0,question-1,type of input-2,list of inputs-3,given user input for storing in db-4)
 * type of input 
 * 1 - print input box
 * 2 - checkboxes (multiple choices)
 * 3 - combo box (choose one out of many)
 * 4- radio
 */
    global $data;
    $data = array(
        array("category","question","type","inputs","answer"),
        array("ContactInfo","Provide the contact Information"),
        array("EventType","Please check the activity expected to be performed","2","Speaking,Reading,Performing",""),
        array("EventType","Will artificats be exhibited?","4","yes,no",""),
        array("EventType","Is the event combincation of both?","4","yes,no",""),
        array("Content","Describe the material being read/performed/spoken","1","",""),
        array("Content","Describe the artifacts being exhibited","1","",""),
        array("Content","Is thr event combining activity and exhibition?","4","yes,no",""),
        array("attendance","Type Of Attendance","3","Private Event, Public Event",""),   
        array("attendance","Number of attendees","1","",""),  
        array("dates","What is the schedule preference","3","Date Range, Fleixble dates, Specific Date",""),
        array("misc","During the event, are you planning to serve food?","4","yes,no",""),   
        array("misc","During the event, will you be needing A/V equipments?","4","yes,no",""),   
        array("other","Please mention any other details regarding the event","1","",""),   
        array("community","Do you have an on-campus sponser?","4","yes,no","")     
    )
?>
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
<div id="main-container" class="container">
    <div class="jumbotron" style="background: white">
        <div class="container" style="margin-top: -36px;">
            <!-- Example row of columns -->
                <div class="col-md-12" style="background: white">
                    <div id="loader">
                        <img id="loader-img" alt="" src="http://library.marist.edu/images/pacman.gif" width="130" height="130" />
                    </div> <!-- loader -->
                    <h2 style="text-align: center; margin: 30px; font-size: 40px;">Library Room Reservation Request</h2>

                    <div id="staff" class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                        <span class="fas fa-user fa-5x"></span>
                        <p>Staff</p>

                        </div>
                    </div>    
                    
                    <div id="student" class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                                                 
                            <span class="fas fa-user-graduate fa-5x"></span>
                            <p>Student</p>

                        </div>   
                    </div>
                    
                    <div id="community" class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                            <span class="glyphicon glyphicon-user" style="font-size: 85px"></span>
                            <!-- <a href=''><span class="fas fa-users fa-5x"></span></a> -->
                            <p>Community member</p>

                        </div>   
                    </div>
                    
                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="theform">
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button  type='button' class='btn btn-default back' style='float:left;display:none' id="back">Back</button>
                                    <button  type="button" class="btn btn-default next" id="next">Next</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" id="close">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                                    
                </div><!-- col-md-12 -->            
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
$( document ).ready(function() {
     
    var nextcount=0;
    //declaring array of questions
    var data = [
        // ["category","question","type","inputs","answer"],
        ["ContactInfo","Provide the contact Information"],
        ["EventType","Please check the activity expected to be performed","2","Speaking,Reading,Performing",""],
        ["EventType","Will artificats be exhibited?","4","yes,no",""],
        ["EventType","Is the event combincation of both?","4","yes,no",""],
        ["Content","Describe the material being read/performed/spoken","1","",""],
        ["Content","Describe the artifacts being exhibited","1","",""],
        ["Content","Is thr event combining activity and exhibition?","4","yes,no",""],
        ["attendance","Type Of Attendance","3","Private Event, Public Event",""],   
        ["attendance","Number of attendees","1","",""],  
        ["dates","What is the schedule preference","3","Date Range, Fleixble dates, Specific Date",""],
        ["misc","During the event, are you planning to serve food?","4","yes,no",""],   
        ["misc","During the event, will you be needing A/V equipments?","4","yes,no",""],   
        ["other","Please mention any other details regarding the event","1","",""],   
        ["community","Do you have an on-campus sponser?","4","yes,no",""]     
    ];
    console.log(data);
    var x = [];
    function modalforms(start, end){
        $('.theform').html("");
        // var c = count(data);
        // $('.theform').html("<form class='form-horizontal'><fieldset><div class='form-horizontal' style='border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;'>");
        content = "<div class='form-horizontal' style='border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;'><form class='form-horizontal'><fieldset>";
        for(var i=start; i < end; i++){
            var d = data[i];
            var dynamicInput;
            for(var j=0; j <d.length; j++){
                if(d[j]!== ""){
                    if(j==0){
                        var cat = d[j];
                    } else if(j==1){//question
                        var label = d[j];
                    } else if(j==2) {//type of input
                        var number = d[j];
                        if(number==1){//input box
                        dynamicInput = "input";
                        } else if(number==2){//checkboxes
                            dynamicInput = "check";
                        } else if(number==3){//combobox
                            dynamicInput = "combo";
                        }else if(number==4){//radio
                            dynamicInput = "radio";
                        } 
                    } else if(j==3) {//list of inputs
                        var options = d[j];
                        var ops = options.split(",");
                        if(label != ""){
                            content += "<div class='form-group'><label class='col-md-8 control-label'>"+label+"</label>";
                        }
                        if(dynamicInput == "input"){
                            content += "<div class='col-md-4'>";
                            content += "<input class='form-control' name="+d[j]+" id="+ d[j]+"required pattern='.*\S+.*'/></div></div>";
                        }
                        else if(dynamicInput == "check"){
                            content += "<div class='col-md-4'>";
                            for(var k=0; k<ops.length;k++){
                                content += '<input type= "checkbox"  name="'+ cat + '"value="'+ ops[k]+'"/>';
                                content += ops[k] + "<br />";
                            }
                            content += "</div></div>";
                        } else if(dynamicInput == "combo"){
                            content += "<div class='col-md-4'>";
                            content += "<select>";
                            for(var k=0; k<ops.length;k++){
                            content += '<option name="'+ cat + '"value="'+ ops[k]+'">'+ops[k]+'</option>';
                            }
                            content+= "</select></div></div>";
                        } else if(dynamicInput == "radio"){
                            content += '<div class="col-md-4"><div id="'+cat+'" class="btn-group" data-toggle="buttons">';
                            for(var k=0; k<ops.length;k++){ 
                                content += '<input type= "radio"  name="'+ cat+i + '"value="'+ ops[k]+'"/>';
                                content += ops[k] + "<br />";
                            }
                            content += "</div></div></div>";
                        }
                    }
                }
            }
        }
        content += "</fieldset></form></div>";
        // console.log(content);
        $('.theform').html(content);
        $('.back').css("display","block");
    }

    $('#student').click(function (e) {
        // alert("ok");
        
        e.preventDefault();
        jQuery.noConflict();
        $('#myModal').modal('toggle');
        $('.modal-title').html('<h3>Requester Contact Information</h3>');
        $('.theform').html("<form name='serialform' class='form-horizontal'><fieldset><div class='form-horizontal' style='border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;'><div class='form-group'><label class='col-md-4 control-label'>Requester Name</label><div class='col-md-4'><input class='form-control' name='reqName' id='reqName' required pattern='.*\S+.*'/></div></div><div class='form-group'><label class='col-md-4 control-label'>Requester Email</label><div class='col-md-4'><input class='form-control' aria-describedby='emailHelp' name='emailId' id='emailId' type='email' data-fv-emailaddress-message='The value is not a valid email address' required pattern='.*\S+.*'/></div></div></div></fieldset></form>");   
        $('.back').css("display","none"); 
    });
    //next button event handling
    $(".next").click(function (e){
        if(x==""){
            x = $('form').serializeArray();
        } else {
            x.push($('form').serializeArray());
            // x.push($(':select').serializeArray());
        }
        
        console.log(x);
        // $.each(x, function(i, field){
        //     alert(field.name + ":" + field.value + " ");
        // });
        if(nextcount < 2){
            nextcount++;
        }
        // alert(nextcount);
        $('.modal-header').html("<h3>Please Fill In Request Information</h3>");
        if(nextcount == 1){
            modalforms(1, 7);
        } 
        if(nextcount == 2){
            modalforms(7, data.length);
        }
        
    });

    //back button event handling
    $('.back').click(function (e){
        --nextcount;
        if(nextcount == 1){
            modalforms(1, 7);
        } 
        if(nextcount == 0){
            $('.modal-title').html('<h3>Requester Contact Information</h3>');
            $('.theform').html("<form class='form-horizontal'><fieldset>");
            $('.theform').append("<div class='form-horizontal' style='border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;'><div class='form-group'><label class='col-md-4 control-label'>Requester Name</label><div class='col-md-4'><input class='form-control' name='reqName' id='reqName' required pattern='.*\S+.*'/></div></div><div class='form-group'><label class='col-md-4 control-label'>Requester Email</label><div class='col-md-4'><input class='form-control' aia-describedby='emailHelp' name='emailId' id='emailId' type='email' data-fv-emailaddress-message='The value is not a valid email address'  required pattern='.*\S+.*'/></div></div></div></fieldset></form>");   
            $('.back').css("display","none");
        }
    });

    $('.close').click(function(e){
        nextcount=0;
        $('.back').css("display","none");
    });
});
</script>
</body>
</html>