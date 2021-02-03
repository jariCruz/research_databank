<?php
require "header.php";
include "server.php";
//message output
$output = '';
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
//select sql
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
//insert into sql
if (isset($_POST['register'])) {
	$fname = $_POST['fname'];
	$sname = $_POST['sname'];
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$r_password = md5($_POST['r_password']);
	if (isset($_POST['mi'])) {
		$mi = $_POST['mi'];
	}else{
		$mi = '';
	}
	$select = "
        SELECT LOWER(student_username) FROM student_table WHERE LOWER(student_username) = LOWER('$username')
        UNION 
        SELECT LOWER(professor_username) FROM professor_table WHERE LOWER(professor_username) = LOWER('$username')
        UNION 
        SELECT LOWER(admin_username) FROM admin_table WHERE LOWER(admin_username) = LOWER('$username')";

        $check = $conn->query($select);
        if ($check->num_rows > 0) {
          $output = "username!";
        }else {
	//Register sql
	$sql = "INSERT INTO admin_table (admin_fname, admin_lname, admin_mi, admin_username, admin_password, admin_rpassword)
	VALUES ('$fname', '$sname', '$mi', '$username', '$password', '$r_password')";
	$conn->query($sql);
	$output = "sucess";
}
echo $output;
	$conn->close();
}

?>
<!-- update admin results -->
<?php if(isset($_POST['admin_results'])){ ?>
	<p id="admin_results"><?php if (mysqli_num_rows($count_result_admin) > 0) {
                            echo mysqli_num_rows($count_result_admin);
                        }else {
                            echo '0';
                        } ?> Results</p>
<?php } ?>

<?php if (isset($_POST['admin_accounts'])) { ?>
<div>
	<?php if (mysqli_num_rows($result_admin) > 0) { ?>
		<p>Admin account list...</p>
		<hr>
		<!-- output data of each row -->
		<?php while ($row_admin = mysqli_fetch_array($result_admin)) { ?>
			<div class="row" id="border-bg">
				<div class="col-sm-8">
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
</div>
<?php } ?>

<?php if (isset($_POST['admin_pages'])) { ?>

	<div id="admin_page" class="container mt-3">
		<ul class="pagination justify-content-center">
			<?php if ($page > 1) { ?>
				<li class="page-item"><a class="page-link" href="research_coordinator_page.php?page=<?php echo ($page - 1) ?>">Previous</a></li>
			<?php } ?>
			<?php for ($i = 1; $i < $number_pages_admin; $i++) { ?>
				<li class="page-itemactive"><a class="page-link" href="research_coordinator_page.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
			<?php } ?>
			<?php if ($i > $page) { ?>
				<li class="page-item"><a class="page-link" href="research_coordinator_page.php=<?php echo ($page + 1) ?>">Next</a></li>
				<?php } ?>
			</ul>
		</div>

<?php } ?>