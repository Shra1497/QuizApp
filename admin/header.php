<?php
   session_start();
?>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>Admin</title>
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
      <link href="./css/w3.css" rel="stylesheet">
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css"/>
	   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css"/>
	   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
	  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	  <script src="plugins/jquery.dataTables.min.js" type="text/javascript"></script>
	  <link href="css/datatable.css" rel="stylesheet" type="text/css"/>
	  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
	  
   <style>
		.mainDiv{
			margin-top:10%;
			text-align:center;
		}
		#gif {
			 position: absolute;
			 top: 50%;
			 left: 50%;
			 margin: -50px 0px 0px -50px;
         }
		 .required label {
			font-weight: bold;
		}
		.required label:after {
			color: #e32;
			content: ' *';
			display:inline;
		}
   </style>
   <div class="loader"></div>
    <?php
   $serverdate = date('m/d/y');
   $today = date("Y-m-d", strtotime($serverdate));
   if($_SESSION['user_id']==""){
     echo "<script>alert('Session Expired... Please log in again...')</script>";
      echo "<script>location.href = './'</script>";
   } 
?>

<div class="w3-bar w3-card w3-text-white w3-top" id="myNavbar">
   <div id='imgLoading' class="w3-overlay w3-text-aqua" onclick="w3_close()" style="cursor:pointer" id="myOverlay"><i id="gif" class="fa fa-spinner w3-spin" style="font-size:64px;"></i></div>
    <div class="w3-row" style="background-color: #ff003b9c;">
		<div class="w3-col s10 l9">
			<a href="javascript:void(0)" class="w3-bar-item w3-button w3-left w3-margin-right" onclick="w3_open()">
			<i class="fa fa-bars w3-xlarge"></i></a>
			 <label class="w3-left" style="font-size:25px">Quiz System</label>
		</div>
		<div class="w3-col s2 l3">
			<span class="loginlogoutlink" style="color:#fff;"><a  class="loginlogoutlink-login w3-right w3-margin-right w3-margin-top " href="./" style="color:#fff;"><label class="w3-hide-small w3-medium w3-text-white "></label><i class="fa fa-power-off w3-xlarge"  title="Log Out " aria-hidden="true"  ></i></a>
			</span>
		</div>
	</div>
    <nav class="w3-sidebar w3-bar-block w3-moss w3-card  w3-animate-left" style="background-color:#E4E1B2;" id="mySidebar">
      <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
      <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-large  w3-border-white w3-border-right "> <i class="fa fa-times w3-xlarge w3-text-grey" title="Close"></i> </a>
      <a href="./topic" class="w3-bar-item w3-button w3-padding-small w3-border w3-border-white w3-border-bottom">Topic</a>
      <a href="./question" class="w3-bar-item w3-button w3-padding-small w3-border w3-border-white w3-border-bottom">Question List</a>
    </nav>
</div>

<script>
 
   var mySidebar = document.getElementById("mySidebar");
   
   function w3_open() {
     if (mySidebar.style.display === 'block') {
       mySidebar.style.display = 'none';
     } else {
       mySidebar.style.display = 'block';
     }
   }   
   
   function w3_close() {
     mySidebar.style.display = "none";
     myOverlay.style.display = "none";
   
   }
</script>