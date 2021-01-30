<?php
require "php/header.php";
include "php/server.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSU-SC Research DB</title>

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- jQuery UI library -->
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Font Awesome Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Font link -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">

  <!-- Other resources -->
  <link rel="stylesheet" href="css/index_style.css">
  <link rel="stylesheet" href="css/responsive_style.css">

  <!-- Font size not working without these >_< -->
  <link rel="stylesheet" href="css/contact_style.css">  


</head>

<body>


  <!-- navigator, modal, body -->
  <div class="bg" style="padding-bottom: 25%;">
    <div class="sticky-top">


      <nav class="navbar navbar-expand-md navbar-light bg-light">

        <div class="container-fluid">

          <div>
            <div class="header-font">
              <a class="navbar-brand" href="index.php">Research DB</a>
            </div>

            <div class="mt-n3">
              <span class="navbar-text sm-hide">Bulacan State University - Sarmiento Campus</span>
            </div>
          </div>

          <button class="navbar-toggler" type="button"
                  data-toggle="collapse" data-target="#collapseNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="collapseNavbar">
            <ul class="navbar-nav ml-auto">

              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>

              </li>


              <li class="nav-item">
                <a class="nav-link" href="php/about_page.php">About</a>

              </li>

              <li class="nav-item">
                <a class="nav-link" href="php/contact_page.php">Contact</a>

              </li>

              <!-- Dropdown for Logged-in -->
              <!--
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop"
                    data-toggle="dropdown">Webster~</a>

                <div class="dropdown-menu dropdown-menu-right">
                  <a href="#" class="dropdown-item">Settings & privacy</a>
                  <a href="#" class="dropdown-item">Help Guides</a>
                  <a href="#" class="dropdown-item">Support Centre</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">Sign out</a>
                </div>
              </li>
              -->

              <!-- buttons for Log in and sign up -->

              <?php if (!isset($_SESSION['user_id'])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal"
                    data-target="#signIn_mc">Sign in</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal"
                    data-target="#create_mc">Create account</a>
              </li>
              <?php }else { ?>
                <li class="nav-item">
                  <form id="logout" action="php/logout.php" method="post">
                  <a class="nav-link" href="javascript:;" onclick="document.getElementById('logout').submit();">Logout</a>
                  <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]) ?>" />
                  </form>
                </li>
              <?php } ?>
              
              
            </ul>
          </div>


        </div>
      </nav>
    </div>

  

    <!-- Modal for creating an account -->
    <div class="modal fade" id="create_mc">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <!-- modal header -->
          <div class="modal-header">
            <h5 class="modal-title header-font">Create an account for...</h5>
            <button class="close" data-dismiss="modal">&times;</button>
          </div>

          <!-- modal body -->
          <div class="modal-body">
            <div class="row">


            <!-- Student -->            
              <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">

                    <a href="php/registration_page_student.php"
                        class="stretched-link">Student</a>
              </div>

            <!-- Professor -->
              <div class="col mt-n3 mb-n3 modal-hover modal-height
                          d-flex align-items-center justify-content-center">
                
                  <a href="php/registration_page_professor.php"
                      class="stretched-link">Professor</a>
              </div>
              
            </div>
          </div>

          <!-- modal footer -->
          <div class="modal-footer">
            <button class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>

    <!-- modal -->
    </div>

    <!-- Modal for sign in -->
    <div class="modal fade" id="signIn_mc">
      <div class="modal-dialog">
          <div class="modal-content">
                  
              <!-- modal header -->
              <div class="modal-header">
                  <h5 class="modal-title header-font">Someone is logging in...</h5>
                  <button class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- modal body -->
              <div class="modal-body">

                  <form action="php/login_function.php" method="post"
                          class="needs-validation
                                  mx-auto mb-3">
                      
                      
                      <!-- Forename field -->

                      <div class="form-group">
                          <label for="form_fname">Username:</label>
                          
                          <input type="text"
                                  class="form-control"
                                  id="form_uname"
                                  placeholder="Username"
                                  name="form_uname"
                                  minlength="2"
                                  maxlength="30"
                                  required>                

                      </div>

                      <!-- Password field -->


                      <div class="form-group mt-2">
                          <label for="form_pass">Passsword:</label>
                          <input type="password"
                                  name="form_pass"
                                  id="form_pass"
                                  placeholder="Password"
                                  class="form-control"
                                  maxlength="30"
                                  minlength="8"
                                  required>

                      </div>
                      <input type="hidden" name="redirect" value="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>" />

                      
                      <!-- Checkbox -->
                      
                      
                      <div class="row">
                          <div class="form-group col">
                              <input type="checkbox">
                              <span>Remember me</span>
                          </div>

                          <!-- Register btn -->
                          <div class="col d-flex justify-content-end">
                              <button name="login-submit" id="login-submit" type="submit" class="btn btn-primary">Login</button>
                          </div>
                      
                      </div>
                      
                      <span class="d-flex justify-content-center mt-3">Don't have an account yet?&MediumSpace;
                          <a data-dismiss="modal" href="#" data-toggle="modal" data-target="#create_mc">Register here.</a>
                      </span>

                      <!-- just a freakin horizontal line -->            
                      <hr class="bg-dark mt-4">

                      <span class="d-flex justify-content-center">
                          <a href="#">Forgot password?</a>
                      </span>

                  </form>
              </div>

              <!-- Form validation -->
              <script>

                  (function() {
                  'use strict';
                  window.addEventListener('load', function() {
                  // Get the forms we want to add validation styles to
                  var forms = document.getElementsByClassName('needs-validation');
                  // Loop over them and prevent submission
                  var validation = Array.prototype.filter.call(forms, function(form) {

                  form.addEventListener('submit', function(event) {
                      if (form.checkValidity() === false) {
                      
                      event.preventDefault();
                      event.stopPropagation();
                      }   
                      form.classList.add('was-validated');
                  }, false);
                  });
                  }, false);
                  })();
              </script>

      
              </div>

          </div>
    </div>

    

    <!-- body -->

    <div class="container-fluid">
      <div class="display-5 lg-margin sm-margin">
        <h1 class="header-font sm-font-size">Welcome to RSDB</h1>
        <p style="font-size:larger">Search the knowledge hidden within</p>

        <!-- Search form -->
        <form action="php/search_page.php" method="get">
          <div class="input-group mb-3 mt-4 sm-width l-width">
          <!-- Search button -->
            <div class="input-group-prepend">
              <button class="btn btn-outline-primary sm-btn-font-size"
                        type="submit">Search</button>
            </div>
              <!-- Search input -->
              <input type="hidden" name="page" value="1">
              <input type="text" class="form-control bg-transparent sm-width" id="search-input" name="query" autocomplete="off"
                      placeholder="Search for articles..." required>
          </div>
        </form>
        <div id="results"><!-- Search results --></div>


        <!-- Most search keywords -->

        <div class="container-fluid">
          <div class="row">

            <?php  
            $sql = "SELECT Title FROM researchstudy_table ORDER BY Views DESC";
            $result = $conn->query($sql);
            $mostViewed = array();
            $x = 0;

            if ($result->num_rows > 0) {
              // output data of each row
              while ($row = $result->fetch_assoc()) {
              $x++;
              $mostViewed[$x] = $row['Title'];
              }
            } else {
              echo "0 results";
            }
            ?>
            <h6>Most Viewed:</h6>

            
            <div class="ml-2">
              <a href="#"><?php echo $mostViewed[1]; ?></a>
            </div>

            <span class="ml-2 mr-2">|</span>

            <div>
              <a href="#"><?php echo $mostViewed[2]; ?></a>
            </div>

            <span class="ml-2 mr-2">|</span>

            <div>
              <a href="#"><?php echo $mostViewed[3]; ?></a>
            </div>
            </ul>



          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Jumbotron -->
  <div class="jumbotron jumbotron-fluid
                jumbotron-bg-black text-white">
    <div class="container">

      <h2 class="header-font">Lorem lorem ipsum</h2>
      <p>Lorem ipsum dolor sit amet. Lorem ipsum lorem ipsum</p>
    </div>
  </div>


  <!-- Footer -->

  <footer class="border-top-2 pb-4">

    <div class="container">
      <div class="row">
        <div class="col-md-8 ft">
          <p style="margin-top: -1%">Copyright © 2020 Research DB. All rights reserved.<br>
            We use cookies to help provide and enhance our service and tailor content.<br>
            By continuing you, agree to our <a href="#">Cookies Settings</a>.</p><br>

          <div style="margin-top: -4%;">
            <a href="#">Copyright</a>
            <span class="px-3">|</span>

            <a href="#">Terms of Use</a>
            <span class="px-3">|</span>

            <a href="#">Privacy Policy</a>

          </div>
        </div>

        <div class="col-md-4 l-mt sm-mt">
          <span>Follow us on:</span><br>

          <span class="fa fa-facebook-official sl"></span>
          <span class="fa fa-instagram sl px-3"></span>
          <span class="fa fa-twitter-square sl"></span>
        </div>

      </div>
    </div>

  </footer>


  <script>
    $(function() {
        $("#search-input").autocomplete({
            source: "php/action.php",
            select: function(event, ui) {   
                console.log(ui.item.value);
                    location.href="php/search_page.php?page=1&query="+ui.item.value;
            }
        });
    });
    </script>
</body>

</html>
