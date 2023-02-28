<?php
    include 'db.php';
    session_start();
    if(!(isset($_SESSION['email']))){
        header("location:index.php");
    }else{
        $name = $_SESSION['name'];
        $email = $_SESSION['email'];
        $login_id = $_SESSION['login_id'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome | Quiz System</title>
    <link  rel="stylesheet" href="css/bootstrap.min.css"/>
    <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/> 
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">	
    <link rel="stylesheet" href="css/welcome.css">
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"  type="text/javascript"></script>
</head>
<body>
    <nav class="navbar navbar-default title1">
        <div class="container-fluid">
            <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><b>Quiz System</b></a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li <?php if(@$_GET['q']==1) echo 'class="active"'; ?> ><a href="welcome.php?q=1"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a></li>
					<li <?php if(@$_GET['q']==2) echo 'class="active"'; ?>> <a href="welcome.php?q=2"><i class="fa fa-history"></i>&nbsp;Summary</a></li>
					<li <?php if(@$_GET['q']==3) echo 'class="active"'; ?>> <a href="welcome.php?q=3"><i class="fa fa-star"></i>&nbsp;Ranking</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li <?php echo $name; ?> > <a href="logout.php" title="<?= $email ?>"> <?= ucwords($name)?>&nbsp; <i  class="fa fa-sign-out"></i> </a></li>
				</ul>
			</div>
		</div>
    </nav>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
				$i=0;
				if(@$_GET['q']==1) {
                    $result = mysqli_query($con,"SELECT * FROM topicmaster inner join questionmaster on questionmaster.topic_id=topicmaster.topic_id group by questionmaster.topic_id") or die('Error');
                    echo  '<div class="panel">
						<div class="ml-0">
							<h2><u>Topic List</u></h2>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped"  style="width:100%">
								<thead>
									<tr>
										<th>Sr No</th>
										<th>Topic Name</th>
										<th>Total Questions</th>
										<th>Marks</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
					while($row = mysqli_fetch_array($result)) {
						$i++;
						$query=mysqli_query($con,"SELECT quiz_id FROM quizmaster WHERE topic_id='".$row['topic_id']."' AND user_email='$email'" )or die('Error');
						$rowcount=mysqli_num_rows($query);	
						if($rowcount == 0){
							$topic_name = $row['topic_name'];
							$btnName = '<a href="welcome.php?q=quiz&step=2&tid='.$row['topic_id'].'&n=1" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><i class="fa fa-send"></i>&nbsp;&nbsp;<b>Start</b></span></a>';
						}else{
							$topic_name = $row['topic_name'].'&nbsp;&nbsp;<i title="This quiz is already solved by you" class="fa fa-check-circle" style="color:green;"></i>';
							$btnName = '<a href="update.php?q=quizre&tid='.$row['topic_id'].'&n=1" class="btn sub1" style="color:black;margin:0px;background:#ff0000"><i class="fa fa-repeat"></i>&nbsp;&nbsp;<b>Restart</b></span></a>';
						}
                        echo '<tr>
							<td>'.$i.'</td>
							<td>'.$topic_name.'</td>
							<td>10</td>
							<td>'.(10*$row['marks_per_question']).'</td>
							<td>'.$btnName.'</td>
						</tr>';
						}
                    echo '</table></div></div>';
                }?>

                <?php
                    if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
                        $tid=@$_GET['tid'];
                        $sn=@$_GET['n'];
						$limit = $sn-1;
						$checkQuestionAttempted = mysqli_query($con,"SELECT quiz_id FROM quizmaster WHERE user_email='$email' and attempted_questions='$sn' and topic_id='$tid'");
						$rowcount=mysqli_num_rows($checkQuestionAttempted);
						if($rowcount == 0){
							$question=mysqli_query($con,"SELECT * FROM questionmaster inner join levelmaster on levelmaster.level_id=questionmaster.level_id inner join topicmaster on topicmaster.topic_id=questionmaster.topic_id WHERE questionmaster.topic_id='$tid' order by questionmaster.level_id,question_id asc limit $limit,1");
							
							echo '<div class="panel" style="margin:5%">';
							while($qrow=mysqli_fetch_array($question) ){
								if($qrow['level_id']==1){
									$badgeColor = 'background-color:green;';
								}elseif($qrow['level_id']==2){
									$badgeColor = 'background-color:blue;';
								}else{
									$badgeColor = 'background-color:red;';
								}
								echo '<div style="margin:1%;text-align:center">
									<h2>****&nbsp;<u>Topic Name : '.$qrow['topic_name'].'</u>&nbsp;****</h2>
								</div>';
								echo '<h4><b>Question &nbsp;'.$sn.'&nbsp;::&nbsp <span class="badge" style="'.$badgeColor.'" >'.$qrow['level_name'].' Level</span></h4><br>'.$qrow['question'].'</b><br /><br />';
								echo '<form action="update.php?q=quiz&step=2&tid='.$tid.'&n='.$sn.'" method="POST"  class="form-horizontal">';
								for($i=1;$i<=4;$i++){
									echo'<input type="radio" name="ans" value="'.$qrow["option$i"].'">&nbsp;'.$qrow["option$i"].'<br /><br />';
								}
								echo'<br /><button type="submit" class="btn btn-primary">Submit</button></form></div>';
							}
						}else{
							echo '<div class="panel" style="margin:5%"><h4 style="color:#ff0000;">This question is already solved by you...<span class="float-right"><a href="welcome.php?q=quiz&step=2&tid='.$tid.'&n='.($sn+1).'" class="btn sub1" style="color:black;margin:0px;background:#2196f38a"><b>Next Question</b><i class="fa fa-arrow-right"></i></span></a></span></h4></div>';
						}
                    }

                    if(@$_GET['q']== 'result' && @$_GET['tid']) {
                        $tid=@$_GET['tid'];
                        $q=mysqli_query($con,"SELECT * FROM quizmaster inner join topicmaster on topicmaster.topic_id=quizmaster.topic_id WHERE quizmaster.topic_id='$tid' AND user_email='$email' " )or die('Error');
						
                        while($row=mysqli_fetch_array($q) ){
                            $s=$row['obtained_marks'];
                            $w=$row['wrong_questions'];
                            $r=$row['correct_questions'];
                            $qa=$row['attempted_questions'];
							
					     echo  '<div class="panel">
							<div style="margin:1%;text-align:center">
									<h2>****&nbsp;<u>Topic Name : '.$row['topic_name'].'</u>&nbsp;****</h2>
								</div>
                        <center><h1><u>Result</u></h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';
                            echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
                                <tr style="color:#99cc32"><td>Right Answer&nbsp;<i class="fa fa-check-circle"></i></td><td>'.$r.'</td></tr> 
                                <tr style="color:red"><td>Wrong Answer&nbsp;<i class="fa fa-times-circle"></i></td><td>'.$w.'</td></tr>
                                <tr style="color:#66CCFF"><td>Score&nbsp;<i class="fa fa-star"></i></td><td>'.$s.'</td></tr>';
                        }
                        $q=mysqli_query($con,"SELECT * FROM rankmaster WHERE  user_email='$email' " )or die('Error');
                        while($row=mysqli_fetch_array($q) ){
                            $s=$row['score'];
                            echo '<tr style="color:#990000"><td>Overall Score&nbsp;<i class="fa fa-bar-chart"></i></td><td>'.$s.'</td></tr>';
                        }
                        echo '</table></div>';
                    }
                ?>

                <?php
                    if(@$_GET['q']== 2) {
                        $query=mysqli_query($con,"SELECT * FROM quizmaster inner join topicmaster on topicmaster.topic_id=quizmaster.topic_id WHERE user_email='$email' ORDER BY quiz_date DESC " )or die('Error');
                        echo  '<div class="panel title">
						<div class="ml-0">
							<h2><u>Quiz Summary</u></h2>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped"  style="width:100%">
								<thead>
									<tr>
										<th>Sr No</th>
										<th>Date</th>
										<th>Topic Name</th>
										<th>Question Solved</th>
										<th>Right</th>
										<th>Wrong</th>
										<th>Score</th>
									</tr>
								</thead>
								<tbody>';
							$i=0;
							while($row1=mysqli_fetch_array($query) ){
								$i++;
								echo '<tr>
								<td>'.$i.'</td>
								<td>'.date('d-m-Y h:i A',strtotime($row1['quiz_date'])).'</td>
								<td>'.$row1['topic_name'].'</td>
								<td>'.$row1['attempted_questions'].'</td>
								<td>'.$row1['correct_questions'].'</td>
								<td>'.$row1['wrong_questions'].'</td>
								<td>'.$row1['obtained_marks'].'</td>
								</tr>';
							}	
                        echo'</table></div>';
                    }

                    if(@$_GET['q']== 3) {
                        $query=mysqli_query($con,"SELECT * FROM rankmaster ORDER BY score DESC " )or die('Error');
                        echo  '<div class="panel title"><div class="ml-0">
							<h2><u>Rank</u></h2>
						</div>
						<div class="table-responsive">
							<table class="table table-stripped"  style="width:100%">
								<thead>
									<tr>
										<th>Rank</th>
										<th>Date</th>
										<th>Email</th>
										<th>Score</th>
									</tr>
								</thead>
								<tbody>';
								$i=0;
							while($row2=mysqli_fetch_array($query) ){
								$i++;
								echo '<tr>
								<td>'.$i.'</td>
								<td>'.date('d-m-Y h:i A',strtotime($row2['date'])).'</td>
								<td>'.$row2['user_email'].'</td>
								<td>'.$row2['score'].'</td>
							</tr>';
							}	
                        echo '</table></div></div>';
                    }
                ?>
</body>
</html>
