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

                    <form class="form-horizontal" >
                        <fieldset>
                            <!--div class="form-horizontal" id="fieldset"-->
                            <h2 style="text-align: center; margin: 30px; font-size: 40px;">Library Room Reservation Request</h2>
                            
                            <h3>Event Information:</h3>
                            <div class="form-horizontal" style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px; margin-bottom: 20px;"> 
                                <div id='author' name="author" class="form-group">
                                    <label class="col-md-4 control-label" for="textinput">Event Name</label>
                                    <div class="col-md-4">
                                        <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Event Description</label>
                                    <div class="col-md-4">
                                        <textarea name="eventDesc" id="eventDesc" style="height: 150px; overflow: auto; width: 400px;" required=""></textarea>
                                            Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Event Start Date</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="startDate" id="startDate" type="date" required=""/>
                                    </div>
                                </div>

                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Event End Date</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="endDate" id="endDate" type="date" required=""/>
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
                                    <input class="form-control" name="noOfPeople" id="noOfPeople" required=""/>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Describe the event/how it relates to library</label>
                                    <div class="col-md-4">
                                        <textarea name="desc" id="desc" style="height: 150px; overflow: auto; width: 400px;" required=""></textarea>
                                        Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Special Meeting/Event Requirements</label>
                                    <div class="col-md-4">
                                        <textarea name="specReq" id="specReq" style="height: 150px; overflow: auto; width: 400px;" required=""></textarea>
                                        Total word Count : <span id="display_count">0</span> words(Maximum words allowed: 250).
                                    </div>
                                </div>

                            </div>

                            
                            <h3>Requester Contact Information:</h3>
                            <div class="form-horizontal" style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px;"> 
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Requester Name</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="name" id="name" required=""/>
                                        
                                    </div>
                                </div>
                                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Requester Email</label>
                                    <div class="col-md-4">
                                        <input class="form-control" name="email" id="email" type="email" data-fv-emailaddress-message="The value is not a valid email address"  required=""/>
                                    </div>
                                </div>    

                                <div class="form-group">  
                                    <label class="col-md-4 control-label"></label>                  
                                    <div class="col-md-8">
                                       <h5>I will be held responsible for all requested information as specified above.</h5>
                                       <label class="checkbox-inline"><input type="checkbox" value="">I Agree</label>              
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
   
    $("form").submit(function( e ) {

        var fileTypes = ['pdf'];
       /// if ($('input#fileToUpload')[0].files[0] || $('input#link').val()) {
          if($('input#fileToUpload')[0].files[0]){
            var extension = $('input#fileToUpload')[0].files[0].name.split('.').pop().toLowerCase();  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;
              var name = $('input#name').val();
            if(author_form_index  > 0){
                for(var i = 1; i <= author_form_index; i++) {
                    var str1 = "input#name";
                    var str2 = str1.concat(i);
                    name = name + ", " + $(str2).val();
                }

            }
            if (isSuccess) {
                if (tagList.length > 0) {
                    var taglist = JSON.stringify(tagList);
                    if ($('input#name').val() && $('input#title').val() && $('input#cwid').val() && $('input#email').val()) {
                        var name = $('input#name').val();
                        var cwid = $('input#cwid').val();

                        if(author_form_index  > 0){
                            var str1 = "input#name";
                            var str3 = "input#cwid";

                            for(var i = 1; i <= author_form_index; i++) {
                                var str2 = str1.concat(i);
                                name = name + ", " + $(str2).val();
                                var str2 = str3.concat(i);
                                cwid = cwid+", "+ $(str2).val();
                            }
                        }
                        if ($('input#fileToUpload')[0].files[0]) {
                            var filesize = $('input#fileToUpload')[0].files[0].size / 1024 / 1024;
                            if (filesize <= 8.0) {
                                var form_data = new FormData();
                                form_data.append('name', name);
                                form_data.append('title', $('input#title').val());
                                form_data.append('cwid', cwid);
                                form_data.append('email', $('input#email').val());
                                form_data.append('abstract', $('textarea#word_count').val().replace(/'/g , "&#39"));
                                form_data.append('tags', taglist);
                                form_data.append('licenseId', $('#licenseSelection').val());
                                form_data.append('deptId', $('#departmentSelection').val());
                                form_data.append('collectionId', $('#collectionSelection').val());
                                form_data.append('year', $('input#year').val());
                                form_data.append('link', $('input#linkToUpload').val());

                                // if ($('input#fileToUpload')[0].files[0]) {

                                    form_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                //}
                                var file_data = new FormData();
                                if ($('input#fileToUpload')[0].files[0]) {
                                    file_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                }
                                 $('#loader').css('visibility','visible');
                                 $('fieldset').css('opacity','0.1');
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo base_url("?c=repository&m=insertDetails");?>",
                                    data: form_data,
                                    processData: false,
                                    contentType: false,
                                    // cache: false,
                                    success: function (data) {

                                        if (data > 0) {

                                             file_data.append('pageid', data);
                                             $.ajax({
                                             type: "POST",
                                             url: "http://148.100.181.189/uploadtorepo/accept-file.php",
                                             data: file_data,
                                             contentType:false,
                                             processData: false,
                                             //cache: false,
                                             success: function (message) {

                                             if(message) {
                                             var email_data = new FormData();
                                             email_data.append('name', $('input#name').val());
                                             email_data.append('email', $('input#email').val());
                                             email_data.append('paperid', data);
                                             email_data.append('file_attach', $('input#fileToUpload')[0].files[0]);
                                             $.ajax({
                                             type: "POST",
                                             url: "<?php echo base_url("?c=repository&m=email_user");?>",
                                             data: email_data,
                                             contentType:false,
                                             processData: false,
                                             //    cache: false,
                                             success: function (paperid) {
                                             if(paperid) {
                                             setTimeout(function(){
                                             $('#loader').css('visibility','hidden');
                                             $('fieldset').css('opacity','1');
                                             alert("PaperId #" + data + ": Paper has been uploaded successfully");
                                             location.reload();
                                             }, 6000);
                                             e.preventDefault();
                                             }else{

                                             alert("Failure: 001 Something went wrong while uploading paper. Please contact administrator");
                                             }

                                             },
                                             async: false

                                             });

                                             }else{

                                             alert("Failure: 002  Something went wrong while uploading paper. Please contact administrator");
                                             }

                                             },

                                             async: false

                                             });


                                             $('#requestStatus').show().css('background', '#66cc00').append("#" + data + ": File has been uploaded successfully");


                                        } else {
                                            alert("Failure: Something went wrong. Please contact administrator");
                                            //   location.reload();
                                            e.preventDefault();
                                            // $('#requestStatus').show().css('background', '#b31b1b').append("Something went wrong.Please contact adminstrator");
                                        }
                                    }
                                });
                                return false;
                            } else {
                                e.preventDefault();
                                alert("Uploaded file size should be less than or equal to 8MB.");
                            }
                        } else {
                            e.preventDefault();
                            alert("Please select the paper to upload into repository.");
                        }
                    } else {
                        e.preventDefault();
                        alert("Please fill the requied fields.");
                    }
                } else {
                    e.preventDefault();
                    alert("Please add atleast one subject heading.");
                }
            } else {
                e.preventDefault();
                alert("The file should be in the PDF format.");
            }
         }else if($('input#linkToUpload').val()){
              if (tagList.length > 0) {
                  var taglist = JSON.stringify(tagList);
                  if ($('input#name').val() && $('input#title').val() && $('input#cwid').val() && $('input#email').val()) {
                      var name = $('input#name').val();
                      var cwid = $('input#cwid').val();

                      if(author_form_index  > 0){
                          var str1 = "input#name";
                          var str3 = "input#cwid";

                          for(var i = 1; i <= author_form_index; i++) {
                              var str2 = str1.concat(i);
                              name = name + "," + $(str2).val();
                              var str2 = str3.concat(i);
                              cwid = cwid+","+ $(str2).val();
                          }
                      }
                      var form_data = new FormData();
                      form_data.append('name', name);
                      form_data.append('title', $('input#title').val());
                      form_data.append('cwid', cwid);
                      form_data.append('email', $('input#email').val());
                      form_data.append('abstract', $('textarea#word_count').val().replace(/'/g , "&#39"));
                      form_data.append('tags', taglist);
                      form_data.append('licenseId', $('#licenseSelection').val());
                      form_data.append('deptId', $('#departmentSelection').val());
                      form_data.append('collectionId', $('#collectionSelection').val());
                      form_data.append('link', $('input#linkToUpload').val());
                      form_data.append('year', $('input#year').val());
                      $('#loader').css('visibility','visible');
                      $('fieldset').css('opacity','0.1');
                      $.ajax({
                          type: "POST",
                          url: "<?php echo base_url("?c=repository&m=insertDetails");?>",
                          data: form_data,
                          processData: false,
                          contentType: false,
                          // cache: false,
                          success: function (data) {

                              if (data > 0) {
                                  var email_data = new FormData();
                                  email_data.append('name', $('input#name').val());
                                  email_data.append('email', $('input#email').val());
                                  email_data.append('paperid', data);
                                  email_data.append('link', $('input#linkToUpload').val());
                                  $.ajax({
                                      type: "POST",
                                      url: "<?php echo base_url("?c=repository&m=email_user");?>",
                                      data: email_data,
                                      contentType:false,
                                      processData: false,
                                      //    cache: false,
                                      success: function (paperid) {
                                          if(paperid) {
                                              setTimeout(function(){
                                                  $('#loader').css('visibility','hidden');
                                                  $('fieldset').css('opacity','1');
                                                  alert("PaperId #" + data + ": Paper has been uploaded successfully");
                                                  location.reload();
                                              }, 6000);
                                              e.preventDefault();
                                          }else{

                                              alert("Failure: 001 Something went wrong while uploading paper. Please contact administrator");
                                          }

                                      },
                                      async: false

                                  });
                              }


                          },
                          async: false
                      });
                  }else{
                      e.preventDefault();
                      alert("Please fill the requied fields.");
                  }

              }else{
                  e.preventDefault();
                  alert("Please add atleast one subject heading.");

              }

          } else{
            e.preventDefault();
            alert("Failed: Please select a paper to upload (or) add a link to your work.");
        }

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
    }).change();

     $("select#availableRooms").change(function () {
        var roomId = $(this).attr('value');
        var resultUrl = "<?php echo base_url("lpoc/getRoomInfo")?>" + "/" + roomId;
        if(roomId){
            $.ajax({
                    url: resultUrl,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#roomInfo').empty();
                        $.each(data, function(key, value) {
                            $('#roomInfo').append('<p><label>Location:</label> ' + value.Location + ' Floor </br> <label>Location Description: </label>' + value.LocDesc + '</br> <label>Capacity: </label>' + value.capacity + '</p></br>' );
                        });
                    }
                });
            }else{
                $('select[name="availableRooms"]').empty();
            }
    }).change();
 </script>
</body>
</html>
