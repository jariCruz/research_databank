<?php 
    include "server.php";
        $fname = $_POST['form_fname'];
        $sname = $_POST['form_sname'];
        $mi = $_POST['form_mi'];
        $username = $_POST['form_uname'];
        $password = $_POST['form_pass'];
        $r_password = $_POST['form_repass'];
        $enc_password = md5($password);
        $enc_r_password = md5($r_password);

            $sql = "INSERT INTO admin_table (admin_fname, admin_lname, admin_mi, admin_username, admin_password, admin_rpassword)
            VALUES ('$fname', '$sname', '$mi', '$username', '$enc_password', '$enc_r_password')";

            if ($conn->query($sql) === TRUE && isset($username)) {
                header("Location: research_coordinator_page.php");
            }else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
$conn->close();
?>