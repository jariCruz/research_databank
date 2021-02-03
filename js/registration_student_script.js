// Get all input by class name "needs-validation"
var parentElement = document.getElementsByClassName("needs-validation");

var inputs = document.getElementsByTagName("input");

var selects = document.getElementsByTagName("select");

function validateStudent() {
    console.log('validate function');

    
}

function submitValStudent() {
    
    var fname = document.getElementById("form_fname_student").value;
    var sname = document.getElementById("form_sname_student").value;
    var mi = document.getElementById("form_mi_student").value;
    var file1 = document.getElementById("form_file1_student").value;
    var file2 = document.getElementById("form_file2_student").value;
    var alumnus = document.getElementById("form_alumnus_student").value;
    var year = '';
    var alumnus = '';
    var course = document.getElementById("form_course_student").value;
    var address = document.getElementById("form_address_student").value;
    var uname = document.getElementById("form_uname_student").value;
    var pass = document.getElementById("form_pass_student").value;
    var repass = document.getElementById("form_repass_student").value;
    var checkbox = document.getElementById("form_checkbox_student");
    var actualFile1 = $('#form_file1_student')[0].files;
    var actualFile2 = $('#form_file2_student')[0].files;
    if(document.getElementById("form_alumnus_student").checked == true){
        alumnus = 'yes'
        year = 'none';
    }else {
        alumnus = 'no';
        year = document.getElementById("form_year_student").value;
    }
    
    if (fname.length != 0 && sname.length != 0 && file1.length != 0 && file2.length != 0 
        && course.length != 0 && address.length != 0 && uname.length != 0 
        && pass.length != 0 && repass.length != 0) {

        if (fname.length < 2) {
            swal({
                title: "Registration Failed!",
                text: "First name must be 2 characters and above!",
                icon: "error",
                button: true,
              });
        }else {
            if (sname.length < 1) {
                swal({
                    title: "Registration Failed!",
                    text: "Surname must be 1 character and above!",
                    icon: "error",
                    button: true,
                  });
            }else {
                if (uname.length < 4) {
                    swal({
                        title: "Registration Failed!",
                        text: "Username must be 4 charaters and above!",
                        icon: "error",
                        button: true,
                      });
                }else {
                    if (pass.length < 8) {
                        swal({
                            title: "Registration Failed!",
                            text: "Password must be 8 charaters and above!",
                            icon: "error",
                            button: true,
                          });
                    }else {
                        if (pass != repass) {
                            swal({
                                title: "Registration Failed!",
                                text: "Password and retype password is not the same!",
                                icon: "error",
                                button: true,
                              });
                        }else {
                            if (checkbox.checked == false) {
                                swal({
                                    title: "Registration Failed!",
                                    text: "You must accept the terms and condition!",
                                    icon: "error",
                                    button: true,
                                  });
                            }else {
                                swal({
                                    title: "Register Account?",
                                    text: "Make sure everythin is right before proceeding.",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                  })
                                  .then((ok)=>{
                                      if (ok) {
                                        swal({
                                          title: "Creating Account...",
                                          text: "This may take for a while.",
                                          icon: "/img/upload_loading_icon.gif",
                                          button: false,
                                          closeOnClickOutside: false,
                                          closeOnEsc: false,
                                        });
                                        var data = new FormData();
                                        data.append('form_fname', fname);
                                        data.append('form_sname', sname);
                                        data.append('form_mi', mi);
                                        data.append('form_year', year);
                                        data.append('form_address', address);
                                        data.append('form_course', course);
                                        data.append('form_uname', uname);
                                        data.append('form_pass', pass);
                                        data.append('form_alumnus', alumnus);
                                        data.append('form_repass', repass);
                                        data.append('form_file1', actualFile1[0]);
                                        data.append('form_file2', actualFile2[0]);
                                        $.ajax({
                                          url: '/php/registration_page_student_function.php',
                                          type: 'post',
                                          data: data,
                                          contentType: false,
                                          processData: false,
                                          success: function(response){
                                            if(response == 'exist!'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "File already exists!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'fake!'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "Make sure you upload an image file!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'large!'){
                                                swal({
                                                  title: "Registration Failed",
                                                  text: "File too large!",
                                                  icon: "error",
                                                  button: true,
                                                });
                                            }else if(response == 'username!'){
                                                swal({
                                                    title: "Registration Failed",
                                                    text: "Username was already taken.",
                                                    icon: "error",
                                                    button: true,
                                                });
                                            }else{
                                                swal({
                                                  title: "Registration Success!",
                                                  text: "Account successfully created,\nclick OK to return?",
                                                  icon: "success",
                                                  buttons: true,
                                                });
                                                document.getElementById("form_fname_student").value = '';
                                                document.getElementById("form_sname_student").value = '';
                                                document.getElementById("form_mi_student").value = '';
                                                document.getElementById("form_year_student").value = '';
                                                document.getElementById("form_alumnus_student").checked = false;
                                                var dots = document.getElementById("dotss");
                                                var moreText = document.getElementById("more");
                                                var btnText = document.getElementById("form_alumnus_student");


                                                if (btnText.checked == true) {


                                                        dots.style.display = "inline";
                                                        moreText.style.display = "none";
                                                } else {


                                                        dots.style.display = "none";
                                                        moreText.style.display = "inline";

                                                }
                                                document.getElementById("form_file1_student").value = '';
                                                document.getElementById("form_file2_student").value = '';
                                                document.getElementById("form_alumnus_student").value = '';
                                                document.getElementById("form_course_student").value = '';
                                                document.getElementById("form_address_student").value = '';
                                                document.getElementById("form_uname_student").value = '';
                                                document.getElementById("form_pass_student").value = '';
                                                document.getElementById("form_repass_student").value = '';
                                                document.getElementById("form_checkbox_student").checked = false;
                                                $('#form_file1_student').next('.front').html('Choose file...');
                                                $('#form_file2_student').next('.back').html('Choose file...');
                                                $("#create-student_mc").modal('hide');
                                            }
                                        }
                                    });
                                    }else {
                                        false;
                                      }
                                  });
                            }

                        }

                    }

                }

            }

        }
		
    }else {
		    swal({
		        title: "Registration Failed!",
		        text: "Fill up all required forms!",
		        icon: "error",
		        button: true,
		      });
    }
}
