<?php
$u_id = $_POST['u_id'];
$u_pw = $_POST['u_pw'];
if (!is_null($u_id)) {
      $ini_array = parse_ini_file("dbconnect.ini", true);
      $host = $ini_array['DOTHOME']['HOST'];
      $dbuser = $ini_array['DOTHOME']['USER'];
      $dbpw = $ini_array['DOTHOME']['PW'];
      $dbname = $ini_array['DOTHOME']['DBNAME'];

     $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
     $querys = "select * from member_t where strId = '".$u_id."';";

     $query_result = mysqli_query($conn, $querys);
     while($row = mysqli_fetch_array($query_result)){
          $q_pw = $row['strPw'];
          $u_name = $row['strName'];
     }

     if(is_null($q_pw)){
          $empty_u = 1;
     }
     else{
          if($u_pw == $q_pw){
          #if(password_verify($u_pw, $q_pw)){
               session_start();
               $_SESSION['id'] = $u_id;
               $_SESSION['name'] = $u_name;
               header('Location: voca.php');
          }
          else{
               $wrong_pw = 1;
          }
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
    <title>Voca Sign in</title>

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
    <form class="form-signin" action="signin.php" method="POST">
      <img class="mb-4" src="img/logo.png" alt="" width="72" height="72">
      
      <h1 class="h3 mb-3 font-weight-normal">Vocabulary Study System</h1>
      
      <label for="inputEmail" class="sr-only">ID</label>
      <input type="text" name = "u_id" id="inputEmail" class="mb-3 form-control" placeholder="ID" required autofocus>

      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name = "u_pw" id="inputPassword" class="mb-3 form-control" placeholder="Password" required>
      
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
        <a href="register.php">Register</a>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      
      <p class="mt-5 mb-3 text-muted">&copy; 2022 - Made By LeeYongHwan(이용환)</p>
    </form>
  </body>
  </div>
</html>


<html>
    <head>
        <title>Login</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
    <?php

    ?>