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

                    <div class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                        <a href="" data-toggle="modal" data-target="#myModal"><span class="fas fa-user fa-5x"></span></a>
                        <p>Staff</p>

                        </div>
                    </div>    
                    
                    <div class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                                                 
                            <a href=''><span class="fas fa-user-graduate fa-5x"></span></a>
                            <p>Student</p>

                        </div>   
                    </div>
                    
                    <div class="col-md-4" style="height: 300px; margin-top: 20px">
                        <div style="width: 95%; border: 1px solid #ddd; text-align:center;  padding: 70px 0">
                            
                            <!--span class="glyphicon glyphicon-user" style="font-size: 85px"></span-->
                            <a href=''><span class="fas fa-users fa-5x"></span></a>
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
                                    <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                    <p>Some text in the modal.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
</body>
</html>