<?php
    session_start();
    if(empty($_SESSION['id'])) {
        header('Location: /pro1/voca/signin.php');
    }
    else {
        $u_id = $_SESSION['id'];
        $u_name = $_SESSION['name'];
        $_SESSION['id'] = $u_id;
        $_SESSION['name'] = $u_name;
    }
?>
<html>
    <head>
        <title>AIStudy Add</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <script>
            function resize(obj) {
                obj.style.height = '1px';
                obj.style.height = (12 + obj.scrollHeight) + 'px';
            }
        </script>
        <div class="mt-5 text-center" style="width: 700px; float:none; margin:0 auto">
            <div class="card mx-5 mt-5 mb-5">
                <div class="card-body"  style="width: 600px;">
                    <form name="addform" action="aistudy_add_check.php" method="POST">
                        <h1> Add Study </h1></br>
                            <p class="text-left">Keyword</p>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <select class="custom-select mt-1 mb-1" name="lang_num">
                                        <option selected value="0">Language</option>
                                        <option value="1">Korean(한국어)</option>
                                        <option value="2">English</option>
                                        <option value="3">Japanese(日本語)</option>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="key_text" class="form-control mx-1 mt-1 mb-1" placeholder="Keyword"></br>
                                </div>
                            </div>

                            <p class="text-left">Correct Answer</p>
                            
                            <textarea name="query_text" class="form-control mx-1 mt-1 mb-1" placeholder="Correct Answer" onkeydown="resize(this)" onkeyup="resize(this)"></textarea>
                        
                        <input type="submit" class="btn btn-outline-success mt-4 mx-1" value="저장">
                        <input type="button" class="btn btn-outline-primary mt-4 mx-1" value="AI Study" onClick="location.href='aistudy.php' ">
                    </form>
                </div>
            </div>
        </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>