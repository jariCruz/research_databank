//This file contains scripts fo rs_upload_page.php
// Individual notification
function validateInput(n, min) {//min is for the length that is accepted
  // Get the current element
  var inputValue = document.getElementById(n);
  //var len = document.getElementById(min);
  // Get the parent element
  var pn = inputValue.parentElement;
  // Get the value
  var vElement = inputValue.value;
  //validate the length
  if (vElement.length >= (min - 1)) {
    pn.className += " was-validated";
    if(vElement.length >= (min - 1)){
      pn.className.replace(/\bwas-validated\b/g, "");
    }
  }else {
    pn.className.replace(/\bwas-validated\b/g, "");
  }
  
}
// end of individual notification

function uploadVal() {
    console.log(document.getElementById("form_keywords").value);
    var title = document.getElementById("form_title").value;
    var author = document.getElementById("form_author").value;
    var adviser = document.getElementById("form_adviser").value;
    var year = document.getElementById("form_year").value;
    var course = document.getElementById("form_course").value;
    var keywords = document.getElementById("form_keywords").value;
    var abstract = document.getElementById("form_abstract").value;
    var file = document.getElementById("form_file").value;
    var fd = new FormData();
    var actualFile = $('#form_file')[0].files;

    
    if (title.length != 0 && author.length != 0 && adviser.length != 0 && year.length != 0 
        && course.length != 0 && keywords.length != 0 && abstract.length != 0 && file.length != 0) {

        if (title.length < 10) {
            swal({
                title: "Upload Failed!",
                text: "Title must have atleast 10 characters!",
                icon: "error",
                button: true,
              });
        }else {
            if (author.length < 5) {
                swal({
                    title: "Upload Failed!",
                    text: "Author must have atleast 5 characters!",
                    icon: "error",
                    button: true,
                  });
            }else {
                if (adviser.length < 5) {
                    swal({
                        title: "Upload Failed!",
                        text: "Adviser must have atleast 5 characters!",
                        icon: "error",
                        button: true,
                      });
                }else {
                    if (keywords.length < 8) {
                        swal({
                            title: "Upload Failed!",
                            text: "Password must have atleast 8 characters!",
                            icon: "error",
                            button: true,
                          });
                    }else {
                        if (abstract.length < 10) {
                            swal({
                                title: "Upload Failed!",
                                text: "Abstract must have atleast 10 characters!",
                                icon: "error",
                                button: true,
                              });
                        }else {
                                swal({
                                    title: "Upload Research?",
                                    text: "Click 'OK' to proceed.",
                                    icon: "warning",
                                    buttons: {
                                      cancel: "Cancel",
                                      ok:{
                                        text: "Ok",
                                        value: "ok",
                                      }
                                    },
                                  })
                                  .then((ok)=>{
                                      if (ok) {
                                        //hide modal for uploading research
                                        $("#researchUpload_mc").modal('hide');
                                        swal({
                                          title: "Uploading Research...",
                                          text: "This may take for a while.",
                                          icon: "../img/upload_loading_icon.gif",
                                          button: false,
                                          closeOnClickOutside: false,
                                          closeOnEsc: false
                                        });
                                        fd.append('file',actualFile[0]);
                                        fd.append('title',title);
                                        fd.append('author',author);
                                        fd.append('adviser',adviser);
                                        fd.append('year',year);
                                        fd.append('course',course);
                                        fd.append('keywords',keywords);
                                        fd.append('abstract',abstract);
                                        $.ajax({
                                          url: 'rs_upload_page_function.php',
                                          type: 'post',
                                          data: fd,
                                          contentType: false,
                                          processData: false,
                                          success: function(response){
                                            //update research studies
                                            updateResearch();
                                            //reset field to '' after uploading success
                                            swal({
                                              title: "Upload success",
                                              text: response,
                                              icon: "success",
                                              button: true,
                                            });
                                            document.getElementById("form_title").value = '';
                                            document.getElementById("form_author").value = '';
                                            document.getElementById("form_adviser").value = '';
                                            document.getElementById("form_course").value = '';
                                            document.getElementById("form_keywords").value = '';
                                            document.getElementById("form_year").value = '';
                                            document.getElementById("form_abstract").value = '';
                                            document.getElementById("form_file").value = '';

                                            document.getElementById("form_title").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_author").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_adviser").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_course").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_keywords").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_year").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_abstract").className.replace(/\bwas-validated\b/g, "");
                                            document.getElementById("form_file").className.replace(/\bwas-validated\b/g, "");

                                            $('#form_file').next('.custom-file-label').html('Choose file...');
                                            var input = document.querySelector('input[name=basic]');
                                            var tagify = new Tagify(input);
                                            tagify.removeAllTags.bind(tagify);
                                          }
                                        });
                                            // var xmlhttp = new XMLHttpRequest();
                                            // xmlhttp.onreadystatechange = function() {
                                            //   if (this.readyState == 4 && this.status == 200) {
                                            //     document.getElementById("research-livesearch").innerHTML = this.responseText;
                                            //   }
                                            // };
                                            // xmlhttp.open("GET", "admin_append_function.php", true);
                                            // xmlhttp.send();
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
            title: "Upload Failed!",
            text: "Fill up all required forms!",
            icon: "error",
            button: true,
          });
    }
}

//update research function
function updateResearch() {
  $(document).ready(function() {
      function loadData(page) {
        $.ajax({
          url: "research_pagination.php",
          type: "POST",
          cache: false,
          data: {
            page_no: page
          },
          success: function(response) {
            $("#research-content").html(response);
          }
        });
      }
      loadData();

      // Pagination code
      $(document).on("click", ".pagination li a", function(e) {
        e.preventDefault();
        var pageId = $(this).attr("id");
        loadData(pageId);
      });
    });
}