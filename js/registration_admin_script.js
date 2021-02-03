// Get all input by class name "needs-validation"
var parentElement = document.getElementsByClassName("needs-validation");

var inputs = document.getElementsByTagName("input");

function validate() {

    for (var i = 0; i < inputs.length; i++) {

        var inputsAttribute = inputs[i].getAttribute("placeholder");
        var val = inputs[i].value;
        
        // Condition for other fields
        if (inputsAttribute != "M.I.") {

            inputs[i].parentElement.className += " was-validated";
        }
        
        // Condition if middle initial is not empty
        if (inputsAttribute == "M.I." && inputs[i].value != "") {

            inputs[i].parentElement.className += " was-validated";
        }
        //validate retype password
        if (inputs[i].value !== "" && inputs[i].value !== null) {
            inputs[i].parentElement.className += " was-validated";
            
        }

    }
}

function createAdmin() {
    
    var fname = document.getElementById("form_fname_admin").value;
    var sname = document.getElementById("form_sname_admin").value;
    var uname = document.getElementById("form_uname_admin").value;
    var pass = document.getElementById("form_pass_admin").value;
    var r_pass = document.getElementById("form_repass_admin").value;
    var mi = document.getElementById("form_mi_admin").value;
    
    if (fname.length != 0 && sname.length != 0 && uname.length != 0 
        && pass.length != 0 && r_pass.length != 0) {

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
                        if (pass != r_pass) {
                            swal({
                                title: "Registration Failed!",
                                text: "Password and retype password is not the same!",
                                icon: "error",
                                button: true,
                              });
                        }else {
                                swal({
                                    title: "Create Account?",
                                    text: "Click OK to proceed",
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                  }).
                                then((ok)=>{
                                      if (ok) {
                                        var formData = new FormData();
                                        formData.append('fname',fname);
                                        formData.append('sname',sname);
                                        formData.append('mi',mi);
                                        formData.append('username',uname);
                                        formData.append('password',pass);
                                        formData.append('r_password',r_pass);
                                        formData.append('register','token');
                                        $.ajax({
                                            url: "registration_admin.php",
                                            type: 'post',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            success: function(response){
                                                if(response == 'username!'){
                                                    swal({
                                                    title: "Registration Failed",
                                                    text: "Username was already taken.",
                                                    icon: "error",
                                                    button: true,
                                                });
                                                }else {
                                                    updateAdminResults();
                                                    updateAdminAccounts();
                                                    updateAdminPages();
                                                    swal({
                                                        title: "Account Created!",
                                                        text: "Click Ok to return.",
                                                        icon: "Success",
                                                        button: true,
                                                    });
                                                    var fname = '';
                                                    var sname = '';
                                                    var uname = '';
                                                    var pass = '';
                                                    var r_pass = '';
                                                    var mi = '';
                                                    $("#createAdmin_mc").modal("hide");
                                                }
                                            }
                                        });
                                      }else {
                                          swal.stopLoading();
                                          swal.close();
                                      }
                                  });
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
//update admin results function
function updateAdminResults() {
    $.ajax({
        url: "registration_admin.php",
        type: "post",
        data: {admin_results: "token"},
        success: function(results) {
            $("#admin_results").html(results);
        }
    });
}
//update admin accounts function
function updateAdminAccounts() {
    $.ajax({
        url: "registration_admin.php",
        type: "post",
        data: {admin_accounts: "token"},
        success: function(accounts) {
            $("#admin_accounts").html(accounts);
        }
    });
}
//update admin page function
function updateAdminPages() {
    $.ajax({
        url: "registration_admin.php",
        type: "post",
        data: {admin_pages: "token"},
        success: function(pages) {
            $("#admin_page").html(pages);
        }
    });
}