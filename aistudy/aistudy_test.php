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
        <title>AIStudy Test</title>
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
        <?php
            $ini_array = parse_ini_file("dbconnect.ini", true);
            $host = $ini_array['DOTHOME']['HOST'];
            $dbuser = $ini_array['DOTHOME']['USER'];
            $dbpw = $ini_array['DOTHOME']['PW'];
            $dbname = $ini_array['DOTHOME']['DBNAME'];
        
            $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
            $querys = "select count(*) from aistudy_problem_t where strId = '".$u_id."';";
            $query_result = mysqli_query($conn, $querys);
            
            $random_int = 0;
            $q_intNumberCount = 0;
            $already_list = [];

            while($row = mysqli_fetch_array($query_result)){
                $q_intNumberCount = $row['count(*)'];
                $random_int = rand(0, $q_intNumberCount-1);
                if(in_array($random_int, $already_list)){
                    $already_list.array_push($already_list, $random_int);
                }
                else{
                    $random_int = rand(1, $q_intNumberCount);
                    $already_list.array_push($already_list, $random_int);
                }
            }

            $querys_answer = "select * from aistudy_problem_t where strId = '".$u_id."' LIMIT ".$random_int.",1;";

            $query_answer_result = mysqli_query($conn, $querys_answer);
            ?>
            <form name="addform" action="aistudy_score.php" method="POST">
            <div style="width: 700px; float:none; margin:0 auto">
                <div class="card mx-5 mt-5 mb-5">
            <?php
                while($row = mysqli_fetch_array($query_answer_result)){
                    $q_strKeyword = $row['strKeyword'];
                    $q_strRealAnswer = $row['strRealAnswer'];
                    $q_intLanguage = $row['intLanguage'];
                    ?>
                    <h5 class="card-header">
                        <?php printf("%s </br>", $q_strKeyword); ?>
                    </h5>
                    <div class="card-body">
                        <p class="text-left">Your Answer</p>
                        <textarea name="corpus_text1" class="form-control mx-1 mt-1 mb-1" placeholder="Your Answer" onkeydown="resize(this)" onkeyup="resize(this)"></textarea>
                    </div>
                    <input type="hidden" name="query_text" value="<?php echo $q_strRealAnswer ?>">
                    <input type="hidden" name="lang_num" value="<?php echo $q_intLanguage ?>">
                    <input type="submit" class="btn btn-outline-success" value="제출">
                    <?php
                }
            ?>
                </div>
            </div>
            
        </form>
        
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>