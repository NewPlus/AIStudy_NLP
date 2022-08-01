<?php
    $u_id = $_POST['u_id'];
    $u_pw = $_POST['u_pw'];
    $u_name = $_POST['u_name'];
    $u_pw_check = $_POST['u_pw_check'];
    $u_email= $_POST['u_email'];

    $ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    if (!is_null($u_id)) {
        $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
        $querys = "select * from member_t where strId = '".$u_id."';";
        $query_result = mysqli_query($conn, $querys);
        while($row = mysqli_fetch_array($query_result)){
            $q_id = $row['strId'];
        }
        if($u_id == $q_id){
            $double_id = 1;
        }
        elseif($u_pw != $u_pw_check){
            $wrong_pw = 1;
        }
        else{
            $e_pw = $u_pw;
            #$e_pw = password_hash($u_pw, PASSWORD_DEFAULT);
            $query_add_user = "INSERT INTO member_t(strName, strId, strPw, strEmail) VALUES ('".$u_name."','".$u_id."','".$e_pw."','".$u_email."');";
            mysqli_query($conn, $query_add_user);
            header('Location: signin.php');
        }
    }
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Register</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <div class="mb-5 mt-5 mx-5">
    <body class="text-center" style="width: 450px; float:none; margin:0 auto">
      <form class="form-signin" action="register.php" method="POST">
        <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
      
        <h1 class="h3 mb-3 font-weight-normal">Sign Up</h1>
      
        <label for="inputEmail" class="sr-only">ID</label>
        <input type="text" name = "u_id" id="inputEmail" class="mb-3 form-control" placeholder="ID" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name = "u_pw" id="inputPassword" class="mb-3 form-control" placeholder="Password" required>
      
        <label for="inputPassword" class="sr-only">Password check</label>
        <input type="password" name = "u_pw_check" id="inputPassword" class="mb-3 form-control" placeholder="Password check" required>
      
        <label for="inputPassword" class="sr-only">Name</label>
        <input type="text" name = "u_name" id="inputPassword" class="mb-3 form-control" placeholder="Name" required>
      
        <label for="inputPassword" class="sr-only">E-mail</label>
        <input type="text" name = "u_email" id="inputPassword" class="mb-3 form-control" placeholder="E-mail" required>
      
        <div class="check_idpw">
        <?php
          if($empty_u == 1){
            echo "<p>사용자 ID가 존재하지 않습니다.</p>";
          }
          if($wrong_pw == 1){
             echo "<p>비밀번호가 틀렸습니다.</p>";
          }
        ?>
        </div>

        <div class="mb-2 text-center">
          <a href="signin.php">Return to Sign in</a>
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
        <?php
                    if ( $double_id == 1 ) {
                        echo "<p>사용자 ID가 중복되었습니다.</p>";
                    }
                    if ( $wrong_pw == 1 ) {
                        echo "<p>비밀번호가 일치하지 않습니다.</p>";
                    }
                ?>
        <p class="mt-5 mb-3 text-muted">&copy; 2022 - Made By LeeYongHwan(이용환)</p>
      </form>
    </body>
  </div>

  <html>
    <head>
        <title>Register</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
    <?php

    ?>