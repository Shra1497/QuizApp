<?php
  include_once 'db.php';
  session_start();
  $email=$_SESSION['email'];

  if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
    $tid=@$_GET['tid'];
    $sn=@$_GET['n'];
	$limit=$sn-1;
    $total=10;
    $ans=$_POST['ans'];
	$answer='';
    $questionData=mysqli_query($con,"SELECT answer FROM questionmaster WHERE topic_id='$tid' order by question_id asc limit $limit,1" );
    while($qrow=mysqli_fetch_array($questionData) ){  $answer=$qrow['answer']; }
	if($sn == 1){
       $insertData=mysqli_query($con,"INSERT INTO quizmaster (`topic_id`,`user_email`,`quiz_date`) VALUES('$tid','$email',NOW())")or die('Error');
    }
	$topicData=mysqli_query($con,"SELECT marks_per_question FROM topicmaster WHERE topic_id='$tid'" );
    while($trow=mysqli_fetch_array($topicData) ){ $marks_per_question=$trow['marks_per_question'];}
	if($ans == $answer){
      $quizData=mysqli_query($con,"SELECT obtained_marks,correct_questions FROM quizmaster WHERE topic_id='$tid' AND user_email='$email' ")or die('Error');
      while($row=mysqli_fetch_array($quizData) ){
        $obtained_marks=$row['obtained_marks'];
        $correct_questions=$row['correct_questions'];
      }
      $correct_questions++;
      $obtained_marks=$obtained_marks+$marks_per_question;
      mysqli_query($con,"UPDATE `quizmaster` SET `obtained_marks`=$obtained_marks,`attempted_questions`=$sn,`correct_questions`=$correct_questions,quiz_date= NOW() WHERE  user_email = '$email' AND topic_id = '$tid'")or die('Error');
    } else{
      $quizData=mysqli_query($con,"SELECT obtained_marks,wrong_questions FROM quizmaster WHERE topic_id='$tid' AND user_email='$email' ")or die('Error');
      while($row=mysqli_fetch_array($quizData) ){
        $obtained_marks=$row['obtained_marks'];
        $wrong_questions=$row['wrong_questions'];
      }
      $wrong_questions++;
     // $obtained_marks=$obtained_marks-$marks_per_question;
     mysqli_query($con,"UPDATE `quizmaster` SET `obtained_marks`=$obtained_marks,`attempted_questions`=$sn,`wrong_questions`=$wrong_questions WHERE  user_email = '$email' AND topic_id = '$tid'")or die('Error');
    }
    if($sn != 10){
      $sn++;
      header("location:welcome.php?q=quiz&step=2&tid=$tid&n=$sn")or die('Error');
    }else {
		$query=mysqli_query($con,"SELECT obtained_marks FROM quizmaster WHERE topic_id='$tid' AND user_email='$email'" )or die('Error');
		while($row=mysqli_fetch_array($query)){
			$score=$row['obtained_marks'];
		}
		$query1=mysqli_query($con,"SELECT * FROM rankmaster WHERE user_email='$email'" )or die('Error');
		$rowcount=mysqli_num_rows($query1);
		if($rowcount == 0){
			$query2=mysqli_query($con,"INSERT INTO rankmaster (`user_email`,`score`,`date`) VALUES('$email','$score',NOW())")or die('Error');
		}else{
			while($row1=mysqli_fetch_array($query1)){
				$new_score=$row1['score'];
			}
			$new_score=$score+$new_score;
			$query3=mysqli_query($con,"UPDATE `rankmaster` SET `score`=$new_score ,date=NOW() WHERE user_email= '$email'")or die('Error');
		}
      header("location:welcome.php?q=result&tid=$tid");
    }
  }
  
  if(@$_GET['q']== 'quizre') {
    $tid=@$_GET['tid'];
    $n=@$_GET['n'];
    $query=mysqli_query($con,"SELECT obtained_marks FROM quizmaster WHERE topic_id='$tid' AND user_email='$email'" )or die('Error');
    while($row=mysqli_fetch_array($query) ){
      $obtained_marks=$row['obtained_marks'];
    }
    $query1=mysqli_query($con,"DELETE FROM `quizmaster` WHERE topic_id='$tid' AND user_email='$email' " )or die('Error');
    $query2=mysqli_query($con,"SELECT * FROM rankmaster WHERE user_email='$email'" )or die('Error');
    while($row1=mysqli_fetch_array($query2) ){
      $totalScore=$row1['score'];
    }
    $totalScore=$totalScore-$obtained_marks;
    $q=mysqli_query($con,"UPDATE `rankmaster` SET `score`=$totalScore ,date=NOW() WHERE user_email= '$email'")or die('Error');
    header("location:welcome.php?q=quiz&step=2&tid=$tid&n=1");
  }

?>



