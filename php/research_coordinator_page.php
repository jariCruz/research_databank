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
               
                    <!-- Remove links -->

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


        <h4 class="header-font text-right">Welcome Webster!</h4>


    </div>

    <!-- contains nav-tab and tab-content -->
    <div class="container-fluid">
        <div class="pt-3">

            <!-- Nav tabs -->
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
                            <div class="modal-title">

                                <div class="modal-header">
                                    <div class="modal-title header-font">Coordinator is uploading thesis...</div>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

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
                                        name="form_title" minlength="10" maxlength="100" 
                                        onkeypress="validateInput('form_title', '10')" required>

                                    </div>


                                    <!-- Author field -->

                                    <div class="form-group">
                                        <label for="form_author">Author:</label>
                                        <input type="text" name="form_author" id="form_author" placeholder="Author" 
                                        class="form-control" minlength="5" maxlength="100" 
                                        onkeypress="validateInput('form_author', '5')" required>

                                    </div>

                                    <!-- Adviser field -->

                                    <div class="form-group">

                                        <label for="form_adviser">Adviser:</label>
                                        <input type="text" name="form_adviser" id="form_adviser" placeholder="Adviser" 
                                        class="form-control" maxlength="60" minlength="5" 
                                        onkeypress="validateInput('form_adviser', '5')" required>

                                    </div>


                                    <!-- Year level field -->

                                    <div class="row">
                                        <div class="form-group col">
                                            <label for="form_year">Year level:</label>

                                            <select name="form_year" id="form_year" class="form-control
                                                    select-picker
                                                    border-muted" onchange="validateInput('form_year', '')" required>

                                                <option value="">Choose year level</option>
                                                <option value="1st year">1st year</option>
                                                <option value="2nd year">2nd year</option>
                                                <option value="3rd year">3rd year</option>
                                                <option value="4th year">4th year</option>
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
                                        class="form-control min-height max-height" 
                                        onkeypress="validateInput('form_abstract', '10')" rows="5" minlength="10" 
                                        maxlength="500" required></textarea>
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

                <?php
                //this sql naman ay para ipakita ang nilalaman ng nakalimit
                $sql = "SELECT * 
                FROM researchstudy_table  
                ORDER BY Title ASC";

                //this sql is for getting the number of results
                $sql_count = " SELECT * from researchstudy_table ";
                $result = mysqli_query($conn, $sql);
                $count_result = mysqli_query($conn, $sql_count);
                $number_pages = ceil(mysqli_num_rows($count_result) / $limit);
                ?>

                <!-- Main content -->
                <div id="research-livesearch">
                <div class="row">

                    <!-- first column -->
                    <div class="col-sm-3 pl-4 pt-4 sm-hide">

                        <p><?php if (mysqli_num_rows($count_result) > 0) {
                                echo mysqli_num_rows($count_result);
                            } else {
                                echo '0';
                            } ?> Results</p><!-- results count -->
                        <hr>

                        <?php
                        if (mysqli_num_rows($count_result) === 0) {
                            echo '';
                        } else { ?>
                            <!-- Filter Department -->
                                <label>Filter Department:</label>

                                <br>
                                <div class="ml-3">
                                    <input type="checkbox" id="title">
                                    <label for="#title">Title</label>

                                    <br>

                                    <input type="checkbox" id="keyword">
                                    <label for="#keyword">Keyword</label>

                                    <br>

                                    <input type="checkbox" id="abstract">
                                    <label for="#abstract">Abstract</label>

                                    <br>
                                    
                                    <input type="checkbox" id="content">
                                    <label for="#content">Content</label>
                                </div>
                        <?php } ?>

                        <!-- first column -->
                    </div>


                    <!-- Content -->
                    <div class="col">

                        <div class="d-flex align-items-center justify-content-center pt-2 sm-hide">


                            <!-- Use the 'active class' to change the btn color -->
                            <?php if (mysqli_num_rows($count_result) > 0) { ?>
                                <div class="btn-group text-dark">

                                    <button class="btn btn-outline-dark sm-research-fs active">Most relevant</button>

                                    <button class="btn btn-outline-dark sm-research-fs">Most reads</button>

                                    <button class="btn btn-outline-dark sm-research-fs">Most downloads</button>
                                </div>
                            <?php } else {
                                echo '';
                            } ?>

                        </div>

                        <!-- 0 Margin bottom added -->
                        <hr class="mb-0">

                        <!-- Here is the whole research study
                        This part includes the research study details
                            (titles, authors, abstract, view pdf, download file,
                            and statistics for reads and downloads)-->
                        <!-- tab added -->
                        <div id="research-livesearch1">
                                            <?php
                            if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                            ?>

                                <!------------------------
                                    Negative margin top removed
                                -------------------------->
                                <div class="cards hBg border border-left-0 border-right-0 border-top-0 border-semilightblue">

                                <div class="card-body">


                                    <!-- Research studies information -->
                                    <div class="row">

                                    <!------------------------
                                        Column set to auto
                                    -------------------------->
                                    <div class="col">
                                        <h4 class="sm-body-font-size"><?php echo $row["Title"] ?></h4><!-- Research title -->

                                        <!-- Author name -->
                                        <a href="#" class="cLink"><?php echo $row["Author"] ?></a>

                                        <p><?php echo $row['Abstract'] ?></p>

                                        <!------------------------------- 
                                            Abstract contraction
                                            For read more and read less
                                        --------------------------------->
                                        <p>Lorem ipsum
                                        <span id="dots">...</span>
                                        <!-- id "readMore" is not working properly when 2 or more research study displays -->
                                        <!-- <span id="<php echo $row['RS_ID'];?>"> dolor sit amet</span> -->
                                        <span id="readMore"> dolor sit amet</span>
                                        <a href="#" onclick="readAbstract()" id="readBtn" class="cLink">Read more...</a>

                                        </p>

                                        <!-- Read more and less link function -->
                                        <script src="../js/readAbstract_function.js"></script>

                                        <!-- This might help
                                            Use HTML's anchors:

                                            Main Page:

                                            <a href="sample.html#sushi">Sushi</a>
                                            <a href="sample.html#bbq">BBQ</a>
                                            Sample Page:

                                            <div id='sushi'><a name='sushi'></a></div>
                                            <div id='bbq'><a name='bbq'></a></div> 
                                        -->

                                        <!-- Statistics for small media -->
                                        <p><small class="sm-show-stat">5 Views | 5 Downloads</small></p>


                                        <!-- show this when a user is logged in -->
                                        <?php if (isset($_SESSION['user_id'])) { ?>

                                        <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" 
                                            onclick="addDownload(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>')" 
                                            class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                                        <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" 
                                            onclick="addView(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>')" 
                                            class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->

                                        <?php } else { ?>

                                        <!-- show this when user isn't logged in -->

                                        <a id="view_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="needToLoginDownload()" class="fa fa-download btn btn-outline-primary sm-btn-font-size cLink"> Download</a><!-- Download button -->

                                        <a id="download_href_<?php echo $row['RS_ID'] ?>" type="button" onclick="needToLoginView()" class="fa fa-file btn btn-outline-primary sm-btn-font-size cLink"> View PDF</a><!-- View button -->

                                        <?php } ?>



                                        <!-- Modal -->
                                        <div class="modal fade" id="cModalContent_<?php echo $row['RS_ID']; ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-scrollable">

                                            <!-- Modal header -->
                                            <div class="modal-content">
                                            <div class="modal-title">

                                                <div class="modal-header">
                                                <div class="btn-group">
                                                    <!-- Download PDF (logged in)-->
                                                    <?php if (isset($_SESSION['user_id'])) { ?>
                                                    <button type="button" onclick="addDownload(<?php echo $row['RS_ID'] ?>,'download.php?file=<?php echo $row['File'] ?>')" class="btn btn-outline-dark fa fa-download sm-btn-font-size"> Download</button><!-- Download button -->

                                                    <!-- View PDF (logged in)-->
                                                    <button type="submit" onclick="addView(<?php echo $row['RS_ID'] ?>,'../Research_Studies/<?php echo $row['File'] ?>')" class="btn btn-outline-dark fa fa-file sm-btn-font-size"> View PDF</button><!-- View button -->
                                                    <?php } else { ?>
                                                    <!-- Download PDF -->
                                                    <button type="button" onclick="needToLoginDownload()" class="btn btn-outline-dark fa fa-download sm-btn-font-size"> Download</button><!-- Download button -->

                                                    <!-- View PDF -->
                                                    <button type="submit" onclick="needToLoginView()" class="btn btn-outline-dark fa fa-file sm-btn-font-size"> View PDF</button><!-- View button -->
                                                    <?php } ?>

                                                </div>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                            </div>

                                            <!-- Modal details -->

                                            <div class="modal-body">
                                                <!-- Make the title color black -->
                                                <!-- Make the hover color blue -->

                                                <div class="cfont cs-2"><?php echo $row['Title'] ?></div><!-- research title -->
                                                <br>
                                                <div><?php echo $row['Author'] ?></div><!-- author name -->

                                                <hr class="bg-muted">

                                                <p class="text-uppercase">Abstract</p>

                                                <p><?php echo $row['Abstract'] ?></p><!-- research abstract -->

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-danger sm-btn-font-size" data-dismiss="modal">Close</button>

                                            </div>




                                            </div>
                                        </div>
                                        </div>

                                        <!-- Mini tab for short details
                                            This <a> tag represent the button for the whole research study -->

                                        <a href="#cModalContent_<?php echo $row['RS_ID']; ?>" class="stretched-link" data-toggle="modal" data-backdrop="static"></a>
                                    </div>

                                    <!-- Statistics for large media -->

                                    <!-----------------------------
                                        Column changed to 2
                                    ------------------------------->
                                    <div class="col-2 sm-hide-stat">
                                        <div class=" pt-2 text-ash">
                                        <!-- Small tag added -->
                                        <p id="viewCounts_<?php echo $row['RS_ID'] ?>" class="text-center small"><small>
                                            <?php if ($row['Views'] === 0) { echo '0'; } else {  echo $row['Views'];} ?>
                                            <br>Readers</small></p><!-- count of views -->

                                        </div>
                                        

                                        <div class="pt-2 text-ash">
                                        <!---------------------
                                            Small tag added
                                        ----------------------->
                                        <p id="downloadCounts_<?php echo $row['RS_ID'] ?>" class="text-center small"><small>
                                            <?php if ($row['Downloads'] === 0) { echo '0'; } else { echo $row['Downloads'];} ?>
                                            <br>Downloads</small></p><!-- count of downloads -->
                                        </div>


                                    </div>

                                    </div> <!-- End of research studies information -->


                                </div>



                                </div>
                            <?php
                            }
                            } else {
                            echo "No Results Found";
                            } ?>
                        </div>

                        <!-- The whole research study details ends here -->


                        <!-- Pagination -->

                        <div class="container mt-3">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                    <li class="page-item"><a class="page-link" 
                                    	href="research_coodinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i < $number_pages; $i++) { ?>
                                    <li class="page-itemactive"><a class="page-link" 
                                    	href="research_coodinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                                <?php } ?>
                                <?php if ($i > $page) { ?>
                                    <li class="page-item"><a class="page-link" 
                                    	href="research_coodinator_page.php?page=<?php echo ($page + 1) ?>">Next</a></li>
                                <?php } ?>
                            </ul>

                        </div>

                        <!-- div for Content -->
                    </div>

                    <!-- div for row -->
                </div>
            </div>
                <!-- End of Main content -->

                <!-- Research study list tab -->
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
                    WHERE student_account_status = 'pending'";
                    $result_student = $conn->query($sql_student);
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
                            <?php if (mysqli_num_rows($result_student) === 0) {
                                echo '';
                            }else { ?>
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

                            <!-- Filter Department -->
                            <label>Filter Course:</label>

                            <br>
                            <input type="checkbox" id="bsit">
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>
                        <?php } ?>


                            <!-- first column -->
                        </div>

                    <!-- second column -->
                    <div class="col">
                        <?php
                        if (mysqli_num_rows($result_student) > 0) {
                            while ($row_student = mysqli_fetch_array($result_student)) { ?>

                        <p>Student Pending...</p>
                        <hr>

                        <!-- student account starts here -->
                                <div class="row" id="border-bg">
                                    <div class="col-sm-8">


                                        <p>Name: <?php echo $row_student['student_lname']; ?>,
                                            <?php echo $row_student['student_fname'];  ?> 
                                            <?php echo $row_student['student_mi'] ?></p>
                                        <!-- Contraction removed -->
                                        <p>Course, Year, and Section: <?php echo $row_student['student_course']; ?></p>
                                        <p>Address: <?php echo $row_student['student_address'] ?></p>


                                    </div>

                                    <div class="col-sm-4">
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

                                        <a href="#" data-target="#identification_card_<?php echo $row_student['student_id']; ?>" data-toggle="modal">See identification card <span class="fa fa-id-card"></span></a>

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
                                                                <img src="../Student_ID/<?php echo $row_student['student_lname'] . '_' . $row_student['student_fname'] . '_' . $row_student['student_mi'] . '_'; ?>/<?php echo $row_student['student_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img src="../Student_ID/<?php echo $row_student['student_lname'] . '_' . $row_student['student_fname'] . '_' . $row_student['student_mi'] . '_'; ?>/<?php echo $row_student['student_id_back']; ?>" alt="identification card back" width="500" height="500">
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
                            // hr removed
                            // also remove filter in the first column

                            echo "No Results Found";
                        }
                            
                        ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>

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

                <div class="row mt-3">
                    <?php
                    $sql_professor = "SELECT * FROM professor_table";
                    $result_professor = $conn->query($sql_professor);
                    //count professor accounts
                    $sql_professor_count = "SELECT COUNT(professor_id) AS professor_count FROM professor_table";
                    $result_professor_count = $conn->query($sql_professor_count);
                    $row_professor_count = $result_professor_count->fetch_assoc();
                    ?>

                    <!-- first column -->
                    <?php if ($result_student->num_rows > 0) { ?>
                        <div class="col-sm-3 sm-hide">

                            <p><?php if ($row_professor_count != 0) {
                                    echo $row_professor_count['professor_count'];
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
                            <label for="#bsit">BSIT</label>

                            <br>
                            <input type="checkbox" id="educ">
                            <label for="#educ">EDUC</label>



                            <!-- first column -->
                        </div>
                    <?php } else { ?>
                        <p>0 Results</p>
                    <?php } ?>

                    <!-- second column -->
                    <div class="col">

                        <p>Professor Pending...</p>
                        <hr>

                        <!-- professor account starts here -->
                        <?php
                        if ($result_professor->num_rows > 0) {
                            // output data of each row
                            while ($row_professor = $result_professor->fetch_assoc()) {
                        ?>
                                <div class="row" id="border-bg">
                                    <div class="col-sm-8">


                                        <p>Name: <?php echo $row_professor['professor_lname']; ?>, <?php echo $row_professor['professor_fname'] . ' ' . $row_professor['professor_mi']; ?></p>
                                        <p>Department: <?php echo $row_professor['professor_department']; ?></p>
                                        <p>Address: <?php echo $row_professor['professor_address'] ?>.</p>


                                    </div>

                                    <div class="col-sm-4">
                                        <!-- Display this for pending section -->

                                        <button class="btn btn-danger w-btn-acc sm-btn-font-size">Deny</button>
                                        <button class="btn btn-primary w-btn-acc sm-btn-font-size">Verify</button>


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

                                        <a href="#" data-target="#identification_card_<?php echo $row_professor['professor_id']; ?>" data-toggle="modal">See identification card <span class="fa fa-id-card"></span></a>

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
                                                                <img src="../Professor_ID/<?php echo $row_professor['professor_lname'] . '_' . $row_professor['professor_fname'] . '_' . $row_professor['professor_mi'] . '_'; ?>/<?php echo $row_professor['professor_id_front']; ?>" alt="identification card front" width="500" height="500">
                                                            </div>

                                                            <div class="carousel-item">
                                                                <img src="../Professor_ID/<?php echo $row_professor['professor_lname'] . '_' . $row_professor['professor_fname'] . '_' . $row_professor['professor_mi'] . '_'; ?>/<?php echo $row_professor['professor_id_back']; ?>" alt="identification card back" width="500" height="500">
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
                        } ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>

                            </ul>

                        </div>


                        <!-- second column -->
                    </div>



                    <!-- row -->
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
                    $sql_admin = "SELECT * FROM admin_table";
                    $result_admin = $conn->query($sql_admin);
                    //count admin accounts
                    $sql_admin_count = "SELECT COUNT(admin_id) AS admin_count FROM admin_table";
                    $result_admin_count = $conn->query($sql_admin_count);
                    $row_admin_count = $result_admin_count->fetch_assoc();
                    ?>

                    <!-- first column -->
                    <div class="col-sm-3 sm-hide">

                        <p><?php if ($row_admin_count['admin_count'] != 0) {
                            echo $row_admin_count['admin_count'];
                        }else {
                            echo '0';
                        } ?> Results</p>
                        <hr>
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

                        <!-- Create account -->
                        <label class="mr-2">Create account:</label>
                        <br>
                        <!-- Icon + added -->
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

                                        <form id="register_form" action="insert.php" method="post" class="needs-validation
                                                p-4 mx-auto mb-3">

                                            <!-- Name -->
                                            <div class="form-row">

                                                <!-- Forename field -->

                                                <div class="form-group col-sm-5 needs-validation">
                                                    <label for="form_fname">Forename:</label>

                                                    <input type="text" class="form-control" id="form_fname" placeholder="Forename" name="form_fname" minlength="2" maxlength="30" required>


                                                </div>

                                                <!-- Middle initial field -->

                                                <div class="form-group col-sm-2 needs-validation">
                                                    <label for="form_mi">M.I.:</label>
                                                    <input type="text" name="form_mi" id="form_mi" placeholder="M.I." class="form-control" maxlength="5">

                                                </div>

                                                <!-- Surname field -->

                                                <div class="form-group col-sm-5 needs-validation">

                                                    <label for="form_sname">Surname:</label>
                                                    <input type="text" name="form_sname" id="form_sname" placeholder="Surname" class="form-control" maxlength="30" minlength="1" required>
                                                </div>

                                            </div>

                                            <!-- Username field -->

                                            <div class="form-group">
                                                <label for="form_fname">Username:</label>

                                                <input type="text" class="form-control" id="form_uname" placeholder="Username" name="form_uname" minlength="2" maxlength="30" required>

                                            </div>

                                            <!-- Password field -->


                                            <div class="form-group mt-2">
                                                <label for="form_pass">Passsword:</label>
                                                <input type="password" name="form_pass" id="form_pass" placeholder="Password" class="form-control" maxlength="30" minlength="8" required>

                                            </div>

                                            <!-- Retype Password field -->


                                            <div class="form-group mt-2">
                                                <label for="form_repass">Retype Passsword:</label>
                                                <input type="password" name="form_repass" id="form_repass" placeholder="Retype Password" class="form-control" maxlength="30" minlength="8" required>

                                            </div>

                                            <!-- Register btn -->
                                            <div class="col d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Create</button>
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

                        <p>Admin account list...</p>
                        <hr>

                        <!-- admin account starts here -->
                        <?php
                        if ($result_admin->num_rows > 0) {
                            // output data of each row
                            while ($row_admin = $result_admin->fetch_assoc()) {
                        ?>
                        <!-- Margin top added and col set to 5 -->
                        <div id="border-bg" class="row mt-3">
                            <div class="col-sm-5">

                                <!-- No middle name here? -->
                                <p>Name: <?php echo $row_admin['admin_lname'] ?>, <?php echo $row_admin['admin_fname'] ?></p>
                                <p>Username: <?php echo $row_admin['admin_username']; ?></p>


                            </div>


                            <!-- ********************************* -->
                            <!--  Remove the two <br> tags below   -->
                            <!-- when pending section isn't in use -->
                            <!-- ********************************* -->

                            <br>
                            <br>


                            <!-- admin account ends here -->
                        </div>
                        <?php }
                        } ?>


                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">Next</a></li>

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

</body>

</html>
