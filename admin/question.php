<html>
<title>Quiz | Question List</title>
   <head>
     <?php
	   include './header.php';
	   require "dal/load_data.php";
	?>
   </head>
    <script type="text/javascript" src="jquery/question.js"></script>
   <body>
    <div class="container mt-5">
		<br>
		<div class="row">
			<div class="col-md-2">
				<h3><span class="border-start border-primary border-5 bg-red">&nbsp;&nbsp; Question</span></h3>
			</div>
			<div class="col-md-10 text-canter">
				<div class="alert" id="errorDiv" role="alert"></div>
			</div>
		</div>
       <div class="row mt-2">
			<div class="col-md-12">
				<form id="question_form">
					<div class="row">
						<div class="col-md-3 mt-2 required">
						  <label for="level_id">Level</label>
						  <select class="form-control" name="level_id" id="level_id" required>
							<option value="">-- Select --</option>
							<?php
							$level=get_data("*","levelmaster");
							if($level){
								while($row = mysqli_fetch_array($level)){
									echo "<option value='".$row['level_id']."'>".$row['level_name']."</option>";
								}
							}
							?>
						  </select>
						</div>
						<div class="col-md-3 mt-2 required">
						  <label for="topic_id">Topic</label>
						  <select class="form-control" name="topic_id" id="topic_id" required>
							<option value="">-- Select --</option>
							<?php
							$topic=get_data("*","topicmaster");
							if($topic){
								while($row = mysqli_fetch_array($topic)){
									echo "<option value='".$row['topic_id']."'>".$row['topic_name']."</option>";
								}
							}
							?>
						  </select>
						</div>
						<div class="col-md-6 mt-2 required">
						  <label for="question">Question</label>
						  <textarea type="text" rows="3" class="form-control" required id="question" name="question" placeholder="Enter question"></textarea>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-3 mt-2 required">
						  <label for="option1">Option 1</label>
						  <input type="text" class="form-control" required id="option1" name="option1" placeholder="Enter option1">
						</div>
						<div class="col-md-3 mt-2 required">
						  <label for="option1">Option 2</label>
						  <input type="text" class="form-control" required id="option2" name="option2" placeholder="Enter option2">
						</div>
						<div class="col-md-3 mt-2 required">
						  <label for="option2">Option 3</label>
						  <input type="text" class="form-control" required id="option3" name="option3" placeholder="Enter option3">
						</div>
						<div class="col-md-3 mt-2 required">
						  <label for="option4">Option 4</label>
						  <input type="text" class="form-control" required id="option4" name="option4" placeholder="Enter option4">
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-md-3 required">
						  <label for="answer">Answer</label>
						  <select id="answer" name="answer" required class="form-control" >
							<option value="">-- Select --</option>
							<option value="1"> Option 1</option>
							<option value="2"> Option 2</option>
							<option value="3"> Option 3</option>
							<option value="4"> Option 4</option> 
							</select>
						</div>
						<div class="col-md-6" style="margin-top:20px;">
						   <button type="button" id="btnSubmit" onclick="saveData()" class="btn btn-round btn-success">Submit</button>
						   <button type="button" id="btnClear" onclick="clearData()" class="btn btn-round btn-info">Clear</button>
						</div>
					</div>
				</form>
			</div>
			<div class="col-md-12">
				<div id="filldata"></div>
			</div>
       </div>
    </div>
    </body>
     