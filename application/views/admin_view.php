<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Library Room Reservation Request Forms</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <link rel="apple-touch-icon" href="http://library.marist.edu/images/jac-m.png"/>
    <link rel="shortcut icon" href="http://library.marist.edu/images/jac.png" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library.css" />
    <link rel="stylesheet" type="text/css" href="http://library.marist.edu/css/library_child.css" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="./styles/useagreement.css" />
    <script type="text/javascript" src="http://library.marist.edu/js/libraryMenu.js"></script>
    <link href="http://library.marist.edu/css/menuStyle.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="./styles/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
</head>

<body>
<div id="headerContainer">
    <div id="header">
    	<div id="logo">

        </div><!-- /logo -->
    </div>
    <!-- /header -->
</div>
<div id="menu">
    <div id="menuItems">
    </div><!-- /menuItems -->
</div>
</br></br>
<!-- /menu -->
<div id="passcode" style="margin-top:0px; margin-left: auto; margin-right: auto; width: 300px; height: 0px;">
    <strong>PASSCODE: </strong>
    <input type="password" name='passcode' id='passcode' style="height:23px; margin-left: 10px;"></input><br/>
    <input type="button" class="btn" id="submit" value="Submit" style="margin-left:95px; margin-top:10px; width:100px;"></input>
</div></br>
<div id="container" class="container">

</div></br>

<div class="bottom_container">
    <p class = "foot">
        James A. Cannavino Library, 3399 North Road, Poughkeepsie, NY 12601; 845.575.3199
        <br />
        &#169; Copyright 2007-2016 Marist College. All Rights Reserved.
	<a href="http://www.marist.edu/disclaimers.html" target="_blank" >Disclaimers</a> | <a href="http://www.marist.edu/privacy.html" target="_blank" >Privacy Policy</a> | <a href=<?php echo base_url("?c=lpoc&m=ack");?> target="_blank">Acknowledgements</a>
    </p>
</div>

<script>
    $(document).ready(function(){
        $("#passcode").css('visibility','visible');
  //      $("#container").css('visibility', 'hidden');


    });
    $("input#submit").click(function() {

        var pcode = $("input#passcode").val();
            $.post("<?php echo base_url("?c=lpoc&m=admin_verify&pass=");?>"+pcode, {

            }).done(function (authorized) {
                if (authorized == 1) {
                    $("#passcode").css('visibility', 'hidden');
                    var url = "<?php echo base_url("?c=lpoc&m=getRequests&pass=") ?>"+pcode;
                    $("#container").load(url);
                    //   $("#container").css('visibility', 'visible');

                } else {
                    $("input#passcode").css('border', '3px solid red');
                    setTimeout(function () {
                        $("input#passcode").css('border', '1px solid grey');
                    }, 2000)
                }
            });
    });
    $('#passcode').keypress(function(e){
        var key = e.which;
        if(key == 13){
            var pcode = $("input#passcode").val();
            $.post("<?php echo base_url("?c=lpoc&m=admin_verify&pass=");?>"+pcode, {

            }).done(function (authorized) {
                if (authorized == 1) {
                    $("#passcode").css('visibility', 'hidden');
                    var url = "<?php echo base_url("?c=lpoc&m=getRequests&pass=") ?>"+pcode;
                    $("#container").load(url);
                    //   $("#container").css('visibility', 'visible');

                } else {
                    $("input#passcode").css('border', '3px solid red');
                    setTimeout(function () {
                        $("input#passcode").css('border', '1px solid grey');
                    }, 2000)
                }
            });
        }
    });

        $("body").on("click", ".pagination a", function() {
        var url = $(this).attr('href');
        $("#the-content").load(url);
        return false;
    });


</script>

</body>
</html>