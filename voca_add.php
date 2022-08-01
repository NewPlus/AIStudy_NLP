<?php
    session_start();
    if(empty($_SESSION['id'])) {
        header('Location: signin.php');
    }
    else {
        $u_id = $_SESSION['id'];
        $u_name = $_SESSION['name'];
        $_SESSION['id'] = $u_id;
        $_SESSION['name'] = $u_name;
    }
?>
<head>
<title>English Voca Add</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
<?php

?>
<div style="width: 500px; float:none; margin:0 auto">
<div class="card mx-5 mt-5 mb-5">
    <div class="card-body">
    <form name="addform" action="voca_add_check.php" method="POST">
        <div class="form-group">
            <label>
                English
                <input type="textbox" class="form-control mx-1 mt-1 mb-1" placeholder="English" name="eng_word">
            </label>
        </div>
        <div class="form-group">
            <label>
                Korean
                <input type="textbox" class="form-control mx-1 mt-1 mb-1" placeholder="Korean" name="kor_word">
            </label>
        </div>
        <input type="hidden" value="<?php echo $u_id ?>" name="u_id">
        <input type="submit" class="btn btn-outline-success mx-1 mt-1 mb-1" value="제출">
    </form>
</div>
<input type="button" class="btn btn-outline-primary" value="어휘 페이지" onClick="location.href='voca.php' ">
</div>
</div>