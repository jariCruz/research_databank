function verifyStudent(student_id) {
	swal({
		title: "Verify Account?",
		text: "Verifying account would allow the user to download\n"+
		"and view pdf.",
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
			var data = new FormData();
			data.append('student_id', student_id);
			$.ajax({
				url: "account_status.php",
				type: 'post',
				data: data,
				contentType: false,
				processData: false,
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