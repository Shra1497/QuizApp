<html>
<title>Quiz | Topic</title>
   <head>
     <?php
	   include './header.php';
	   require "dal/load_data.php";
	?>
   </head>
    <script type="text/javascript" src="jquery/topic.js"></script>
   <body>
    <div class="container mt-5">
	<br>
		<div class="row">
			<div class="col-md-4">
				<h3><span class="border-start border-primary border-5 bg-red">&nbsp;&nbsp; Topic</span></h3>
			</div>
			<div class="col-md-8">
				<div class="alert" id="errorDiv" role="alert"></div>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-md-4">
				<form id="topic_form">
					<div class="form-group mt-3 required">
					  <label for="topic_name">Topic Name</label>
					  <input type="hidden" class="form-control" name="topic_id" id="topic_id">
					  <input type="text" class="form-control" required id="topic_name" name="topic_name" placeholder="Enter topic name">
					</div>
					<div class="form-group mt-3">
					  <label for="marks_per_question">Marks per question</label>
					  <input type="text" class="form-control" required id="marks_per_question" name="marks_per_question" placeholder="Enter Marks Per Question">
					</div>
					<div class="form-group mt-3 text-center">
					   <button type="button" id="btnSubmit" onclick="saveData()" class="btn btn-round btn-success">Submit</button>
					   <button type="button" id="btnClear" onclick="clearData()" class="btn btn-round btn-info">Clear</button>
					</div>
				</form>
			</div>
			<div class="col-md-8">
				<div id="filldata"></div>
			</div>
       </div>
    </div>
    </body>
     