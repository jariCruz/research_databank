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
if (isset($_POST['verify_id_professor'])){
	$verify_id =  $_POST['verify_id_professor'];

$sql = "UPDATE professor_table 
SET professor_account_status='verified' 
WHERE professor_id=$verify_id";
}

//deny status
if (isset($_POST['deny_id_professor'])){
	$deny_id =  $_POST['deny_id_professor'];

$sql = "UPDATE professor_table 
SET professor_account_status='denied' 
WHERE professor_id=$deny_id";
}
    if ($conn->query($sql) === TRUE) { ?>
    	<div id="updateStatusProfessor">
                <div class="row mt-3">
                    <?php
                    $sql_professor = "SELECT * 
                    FROM professor_table
                    WHERE professor_account_status = 'pending'";
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

                    <!-- second column -->
                    <div class="col">

                        

                        <!-- professor account starts here -->
                        <?php
                        if (mysqli_num_rows($result_professor) > 0) {
                            // output data of each row
                            while ($row_professor = mysqli_fetch_array($result_professor)) {
                        ?>
                        <p>Professor Pending...</p>
                        <hr>
                                <div class="row" id="border-bg">
                                    <div class="col-sm-8">


                                        <p>Name: <?php echo $row_professor['professor_lname']; ?>, <?php echo $row_professor['professor_fname'] . ' ' . $row_professor['professor_mi']; ?></p>
                                        <p>Department: <?php echo $row_professor['professor_department']; ?></p>
                                        <p>Address: <?php echo $row_professor['professor_address'] ?>.</p>


                                    </div>

                                    <div class="col-sm-4">
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
                        }else {
                            echo "No Results Found";
                        } ?>

                        <!-- Pagination -->

                        <div class="container mt-3">

                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) { ?>
                                  <li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
                                <?php } ?>
                                <?php for ($i = 1; $i < $number_pages_professor; $i++) { ?>
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
            </div>
    <?php } ?>

<?php
$conn->close();
?>