<?php
include "server.php";

if (isset($_POST['login-submit'])) {
    $username = $_POST['form_uname'];//username from login form
    $password = $_POST['form_pass'];//password from login form
    $location = $_POST['redirect'];//link to redirect
    //IDs'
    $student_id = 0;
    $professor_id = 0;
    $admin_id = 0;
    //usernames
    $student_user = '';
    $professor_user = '';
    $admin_user = '';
    //passwords
    $student_pass = '';
    $professor_pass = '';
    $admin_pass = '';
    //status
    $student_status = '';
    $professor_status = '';

    //student login info
    $sql1 = "SELECT student_id, student_username, student_password, student_account_status 
    FROM student_table WHERE student_username = '$username'";
    //professor login info
    $sql2 = "SELECT professor_id, professor_username, professor_password, professor_account_status 
    FROM professor_table WHERE professor_username = '$username'";
    //admin login info
    $sql3 = "SELECT admin_id, admin_username, admin_password FROM admin_table WHERE admin_username = '$username'";


    if($result1 = $conn->query($sql1)){
        while($row1 = $result1->fetch_assoc()){
            $student_user = $row1['student_username'];
            $student_pass = $row1['student_password'];
            $student_status = $row1['student_account_status'];
            $student_id = $row1['student_id'];
        }
    }

    if($result2 = $conn->query($sql2)){
        while($row2 = $result2->fetch_assoc()){
            $professor_user = $row2['professor_username'];
            $professor_pass = $row2['professor_password'];
            $professor_status = $row2['professor_account_status'];
            $professor_id = $row2['professor_id'];
        }
    }

    if($result3 = $conn->query($sql3)){
        while($row3 = $result3->fetch_assoc()){
            $admin_user = $row3['admin_username'];
            $admin_pass = $row3['admin_password'];
            $admin_id = $row3['admin_id'];
        }
    }

    if ($username === $student_user && md5($password) === $student_pass) {
        session_start();
        $_SESSION['user_id'] = $student_id;
        $_SESSION['status'] = $student_status;
        $_SESSION['user'] = "Student";
        header("Location: $location");

    } 
    elseif ($username === $professor_user && md5($password) === $professor_pass) {
        session_start();
        $_SESSION['user_id'] = $professor_id;
        $_SESSION['status'] = $professor_status;
        $_SESSION['user'] = "Professor";
        header("Location: $location");
    } 
    elseif ($username === $admin_user && md5($password) === $admin_pass) {
        session_start();
        $_SESSION['user_id'] = $admin_id;
        $_SESSION['status'] = 'admin';
        $_SESSION['user'] = "Admin";
        header("Location: ../php/research_coordinator_page.php");
    }else {
        echo 'Username and Password does not match!';
    }
}