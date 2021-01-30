// Get all input by class name "needs-validation"
var parentElement = document.getElementsByClassName("needs-validation");

var inputs = document.getElementsByTagName("input");

var selects = document.getElementsByTagName("select");

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

    // Loop for select tags
    for (i = 0; i < selects.length; i++) {
        // if a field is empty...
        if (selects[i].selectedIndex == 0) {
        // adds an invalid class to the parent node
        selects[i].parentElement.className += " was-validated";

        }
    }
}

function submitVal() {
    
    var fname = document.getElementById("form_fname").value;
    var sname = document.getElementById("form_sname").value;
    var file1 = document.getElementById("form_file1").value;
    var file2 = document.getElementById("form_file2").value;
    var department = document.getElementById("form_department").value;
    var address = document.getElementById("form_address").value;
    var uname = document.getElementById("form_uname").value;
    var pass = document.getElementById("form_pass").value;
    var r_pass = document.getElementById("form_repass").value;
    var checkbox = document.getElementById("form_checkbox");
    
    if (fname.length != 0 && sname.length != 0 && file1.length != 0 && file2.length != 0 
    && department.length != 0 && address.length != 0 && uname.length != 0 && pass.length != 0 
    && r_pass.length != 0) {
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
                            if (checkbox.checked == false) {
                                swal({
                                    title: "Registration Failed!",
                                    text: "You must accept the terms and condition!",
                                    icon: "error",
                                    button: true,
                                  });
                            }else {
                                swal({
                                    title: "Registration Success!",
                                    text: "Click OK to return in Homepage",
                                    icon: "success",
                                    button: true,
                                  })
                                  .then((ok)=>{
                                      if (ok) {
                                        document.getElementById("register_form").submit();
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
