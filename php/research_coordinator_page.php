<?php
require "header.php";
include "server.php";
//paginationsht
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
//limit kung ilan gusto mo i display
$limit = 5;
//saan mag sisimula ung i display mo
$start = ($page - 1) * $limit;


if (isset($_GET['query'])) {
    $search = $_GET['query'];
} else {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Research | BSU-SC Research DB</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

	<!-- jQuery UI library -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- View PDF icon -->
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    


    <!-- Font link -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abril+Fatface|Poppins">

    <!-- Tag input -->
    <link rel="stylesheet" href="../github-tagsinput/tagify/dist/tagify.css">
    <script src="../github-tagsinput/tagify/dist/jQuery.tagify.min.js"></script>

    <!-- Other resources -->
    <link rel="stylesheet" href="../css/research_coordinator_style.css">
    <link rel="stylesheet" href="../css/responsive_style.css">
    <link rel="stylesheet" href="../css/jumbotron_style.css">
    <script src="../js/researchCoordinator_script.js"></script>


</head>

<body>

    <!-- Header -->

    <nav class="navbar navbar-expand-md navbar-light bg-light">

        <div class="container-fluid">

            <div>
                <div class="header-font">
                    <a class="navbar-brand" href="../css/research_coordinator_page.css">Research DB</a>
                </div>

                <div class="mt-n3">
                    <span class="navbar-text sm-hide">Bulacan State University - Sarmiento Campus</span>
                </div>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapseNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="collapseNavbar">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">
                        <!-- change link -->
                        <a class="nav-link" href="research_coordinator_page.php">Home</a>

                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="about_page.php">About</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact_page.php">Contact</a>

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
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#signIn_mc">Sign in</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#create_mc">Create account</a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <form id="logout" action="logout.php" method="post">
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


    <!-- Modal for sign in -->
    <div class="modal fade" id="signIn_mc" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- modal header -->
                <div class="modal-header">
                    <h5 class="modal-title header-font">Someone is logging in...</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- modal body -->
                <div class="modal-body">

                    <form action="login_function.php" method="post" class="needs-validation
                                    mx-auto mb-3">


                        <!-- Forename field -->

                        <div class="form-group">
                            <label for="form_fname">Username:</label>

                            <input type="text" class="form-control" id="form_uname" placeholder="Username" name="form_uname" minlength="2" maxlength="30" required>

                        </div>

                        <!-- Password field -->


                        <div class="form-group mt-2">
                            <label for="form_pass">Passsword:</label>
                            <input type="password" name="form_pass" id="form_pass" placeholder="Password" class="form-control" maxlength="30" minlength="8" required>

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
                                <button name="login-submit" id="login-submit" type="button" class="btn btn-primary" onclick="login()">Login</button>
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

    <!-- modal -->
    </div>

    <!-- Modal for creating an account -->
    <div class="modal fade" id="create_mc">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- modal header -->
                <div class="modal-header">
                    <h5 class="modal-title header-font">Create an account...</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- modal body -->
                <div class="modal-body">
                    <div class="row">
                        <!-- Student -->
                        <div class="col mt-n3 mb-n3 modal-hover modal-height
                                    d-flex align-items-center justify-content-center">

                            <a href="registration_page_student.php" class="stretched-link">Student</a>
                        </div>

                        <!-- Professor -->
                        <div class="col mt-n3 mb-n3 modal-hover modal-height
                                    d-flex align-items-center justify-content-center">

                            <a href="registration_page_professor.php" class="stretched-link">Professor</a>
                        </div>
                    </div>

                </div>

                <!-- modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>
                </div>

            </div>

            <!-- modal -->
        </div>
    </div>

    <!-- Greetings -->
    <div style="height: 80px;" id="greetings-bg" class="container-fluid
            pl-4 pt-5
            border border-primary
                border-left-0
                border-right-0">

    <?php if(isset($_SESSION['user_id'])) { ?>
        <h4 class="header-font text-right">Welcome <?php echo $_SESSION['lastname'] ?>!</h4>
    <?php }else{ ?>
        <h4 class="header-font text-right">Welcome Unidentified Sht. ?>!</h4>
    <?php } ?>


    </div>

    <!-- contains nav-tab and tab-content -->
    <div class="container-fluid">
        <div class="pt-3">

            <!-- Menu -->
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link sm-smaller-fs active" href="#overview">Overview</a>
                </li>

                <li class="nav-item dropdown">
                    <a id="research" class="nav-link sm-smaller-fs dropdown-toggle" data-toggle="dropdown" href="#">Research</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item sm-smaller-fs" href="#researchUpload" onclick="changeBtnTxt('research', 'Append research')">Append research</a>
                        <a class="dropdown-item sm-smaller-fs" href="#researchStudyList" onclick="changeBtnTxt('research', 'View research')">View research</a>
                    </div>
                </li>

                <li class="nav-item dropdown">

                    <a id="accountBtn" class="nav-link sm-smaller-fs dropdown-toggle" data-toggle="dropdown" href="#">Accounts</a>
                    <div class="dropdown-menu">
                    <!-- Alumni link added -->
                        <a class="dropdown-item sm-smaller-fs" href="#alumni" onclick="changeBtnTxt('accountBtn', 'Alumni')">Alumni</a>
                        <a class="dropdown-item sm-smaller-fs" href="#student" onclick="changeBtnTxt('accountBtn', 'Student')">Student</a>
                        <a class="dropdown-item sm-smaller-fs" href="#professor" onclick="changeBtnTxt('accountBtn', 'Professor')">Professor</a>
                        <a class="dropdown-item sm-smaller-fs" href="#admin" onclick="changeBtnTxt('accountBtn', 'Admin')">Admin</a>
                    </div>
                </li>

            </ul>


        <!-- padding -->
        </div>


        <!-- tab panes tab content -->
        <div class="tab-content">

            <!-- Overview tab -->
            <div id="overview" class="container tab-pane fade active show"><br>
                <h4>Overview</h4>
                <p>In this page, as a research coordinator, you can manage data. <br>You can manage research data and account, such as alumni, student, professor, and admin</p>
            </div>

            <!-- Research study upload tab -->
            <div id="researchUpload" class="container tab-pane fade"><br>
                <h4>Append Research Menu</h4>
                <p>You can upload research study by clicking the button below.</p>

                <button class="btn btn-outline-primary" href="#researchUpload_mc" data-toggle="modal" data-keyboard="false" data-backdrop="static">+ Append</button>

                <p id="tryResult" class="text-danger mt-3">Note: Once the information have been uploaded, it cannot be edited again.<br>Please be sure to check the information you provided before you upload, thank you.</p>


                <!-- Modal for uploading research -->
                <div class="modal fade" id="researchUpload_mc" role="dialog">
                    <div class="modal-dialog modal-dialog-scrollable">

                        <!-- Modal header -->
                        <div class="modal-content">
                        <!-- remove modal title -->

                            <div class="modal-header">
                                <div class="modal-title header-font">Coordinator is uploading thesis...</div>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>


                            <!-- Modal details -->

                            <div class="modal-body">
                                <!-- Make the title color black -->
                                <!-- Make the hover color blue -->


                                <form id="rs_upload_form" method="post" action="rs_upload_page_function.php"
                                class="needs-validation mx-auto mb-3" enctype="multipart/form-data">


                                    <!-- Note -->

                                    <p class="text-danger">Note: Once the information have been uploaded, it cannot be edited again.
                                        Please be sure to check the information you provided before you upload, thank you.
                                    </p>


                                    <!-- Title field -->

                                    <div class="form-group">
                                        <label for="form_title">Title:</label>

                                        <input type="text" class="form-control" id="form_title" placeholder="Title" 
                                        name="form_title" minlength="10" maxlength="255" 
                                        onkeypress="validateInput('form_title', '10')" required>

                                    </div>


                                    <!-- Author input changed -->

                                    <!-- Name -->
                                    
                                    <!------------------------------------
                                    -    I'll add script for add author  -
                                    -                        by Webster  -
                                    ------------------------------------->
                                    <!-- label moved -->
                                    <label for="form_author1_fname">Author:&ThickSpace;<button type="button" class="btn btn-outline-primary" onclick="addAuthor()">+</button></label>
                                    <div class="form-row" id="author1">
                                        
                                        <!-- Forename field -->

                                        <div class="form-group col-sm-5 needs-validation"> 

                                            <input type="text"
                                                    class="form-control"
                                                    id="form_author1_fname"
                                                    placeholder="Forename"
                                                    name="form_author1_fname"
                                                    minlength="2"
                                                    maxlength="30"
                                                    required>                    


                                        </div>

                                        <!-- Middle initial field -->

                                        <div class="form-group col-sm-2 needs-validation">
                                            <!-- label removed -->
                                            <input type="text"
                                                    name="form_author1_mi"
                                                    id="form_author1_mi"
                                                    placeholder="M.I."
                                                    class="form-control"
                                                    maxlength="5">

                                        </div>

                                        <!-- Surname field -->

                                        <div class="form-group col-sm-5 needs-validation">

                                            <!-- label removed -->
                                            <input type="text"
                                                    name="form_author1_sname"
                                                    id="form_author1_sname"
                                                    placeholder="Surname"
                                                    class="form-control"
                                                    maxlength="30"
                                                    minlength="1"
                                                    required>
                                        </div>

                                    </div>
                                    
                                
                                    <!-- Adviser input changed -->

                                    <!-- Adviser Name -->
                                    <!-- label moved -->
                                    <label for="form_adviser_fname">Adviser:</label>
                                    <div class="form-row">
                                        
                                        <!-- Forename field -->

                                        <div class="form-group col-sm-5 needs-validation">
                                        
                                            <input type="text"
                                                    class="form-control"
                                                    id="form_adviser_fname"
                                                    placeholder="Forename"
                                                    name="form_adviser_fname"
                                                    minlength="2"
                                                    maxlength="30"
                                                    required>                    


                                        </div>

                                        <!-- Middle initial field -->

                                        <div class="form-group col-sm-2 needs-validation">
                                        <!-- label removed -->
                                            <input type="text"
                                                    name="form_adviser_mi"
                                                    id="form_adviser_mi"
                                                    placeholder="M.I."
                                                    class="form-control"
                                                    maxlength="5">

                                        </div>

                                        <!-- Surname field -->

                                        <div class="form-group col-sm-5 needs-validation">
                                        <!-- label removed -->
                                            <input type="text"
                                                    name="form_adviser_sname"
                                                    id="form_adviser_sname"
                                                    placeholder="Surname"
                                                    class="form-control"
                                                    maxlength="30"
                                                    minlength="1"
                                                    required>
                                        </div>

                                    </div>


                                    <!-- Year level field -->

                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="form_year">Year:</label>

                                            <select name="form_year" id="form_year" class="form-control
                                                    select-picker
                                                    border-muted" onchange="validateInput('form_year', '')" required>

                                                <option value="">Choose year</option>
                                                <?php for ($year=2000; $year <= 2030; $year++) { 
                                                echo '<option value="1st year">'.$year.'</option>';
                                                } ?>
                                            </select>


                                        </div>


                                        <!-- Course field -->


                                        <div class="form-group col">
                                            <label for="form_course">Course:</label>

                                            <select name="form_course" id="form_course" class="form-control
                                                        select-picker
                                                        border-muted" onchange="validateInput('form_course', '')" required>

                                                <option value="">Choose course</option>
                                                <option value="bsit">BSIT</option>
                                                <option value="educ">EDUC</option>
                                                <option value="bm">BM</option>
                                            </select>

                                        </div>
                                    </div>


                                    <!-- Keywords field -->
                                    <div class="form-group">

                                        <label for="form_keywords">Keywords:</label><br>
                                        <input type="text" name="basic" id="form_keywords" class="form-control tagify" 
                                        onkeypress="validateInput('form_keywords', '3')" required>


                                        <script data-name="basic" src="../js/tagsinput.js"></script>
                                    </div>



                                    <!-- Abstract field -->

                                    <div class="form-group mb-3">
                                        <label for="form_abstract">Abstract:</label>
                                        <textarea name="form_abstract" id="form_abstract" placeholder="Abstract" 
                                        class="form-control" style="min-height: 80px; max-height: 160px;" 
                                        onkeypress="validateInput('form_abstract', '10')" rows="5" minlength="10" 
                                        required></textarea>
                                    </div>

                                    <!-- File -->

                                    <div class="custom-file form-group">
                                        <label class="mb-4" for="form_file">File:</label>

                                        <input type="file" name="form_file" id="form_file" 
                                        class="custom-file-input form-control mt-5" accept="application/pdf" required>
                                        <label for="form_file" class="custom-file-label mt-4">Choose file...</label>


                                        <!-- Script for adding the name of file to the label -->

                                        <script>
                                            $('#form_file').on('change', function(e) {
                                                // Get file name
                                                var fileName = e.target.files[0].name;

                                                // Replace the "Choose file..." label
                                                $(this).next('.custom-file-label').html(fileName);

                                            });
                                        </script>
                                    </div>



                                    <button type="button" onclick="uploadVal();" 
                                    class="btn btn-outline-primary float-right">Submit</button>


                                </form>

                            </div>


                            <!-- modal header -->
                        </div>

                        <!-- modal dialog -->
                    </div>

                    <!-- modal -->
                </div>




                <!-- Research study upload tab -->
            </div>



            <!-- Research study list tab -->
            <div id="researchStudyList" class="container-fluid tab-pane fade">

                <!-- Search bar -->
                <div class="bg-muted
                            border border-primary
                            border-left-0
                            border-right-0">

                        <div class="input-group d-flex justify-content-center">

                            <div class="input-group-prepend py-4 w-100 mw-40rem">

                                    <button id="research-search-button" onclick="researchBtn()" 
                                            class="btn btn-outline-primary sm-btn-font-size">Search</button>

                                    <input type="hidden" name="page" value="<?php echo 1 ?>">

                                    <input id="rs-input" name="query" 
                                            class="form-control" type="text" autocomplete="off" required>

                                    <button type="reset" class="btn btn-default fa fa-remove">
                            </div>

                        </div>
                </div>

                <!-- Main content -->
            <div id="research-content">
                <!-- contents was on research_pagination.php -->
                
            </div>
                <!-- End of Main content -->

                <!-- Research study list tab -->
            </div>

            <!-- Alumni tab added -->

            <!-- Alumni tab -->
            <div id="alumni" class="tab-pane fade"><br>

                <!-- Search bar -->
                <div class="bg-muted
                            border border-primary
                            border-left-0
                            border-right-0">
                    <form action="research_coodinator_page.php" method="get" autocomplete="off">

                        <div class="input-group d-flex justify-content-center">

                            <div class="input-group-prepend py-4 w-100 mw-40rem">
                                <form action="#">

                                    <button class="btn btn-outline-primary sm-btn-font-size" type="submit">Search</button>
                                    <input type="hidden">

                                    <input required id="search-input" name="query" class="form-control" type="text">
                                    <button type="reset" class="btn btn-default fa fa-remove">
                                </form>
                            </div>

                        </div>
                    </form>
                </div>
                <div id="updateStatus">
                <!-- Main content student -->
                <div class="row mt-3">
                    <!-- Select sql for student -->
                    <?php
                    $sql_student = "SELECT * 
                    FROM student_table 
                    WHERE student_account_status = 'pending'
                    ORDER BY student_lname ASC
                    LIMIT $start, $limit";
                    $result_student = $conn->query($sql_student);
                    //this sql is for getting the number of results
                    $sql_count_student = " SELECT * 
                    from student_table 
                    where student_account_status = 'pending'";
                    $count_result_student = mysqli_query($conn, $sql_count_student);
                    $number_pages_student = ceil(mysqli_num_rows($count_result_student) / $limit);

                    ?>
                    <!-- first column -->
                        <div class="col-sm-3 sm-hide">

                            <p><?php if (mysqli_num_rows($result_student) > 0) { 
                            echo mysqli_num_rows($result_student);
                            } else {
                                echo '0';
                            } ?> Results</p>
                            <hr>

                            <!-- Account Status -->
                            <label>Account Status:</label>
                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle 
                                        mw-btn-150p" id="alumniAccountStatus" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('alumniAccountStatus', 'Pending')">Pending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('alumniAccountStatus', 'Verified')">Verified</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('alumniAccountStatus', 'Denied')">Denied</a>

                                </div>


                            </div>


                            <br>

                            <!-- Sort name -->
                        <?php if(mysqli_num_rows($result_student) !== 0){ ?>
                            <label class="mt-2 mb-2">Sort Name:</label>


                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="alumniSort" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('alumniSort', 'Ascending')">Ascending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('alumniSort', 'Descending')">Descending</a>

                                </div>

                            </div>

                            <br>

                            <!-- Filter Course -->
                            <label>Filter Course:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>


                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#bm">BM</label>

                        <?php }else { echo ''; } ?>


                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">
                        <?php
                        if (mysqli_num_rows($result_student) > 0) { ?>
                            <p>Alumni Pending...</p>
                            <hr>

                        <?php while ($row_student = mysqli_fetch_array($result_student)) { ?>

                        

                                <!-- alumni account starts here -->
                                <!-- Margin top added and col set to 5 -->
                                <div class="row mt-3" id="border-bg">

                                    <!-- Delete button added -->

                                    <!-- col changed -->
                                    <div class="col-sm-8">

                                        <button type="button" class="fa fa-trash btn btn-danger ml-0 mb-2" data-toggle="tooltip" title="Delete"></button>

                                        <p>Name: <?php echo $row_student['student_lname']; ?>,
                                            <?php echo $row_student['student_fname'];  ?> 
                                            <?php echo $row_student['student_mi'] ?></p>
                                        <p>CYS: <?php echo $row_student['student_course']; ?></p>
                                        <p>Address: <?php echo $row_student['student_address'] ?></p>


                                    </div>

                                    <div class="col-sm-3">
                                        <!-- Display this for pending section -->

                                        <button onclick="denyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button onclick="verifyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


                                        <!-- display this for verified section -->
                                        <!--
                                        <div class="alert alert-info">
                                            <strong>Verified!</strong>
                                        </div>
                                        -->
                                        <!-- Display this for denied section -->
                                        <!--

                                        <div class="alert alert-danger">
                                            <strong>Denied!</strong>
                                        </div>

                                        -->
                                        <!-- ********************************* -->
                                        <!--  Remove the two <br> tags below   -->
                                        <!-- when pending section isn't in use -->
                                        <!-- ********************************* -->

                                        <br>
                                        <br>

                                        <!-- Identification card link modified -->
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="fa fa-id-card" data-target="#identification_card_<?php echo $row_student['student_id']; ?>" data-toggle="modal"> See identification card</a>
                                        </div>

                                        <!-- modal -->
                                        <div class="modal fade" id="identification_card_<?php echo $row_student['student_id']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- modal header -->
                                                    <div class="modal-header">
                                                        <button class="close fa fa-close" data-dismiss="modal"></button>
                                                    </div>

                                                    <div id="id_content_<?php echo $row_student['student_id']; ?>" class="carousel slide">

                                                        <!-- indicators -->
                                                        <ul class="carousel-indicators">
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="1"></li>
                                                        </ul>

                                                        <!-- slideshow -->
                                                        <div class="carousel-inner">

                                                            <div class="carousel-item active">

                                                                <?php
                                                                $sname = $row_student['student_lname'];
                                                                $fname =  $row_student['student_fname'];
                                                                $mi = $row_student['student_mi'];
                                                                $fullname = $sname . ' ' . $fname . ' ' . $mi . ' '; ?>
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?><?php echo $row_student['student_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?>/<?php echo $row_student['student_id_back']; ?>" alt="identification card back" width="500" height="500">
                                                            </div>


                                                        </div>

                                                        <!-- left and right controls -->
                                                        <a class="carousel-control-prev" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="prev">
                                                            <span class="fa fa-chevron-left" style="color: #000000"></span>
                                                        </a>

                                                        <a class="carousel-control-next" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="next">
                                                            <span class="fa fa-chevron-right" style="color: #000000"></span>
                                                        </a>

                                                    </div>

                                                    <!-- footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>





                                    <!-- alumni account ends here -->
                                </div>

                        <?php }
                        }else{
                            echo "No Results Found";
                        }
                            
                        ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $number_pages_student; $i++) { ?>
                                  <li <?php if($page == $i){?>class="page-item active" <?php } ?>>
                                    <a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <?php if (($i-1) > $page) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php=<?php echo ($page + 1) ?>">Next</a></li>
                                <?php } ?>
                            </ul>

                        </div>


                        <!-- second column -->
                    </div>



                <!-- row -->
                </div>
                <!-- End of main content student -->
                </div>

                <!-- End alumni tab -->
            </div>

            <!-- Student tab -->
            <div id="student" class="tab-pane fade"><br>

                <!-- Search bar -->
                <div class="bg-muted
                border border-primary
                    border-left-0
                    border-right-0">
                    <form action="research_coodinator_page.php" method="get" autocomplete="off">

                        <div class="input-group d-flex justify-content-center">

                            <div class="input-group-prepend py-4 w-100 mw-40rem">
                                <form action="#">

                                    <button class="btn btn-outline-primary sm-btn-font-size" type="submit">Search</button>
                                    <input type="hidden">

                                    <input required id="search-input" name="query" class="form-control" type="text">
                                    <button type="reset" class="btn btn-default fa fa-remove">
                                </form>
                            </div>

                        </div>
                    </form>
                </div>
                <div id="updateStatus">
                <!-- Main content student -->
                <div class="row mt-3">
                    <!-- Select sql for student -->
                    <?php
                    $sql_student = "SELECT * 
                    FROM student_table 
                    WHERE student_account_status = 'pending'
                    ORDER BY student_lname ASC
                    LIMIT $start, $limit";
                    $result_student = $conn->query($sql_student);
                    //this sql is for getting the number of results
                    $sql_count_student = " SELECT * 
                    from student_table 
                    where student_account_status = 'pending'";
                    $count_result_student = mysqli_query($conn, $sql_count_student);
                    $number_pages_student = ceil(mysqli_num_rows($count_result_student) / $limit);

                    ?>
                    <!-- first column -->
                        <div class="col-sm-3 sm-hide">

                            <p><?php if (mysqli_num_rows($result_student) > 0) { 
                            echo mysqli_num_rows($result_student);
                            } else {
                                echo '0';
                            } ?> Results</p>
                            <hr>

                            <!-- Account Status -->
                            <label>Account Status:</label>
                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle 
                                        mw-btn-150p" id="studentAccountStatus" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Pending')">Pending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Verified')">Verified</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentAccountStatus', 'Denied')">Denied</a>

                                </div>


                            </div>


                            <br>

                            <!-- Sort name -->
                        <?php if(mysqli_num_rows($result_student) !== 0){ ?>
                            <label class="mt-2 mb-2">Sort Name:</label>


                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="studentSort" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentSort', 'Ascending')">Ascending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('studentSort', 'Descending')">Descending</a>

                                </div>

                            </div>

                            <br>

                            <!-- Filter Course -->
                            <label>Filter Course:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>

                            <!-- BM added -->
                            <br>
                            <input type="checkbox" id="bm">
                            <label for="#bm">BM</label>

                        <?php }else { echo ''; } ?>


                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">
                        <?php
                        if (mysqli_num_rows($result_student) > 0) { ?>
                            <p>Student Pending...</p>
                            <hr>

                        <?php while ($row_student = mysqli_fetch_array($result_student)) { ?>

                        

                        <!-- student account starts here -->
                                <!-- Margin top added and col set to 5 -->
                                <div class="row mt-3" id="border-bg">
                                    
                                    <!-- Delete button and move student to alumni added -->
                                    
                                    <!-- col changed -->
                                    <div class="col-sm-8">
                                        <div class="row ml-0 mb-2">
                                            <button type="button" class="fa fa-trash btn btn-danger" data-toggle="tooltip" title="Delete"></button>
                                            <span>&ThickSpace;</span>
                                            <button type="button" class="fa fa-graduation-cap btn btn-warning" data-toggle="tooltip" title="Move student to alumni"></button>
                                        </div>
                                        
                                        <p>Name: <?php echo $row_student['student_lname']; ?>,
                                            <?php echo $row_student['student_fname'];  ?> 
                                            <?php echo $row_student['student_mi'] ?></p>
                                        <p>CYS: <?php echo $row_student['student_course']; ?></p>
                                        <p>Address: <?php echo $row_student['student_address'] ?></p>


                                    </div>

                                    <!-- col changed -->
                                    <div class="col-sm-3">
                                        <!-- Display this for pending section -->

                                        <button onclick="denyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button onclick="verifyStudent(<?php echo $row_student['student_id']; ?>)" 
                                        class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


                                        <!-- display this for verified section -->
                                        <!--
                                        <div class="alert alert-info">
                                            <strong>Verified!</strong>
                                        </div>
                                         -->
                                        <!-- Display this for denied section -->
                                        <!--

                                        <div class="alert alert-danger">
                                            <strong>Denied!</strong>
                                        </div>

                                        -->
                                        <!-- ********************************* -->
                                        <!--  Remove the two <br> tags below   -->
                                        <!-- when pending section isn't in use -->
                                        <!-- ********************************* -->

                                        <br>
                                        <br>

                                        <!-- Identification card link modified -->
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="fa fa-id-card" data-target="#identification_card_<?php echo $row_student['student_id']; ?>" data-toggle="modal"> See identification card</a>
                                        </div>

                                        <!-- modal -->
                                        <div class="modal fade" id="identification_card_<?php echo $row_student['student_id']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- modal header -->
                                                    <div class="modal-header">
                                                        <button class="close fa fa-close" data-dismiss="modal"></button>
                                                    </div>

                                                    <div id="id_content_<?php echo $row_student['student_id']; ?>" class="carousel slide">

                                                        <!-- indicators -->
                                                        <ul class="carousel-indicators">
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="id_content_<?php echo $row_student['student_id']; ?>" data-slide-to="1"></li>
                                                        </ul>

                                                        <!-- slideshow -->
                                                        <div class="carousel-inner">

                                                            <div class="carousel-item active">

                                                                <?php
                                                                $sname = $row_student['student_lname'];
                                                                $fname =  $row_student['student_fname'];
                                                                $mi = $row_student['student_mi'];
                                                                $fullname = $sname . ' ' . $fname . ' ' . $mi . ' '; ?>
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?><?php echo $row_student['student_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img class="mw-100 mh-100" src="../Student_ID/<?php echo str_replace(' ', '_', $fullname.'/'); ?>/<?php echo $row_student['student_id_back']; ?>" alt="identification card back" width="500" height="500">
                                                            </div>


                                                        </div>

                                                        <!-- left and right controls -->
                                                        <a class="carousel-control-prev" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="prev">
                                                            <span class="fa fa-chevron-left" style="color: #000000"></span>
                                                        </a>

                                                        <a class="carousel-control-next" href="#id_content_<?php echo $row_student['student_id']; ?>" data-slide="next">
                                                            <span class="fa fa-chevron-right" style="color: #000000"></span>
                                                        </a>

                                                    </div>

                                                    <!-- footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>





                                    <!-- student account ends here -->
                                </div>

                        <?php }
                        }else{
                            echo "No Results Found";
                        }
                            
                        ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $number_pages_student; $i++) { ?>
                                  <li <?php if($page == $i){?>class="page-item active" <?php } ?>>
                                    <a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <?php if (($i-1) > $page) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php=<?php echo ($page + 1) ?>">Next</a></li>
                                <?php } ?>
                            </ul>

                        </div>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>
                <!-- End of main content student -->
                </div>

                <!-- End student tab -->
            </div>



            <!-- Professor tab -->
            <div id="professor" class="tab-pane fade"><br>

                <!-- Search bar -->
                <div class="bg-muted
                border border-primary
                    border-left-0
                    border-right-0">
                    <form action="research_coodinator_page.php" method="get" autocomplete="off">

                        <div class="input-group d-flex justify-content-center">

                            <div class="input-group-prepend py-4 w-100 mw-40rem">
                                <form action="#">

                                    <button class="btn btn-outline-primary sm-btn-font-size" type="submit">Search</button>
                                    <input type="hidden">

                                    <input required id="search-input" name="query" class="form-control" type="text">
                                    <button type="reset" class="btn btn-default fa fa-remove">
                                </form>
                            </div>

                        </div>
                    </form>
                </div>

            <div id="updateStatusProfessor">
                <div class="row mt-3">
                    <?php
                    $sql_professor = "SELECT * 
                    FROM professor_table
                    WHERE professor_account_status = 'pending'
                    ORDER BY professor_lname ASC
                    LIMIT $start, $limit";
                    $result_professor = $conn->query($sql_professor);
                    //this sql is for getting the number of results
                    $sql_count_professor = " SELECT * 
                    from professor_table 
                    where professor_account_status = 'pending'";
                    $count_result_professor = mysqli_query($conn, $sql_count_professor);
                    $number_pages_professor = ceil(mysqli_num_rows($count_result_professor) / $limit);
                    ?>

                    <!-- first column -->
                        <div class="col-sm-3 sm-hide">

                            <p><?php if (mysqli_num_rows($result_professor) > 0) {
                                    echo mysqli_num_rows($result_professor);
                                } else { 
                                    echo '0';
                                } ?> Results</p>
                            <hr>

                            <!-- Account Status -->

                            <label>Account Status:</label>
                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle 
                                        mw-btn-150p" id="professorAccountStatus" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Pending')">Pending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Verified')">Verified</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorAccountStatus', 'Denied')">Denied</a>

                                </div>


                            </div>


                            <br>

                            <!-- Sort name -->
                        <?php if(mysqli_num_rows($result_professor) !== 0){ ?>
                            <label class="mt-2 mb-2">Sort Name:</label>


                            <div class="dropdown dropright">
                                <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="professorSort" data-toggle="dropdown">Select</button>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorSort', 'Ascending')">Ascending</a>

                                    <a class="dropdown-item" href="#" onclick="changeBtnTxt('professorSort', 'Descending')">Descending</a>

                                </div>

                            </div>

                            <br>

                            <!-- Filter Department -->
                            <label>Filter Department:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">IIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>

                            <br>
                            <input type="checkbox" id="bm">
                            <label for="#bm">BM</label>
                        <?php } ?>



                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">

                        

                        <!-- professor account starts here -->
                        <?php
                        if (mysqli_num_rows($result_professor) > 0) { ?>
                            <!-- output data of each row -->

                        <p>Professor Pending...</p>
                        <hr>
                         <?php   while ($row_professor = mysqli_fetch_array($result_professor)) {
                        ?>
                                <!-- Margin top added and col set to 5 -->
                                <div class="row mt-3" id="border-bg">

                                    
                                    <!-- col changed -->
                                    <div class="col-sm-8">

                                        <button type="button" class="fa fa-trash btn btn-danger ml-0 mb-2" data-toggle="tooltip" title="Delete"></button>
                                        <p>Name: <?php echo $row_professor['professor_lname']; ?>, <?php echo $row_professor['professor_fname'] . ' ' . $row_professor['professor_mi']; ?></p>
                                        <p>Department: <?php echo $row_professor['professor_department']; ?></p>
                                        <p>Address: <?php echo $row_professor['professor_address'] ?>.</p>


                                    </div>

                                    <!-- col changed -->
                                    <div class="col-sm-3">
                                        <!-- Display this for pending section -->

                                        <button onclick="denyProfessor(<?php echo $row_professor['professor_id'] ?>)" class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button onclick="verifyProfessor(<?php echo $row_professor['professor_id'] ?>)" class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


                                        <!-- display this for verified section -->
                                        <!--
                                        <div class="alert alert-info">
                                            <strong>Verified!</strong>
                                        </div>
                                        -->
                                        <!-- Display this for denied section -->
                                        <!--

                                        <div class="alert alert-danger">
                                            <strong>Denied!</strong>
                                        </div>

                                        -->
                                        <!-- ********************************* -->
                                        <!--  Remove the two <br> tags below   -->
                                        <!-- when pending section isn't in use -->
                                        <!-- ********************************* -->

                                        <br>
                                        <br>

                                        
                                        <!-- Identification card link modified -->
                                        <div class="d-flex justify-content-center">
                                            <a href="#" class="fa fa-id-card" data-target="#identification_card_<?php echo $row_professor['professor_id']; ?>" data-toggle="modal"> See identification card</a>
                                        </div>


                                        <!-- modal -->
                                        <div class="modal fade" id="identification_card_<?php echo $row_professor['professor_id']; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- modal header -->
                                                    <div class="modal-header">
                                                        <button class="close fa fa-close" data-dismiss="modal"></button>
                                                    </div>

                                                    <div id="id_content_<?php echo $row_professor['professor_id']; ?>" class="carousel slide">

                                                        <!-- indicators -->
                                                        <ul class="carousel-indicators">
                                                            <li data-target="id_content_<?php echo $row_professor['professor_id']; ?>" data-slide-to="0" class="active"></li>
                                                            <li data-target="id_content_<?php echo $row_professor['professor_id']; ?>" data-slide-to="1"></li>
                                                        </ul>

                                                        <!-- slideshow -->
                                                        <div class="carousel-inner">

                                                            <div class="carousel-item active">
                                                                <?php
                                                                $sname = $row_professor['professor_lname'];
                                                                $fname =  $row_professor['professor_fname'];
                                                                $mi = $row_professor['professor_mi'];
                                                                $fullname = $sname . ' ' . $fname . ' ' . $mi . ' '; ?>
                                                                <img class="mw-100 mh-100" src="../Professor_ID/<?php echo str_replace(' ', '_', $fullname); ?>/<?php echo $row_professor['professor_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img class="mw-100 mh-100" src="../Professor_ID/<?php echo str_replace(' ', '_', $fullname); ?>/<?php echo $row_professor['professor_id_back']; ?>" alt="identification card back" width="500" height="500">
                                                            </div>


                                                        </div>

                                                        <!-- left and right controls -->
                                                        <a class="carousel-control-prev" href="#id_content_<?php echo $row_professor['professor_id']; ?>" data-slide="prev">
                                                            <span class="fa fa-chevron-left" style="color: #000000"></span>
                                                        </a>

                                                        <a class="carousel-control-next" href="#id_content_<?php echo $row_professor['professor_id']; ?>" data-slide="next">
                                                            <span class="fa fa-chevron-right" style="color: #000000"></span>
                                                        </a>

                                                    </div>

                                                    <!-- footer -->
                                                    <div class="modal-footer">
                                                        <button class="btn btn-outline-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>





                                    <!-- professor account ends here -->
                                </div>
                        <?php }
                        }else {
                            echo "No Results Found";
                        } ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $number_pages_professor; $i++) { ?>
                                  <li <?php if($page == $i){?>class="page-item active" <?php } ?>>
                                    <a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <?php if (($i-1) > $page) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php=<?php echo ($page + 1) ?>">Next</a></li>
                                <?php } ?>
                            </ul>

                        </div>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>
            </div>

                <!-- Professor tab -->
            </div>



            <!-- Admin tab -->
            <div id="admin" class="tab-pane fade"><br>

                <!-- Search bar -->
                <div class="bg-muted
                border border-primary
                    border-left-0
                    border-right-0">
                    <form action="research_coodinator_page.php" method="get" autocomplete="off">

                        <div class="input-group d-flex justify-content-center">

                            <div class="input-group-prepend py-4 w-100 mw-40rem">
                                <form action="#">

                                    <button class="btn btn-outline-primary sm-btn-font-size" type="submit">Search</button>
                                    <input type="hidden">

                                    <input required id="search-input" name="query" class="form-control" type="text">
                                    <button type="reset" class="btn btn-default fa fa-remove">
                                </form>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="row mt-3">

                    <?php
                    $sql_admin = "SELECT * 
                    FROM admin_table
                    ORDER BY admin_lname ASC
                    LIMIT $start, $limit";
                    $result_admin = $conn->query($sql_admin);
                    //this sql is for getting the number of results
                    $sql_count_admin = " SELECT * 
                    from admin_table";
                    $count_result_admin = mysqli_query($conn, $sql_count_admin);
                    $number_pages_admin = ceil(mysqli_num_rows($count_result_admin) / $limit);
                    ?>

                    <!-- first column -->
                    <div class="col-sm-3 sm-hide">

                        <p id="admin_results"><?php if (mysqli_num_rows($count_result_admin) > 0) {
                            echo mysqli_num_rows($count_result_admin);
                        }else {
                            echo '0';
                        } ?> Results</p>
                        <hr>
                    <?php if(mysqli_num_rows($result_admin) !== 0){ ?>
                        <!-- Sort name -->

                        <label class="mb-2">Sort Name:</label>


                        <div class="dropdown dropright">
                            <button class="btn btn-outline-secondary dropdown-toggle
                                        mw-btn-150p" id="adminSort" data-toggle="dropdown">Select</button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="changeBtnTxt('adminSort', 'Ascending')">Ascending</a>

                                <a class="dropdown-item" href="#" onclick="changeBtnTxt('adminSort', 'Descending')">Descending</a>

                            </div>

                        </div>

                        <br>
                    <?php } ?>

                        <!-- Create account -->
                        <label class="mr-2">Create account:</label>
                        <br>
                        <button data-target="#createAdmin_mc" data-toggle="modal" class="btn btn-outline-primary">+ Append</button>

                        <!-- Modal for creating admin account -->
                        <div class="modal fade" id="createAdmin_mc">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- modal header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title header-font">Creating admin...</h5>
                                        <button class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- modal body -->
                                    <div class="modal-body">

                                        <form id="register_form" method="post" class="needs-validation
                                                p-4 mx-auto mb-3">

                                            <!-- Name -->
                                            <div class="form-row">

                                                <!-- Forename field -->

                                                <div class="form-group col-sm-5 needs-validation">
                                                    <label for="form_fname_admin">Forename:</label>

                                                    <input type="text" class="form-control" id="form_fname_admin" placeholder="Forename" name="form_fname_admin" minlength="2" maxlength="30" required>


                                                </div>

                                                <!-- Middle initial field -->

                                                <div class="form-group col-sm-2 needs-validation">
                                                    <label for="form_mi_admin">M.I.:</label>
                                                    <input type="text" name="form_mi_admin" id="form_mi_admin" placeholder="M.I." class="form-control" maxlength="5">

                                                </div>

                                                <!-- Surname field -->

                                                <div class="form-group col-sm-5 needs-validation">

                                                    <label for="form_sname_admin">Surname:</label>
                                                    <input type="text" name="form_sname_admin" id="form_sname_admin" placeholder="Surname" class="form-control" maxlength="30" minlength="1" required>
                                                </div>

                                            </div>

                                            <!-- Username field -->

                                            <div class="form-group">
                                                <label for="form_fname_admin">Username:</label>

                                                <input type="text" class="form-control" id="form_uname_admin" placeholder="Username" name="form_uname_admin" minlength="2" maxlength="30" required>

                                            </div>

                                            <!-- Password field -->


                                            <div class="form-group mt-2">
                                                <label for="form_pass_admin">Passsword:</label>
                                                <input type="password" name="form_pass_admin" id="form_pass_admin" placeholder="Password" class="form-control" maxlength="30" minlength="8" required>

                                            </div>

                                            <!-- Retype Password field -->


                                            <div class="form-group mt-2">
                                                <label for="form_repass_admin">Retype Passsword:</label>
                                                <input type="password" name="form_repass_admin" id="form_repass_admin" placeholder="Retype Password" class="form-control" maxlength="30" minlength="8" required>

                                            </div>

                                            <!-- Register btn -->
                                            <div class="col d-flex justify-content-end">
                                                <button onclick="createAdmin();" type="button" class="btn btn-primary">Create</button>
                                            </div>



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

                        <!-- first column -->
                    </div>

                    <!-- second column -->
                    <div class="col">

                        
                    <div id="admin_accounts">
                        <!-- admin account starts here -->
                        <?php
                        if (mysqli_num_rows($result_admin) > 0) { ?>
                        <p>Admin account list...</p>
                        <hr>
                             <!-- output data of each row -->
                            <?php while ($row_admin = mysqli_fetch_array($result_admin)) {
                        ?>

                        <!-- You forgot to add the margin -->
                        <div class="row mt-3" id="border-bg">
                        <!-- col change -->
                            <div class="col-sm-8">
                                <!-- Remove button added -->
                                <button type="button" class="fa fa-trash btn btn-danger ml-0 mb-2" data-toggle="tooltip" title="Delete"></button>

                                <p>Name: <?php echo $row_admin['admin_lname']; ?>, <?php echo $row_admin['admin_fname'].' '.$row_admin['admin_mi']; ?></p>
                                <p>Username: <?php echo $row_admin['admin_username']; ?></p>
                                
                            </div>



                            <!-- admin account ends here -->
                        </div>
                        <?php }
                        } ?>
                    </div>


                        <!-- Pagination -->

                        <div id="admin_page" class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i <= $number_pages_admin; $i++) { ?>
                                  <li <?php if($page == $i){?>class="page-item active" <?php } ?>>
                                    <a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <?php if (($i-1) > $page) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php=<?php echo ($page + 1) ?>">Next</a></li>
                                <?php } ?>
                            </ul>

                        </div>


                        <!-- second column -->
                    </div>



                    <!-- row -->
                </div>

                <!-- Admin tab -->
            </div>


            <!-- tab panes tab content -->
        </div>

        <!-- contains nav-tab and tab-content -->
    </div>


    <!-- Footer -->
    <div id="mt-20rem">
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
    </div>

    <!-- Form validation -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="../js/rs_upload_page.js"></script>
    <script src="../js/researchCoordinator_script.js"></script>
    <script src="../js/admin_research_search.js"></script>
    <script src="../js/addCount.js"></script>
    <script src="../js/verifyAccount.js"></script>
    <script src="../js/registration_admin_script.js"></script>
    <script src="../js/login.js"></script>
    <script src="../js/readAbstract_function.js"></script>
    <script src="../js/pagination.js"></script>
    <script src="../js/needToLogin.js"></script>
</body>

</html>
