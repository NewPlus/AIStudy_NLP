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
        <title>Score Board</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
<?php

    $ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    $querys = "select intWrong from t_voca_eng_kor where strId = '".$u_id."';";

    $answer_cnt = 0;
    for($i=0; $i<10; $i++){
        $my_answer = $_POST['radio_btn'.$i];
        $real_answer = $_POST['answer'.$i];
        $real_eng_answer = $_POST['eng_answer'.$i];
        $list_answer_Kor = explode(", ", $real_answer);
        ?>
        <div style="width: 500px; float:none; margin:0 auto">
        <?php
        if(in_array($my_answer, $list_answer_Kor)){
            ?>
            <div class="card border-info mx-5 mt-5 mb-5">
                <div class="card-header">
                    <h5><?php echo "<span class='badge badge-success'>정답</span>  ".$real_eng_answer; ?></h5>
                </div>
                <div class="card-body">
                    <?php echo $real_answer; ?>
                </div>
            </div>
            <?php
            $answer_cnt++;
        }
        else{
            ?>
            <div class="card border-danger mx-5 mt-5 mb-5">
            <div class="card-header text-danger">
                <h5><?php echo "<span class='badge badge-danger'>오답</span>  ".$real_eng_answer; ?></h5>
            </div>
            <div class="card-body text-danger">
            <?php
            echo $real_answer;

            $querys = "select intWrong from t_voca_eng_kor where strEngVoca = '".$real_eng_answer."';";
            $query_result = mysqli_query($conn, $querys);
            $q_intWrong = 0;
            while($row = mysqli_fetch_array($query_result)){
                $q_intWrong = $row['intWrong'] + 1;
            }
            $querys = "UPDATE t_voca_eng_kor SET intWrong=".$q_intWrong." WHERE strEngVoca = '".$real_eng_answer."' AND strId = '".$u_id."';";
            $query_result = mysqli_query($conn, $querys);
            ?>
                </div>
            </div>
            <?php
        }
    }
    ?>
        <div class="card border-primary mx-5 mt-5 mb-5">
            <div class="card-header">
                <h5><b>점수</b></h5>
            </div>
            <div class="card-body">
                <?php echo $answer_cnt."/10"; ?>
            </div>
        </div>
    </div>
    <ul class="nav justify-content-center mb-5">
        <li class="nav-item mr-5">
            <input type="button" class="btn btn-outline-success" value="시험 페이지" onClick="location.href='voca_test.php' ">
        </li>
        <li class="nav-item">
            <input type="button" class="btn btn-outline-primary" value="어휘 페이지" onClick="location.href='voca.php' ">
        </li>
    </ul>