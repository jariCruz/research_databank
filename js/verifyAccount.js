//Student
function verifyStudent(student_id) {
	swal({
		title: "Verify Account?",
		text: "Verifying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: {
			cancel: "Cancel",
			ok: {
				text: "Verify",
				value: "ok",
				closeModal: false,
			}
		},
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "account_status_student.php",
				type: 'post',
				data: {
					verify_id: student_id
				},
				success: function(response){
					$('#updateStatus').html(response);
				}
			}).
			then((results)=>{
				swal({
					title: "Account Verified!",
					text: "Account had been sucessfully verified.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

function denyStudent(student_id) {
	swal({
		title: "Deny Account?",
		text: "Denying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: {
			cancel: "Cancel",
			ok: {
				text: "Deny",
				value: "ok",
				closeModal: false,
			}
		},
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "account_status_student.php",
				type: 'post',
				data: {
					deny_id: student_id
				},
				success: function(response){
					$('#updateStatus').html(response);
				}
			}).
			then((results)=>{
				swal({
					title: "Account Denied!",
					text: "Account had been sucessfully denied.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

//Professor
function verifyProfessor(professor_id) {
	console.log(professor_id);
	swal({
		title: "Verify Account?",
		text: "Verifying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: {
			cancel: "Cancel",
			ok: {
				text: "Verify",
				value: "ok",
				closeModal: false,
			}
		},
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "account_status_professor1.php",
				type: 'post',
				data: {
					verify_id_professor: professor_id
				},
				success: function(response){
					$('#updateStatusProfessor').html(response);
				}
			}).
			then((results)=>{
				swal({
					title: "Account Verified!",
					text: "Account had been sucessfully verified.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}

function denyProfessor(professor_id) {
	console.log(professor_id);
	swal({
		title: "Deny Account?",
		text: "Denying account would allow the user to \ndownload"+
		" and view pdf.",
		icon: "warning",
		buttons: {
			cancel: "Cancel",
			ok: {
				text: "Deny",
				value: "ok",
				closeModal: false,
			}
		},
	}).
	then((ok)=>{
		if(ok){
			$.ajax({
				url: "account_status_professor1.php",
				type: 'post',
				data: {
					deny_id_professor: professor_id
				},
				success: function(response){
					$('#updateStatusProfessor').html(response);
				}
			}).
			then((results)=>{
				swal({
					title: "Account Denied!",
					text: "Account had been sucessfully denied.",
					icon: "success",
					button: true,
				});
			});	
		}else{
			swal.stopLoading();
			swal.close();
		}
	});
}