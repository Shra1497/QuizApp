$(document).ready(function() {
	question_table();
});

function saveData(){
	var level_id = $('#level_id').val();
	var topic_id = $('#topic_id').val();
	var question = $('#question').val();
	var option1 = $('#option1').val();
	var option2 = $('#option2').val();
	var option3 = $('#option3').val();
	var option4 = $('#option4').val();
	var answer='';
	if($('#answer').val()=='1'){
		var answer=$('#option1').val()
	}else if($('#answer').val()=='2'){
		var answer=$('#option2').val()
	}else if($('#answer').val()=='3'){
		var answer=$('#option3').val()
	}else if($('#answer').val()=='4'){
		var answer=$('#option4').val()
	}
	$.ajax
    ({
		type: 'post',
		url: 'dal/dal_question.php',
		data: {
			save_question: 'save_question',
			level_id: level_id,
			topic_id: topic_id,
			question:question,
			option1:option1,
			option2:option2,
			option3:option3,
			option4:option4,
			answer:answer
		}, success: function (response) {
			debugger
			$('#errorDiv').show();
			var result = JSON.parse(response)
			if(result.status){
				question_table()
				$('#question_form').trigger("reset");
				$("#errorDiv").removeClass('alert-danger');
				$("#errorDiv").addClass('alert-success');
				$("#errorDiv").text(result.message);
			}else{
				$("#errorDiv").removeClass('alert-success');
				$("#errorDiv").addClass('alert-danger');
				$("#errorDiv").text(result.message);
			}
        }
    });
}
function question_table(){
	$.ajax
	({
		type:'post',
		url:'dal/dal_question.php',
		data:{
			question_table:'question_table',
		},
		success:function(response) {
			document.getElementById("filldata").innerHTML="";
			$("#filldata").append(response);
		}
	});
	$(document).ajaxStart(function () {
		$("#imgLoading").show();
	}).ajaxStop(function (){
		$("#imgLoading").hide();
		$('#tbl_question').DataTable({
			destroy: true,
			"paging": true,
		});
	});
}

function delete_question(question_id){
	swal({
	  title: "Are you sure you want to delete this question?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  cancelButtonClass: "btn-warning",
	  confirmButtonText: "Yes, delete it!",
	  cancelButtonText: "No, cancel!",
	  closeOnConfirm: false,
	  closeOnCancel: false
	},
	function(isConfirm) {
		if (isConfirm) {
			$.ajax
			({
				type: 'post',
				url: 'dal/dal_question.php',
				data: {
					delete_question: 'delete_question',
					question_id: question_id,
				},
				success: function (response) {
					if(response){
						question_table();
						swal("Deleted!", "Question has been deleted", "success");
					} else {
						swal("Not Deleted!", "Failed to delete question", "error");
					}
				}
			});
		}else{
			 swal("Cancelled", "Question is safe :)", "error");
		}
	});	
}


function clearData(){
	$("#imgLoading").show();
	$('#question_form').trigger("reset");
	$("#imgLoading").hide();
}