<?php

require ('../includes/variables.php');
require '../includes/login_func.php';

$username = $_REQUEST['username'];
$email = $_REQUEST['email'];
$pass = $_REQUEST['password'];
$pass_re = $_REQUEST['password_re'];
$cap = $_REQUEST['g-recaptcha-response'];

$msg = '';
$msg .= validateEmail($email);
$msg .= validateUsername($username);
$msg .= validatePassword($pass, $pass_re);
$msg .= validateCaptcha($cap);
if($msg != ''){
    header('Location: register.php?msg='.$msg);
    exit();
}
else{
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	if ($stmt = $mysqli->prepare('INSERT INTO users ( username, password, email )
				VALUES (?, ?, ?)')){
        $stmt->bind_param('sss', $username, $hash, $email);
		$stmt->execute();
        $id = $mysqli->insert_id;
		$stmt->close();
        if($stmt = $mysqli->prepare('INSERT INTO user_detail ( user_id ) VALUES (?)')){
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $stmt->close();
    		header('Location: login.php?msg=Created User');
            exit();
        }
        else{
            header('Location: register.php?msg=Cannot Insert Into DB');
            exit();    
        }
	}
    else{
        header('Location: register.php?msg=Cannot Insert Into DB');
        exit();
    }
}

?>