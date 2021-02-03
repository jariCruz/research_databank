<?php
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
//verify status student
if (isset($_POST['verify_id'])){
	$verify_id =  $_POST['verify_id'];

$sql = "UPDATE student_table 
SET student_account_status='verified' 
WHERE student_id=$verify_id";
}

//deny status
if (isset($_POST['deny_id'])){
	$deny_id =  $_POST['deny_id'];

$sql = "UPDATE student_table 
SET student_account_status='denied' 
WHERE student_id=$deny_id";
}
    if ($conn->query($sql) === TRUE) { ?>
    	<div id="updateStatus">
                    <!-- Main content student -->
                    <div class="row mt-3">
                        <!-- Select sql for student -->
                        <?php
                        $sql_student = "SELECT * 
                        FROM student_table 
                        WHERE student_account_status = 'pending'";
                        $result_student = $conn->query($sql_student);
                        //this sql is for getting the number of results
    					$sql_count = " SELECT * 
    					from student_table 
    					where student_account_status = 'pending'";
    					$count_result = mysqli_query($conn, $sql_count);
    					$number_pages = ceil(mysqli_num_rows($count_result) / $limit);
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
                                            <p>CYS: <?php echo $row_student['student_course']; ?></p>
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
                                echo "No Results Found";
                            }
                                
                            ?>

                            <!-- Pagination -->

                            <div class="container mt-3">

                                <ul class="pagination justify-content-center">
    					            <?php if ($page > 1) { ?>
    					              <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
    					            <?php } ?>
    					            <?php for ($i = 1; $i < $number_pages; $i++) { ?>
    					              <li class="page-itemactive"><a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
    					            <?php } ?>
    					            <?php if ($i > $page) { ?>
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
    <?php } ?>

<?php
$conn->close();
?>