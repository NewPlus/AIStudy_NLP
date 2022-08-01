
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
        <title>My English Test</title>
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
    $querys = "select * from t_voca_eng_kor where strId = '".$u_id."';";
    
    // 어휘 랜덤 문제                              //
    ?>
    <form name="testform" action="voca_score.php" method="POST">
    <?php
    $already_list = [];
    for($k=0; $k<10; $k++){
        $querys = "select count(*) from t_voca_eng_kor where strId = '".$u_id."';";
        $query_result = mysqli_query($conn, $querys);
        $random_int = 0;
        $q_intNumberCount = 0;
        while($row = mysqli_fetch_array($query_result)){
            $q_intNumberCount = $row['count(*)'];
            $random_int = rand(1, $q_intNumberCount);
            if(in_array($random_int, $already_list)){
                $already_list.array_push($already_list, $random_int);
            }
            else{
                $random_int = rand(1, $q_intNumberCount);
                $already_list.array_push($already_list, $random_int);
            }
            
        }
        
        $querys_answer = "select * from t_voca_eng_kor where strId = '".$u_id."' LIMIT ".$random_int.",1;";

        $query_answer_result = mysqli_query($conn, $querys_answer);
        $list_answer_Kor = [];
        $q_answer_strEng = "";
        $str_answer = "";
        ?>
        <div style="width: 500px; float:none; margin:0 auto">
        <div class="card mx-5 mt-5 mb-5">
        <?php
        $random_int_answer = 0;
        while($row = mysqli_fetch_array($query_answer_result)){
            $q_answer_strEng = $row['strEngVoca'];
            $q_answer_strKor = $row['strKorVoca'];
            $list_answer_Kor = explode(", ", $q_answer_strKor);?>
            <h5 class="card-header">
                <?php printf("%s </br>", $q_answer_strEng); ?>
            </h5>
            <div class="card-body">
            <?php
            
            $random_int = rand(0, count($list_answer_Kor)-1);
            if(in_array($random_int, $already_list)){
                $random_int = rand(0, count($list_answer_Kor)-1);
            }
            else{
                $random_int = rand(0, count($list_answer_Kor)-1);
                $already_list.array_push($already_list);
            }

            $str_answer = "
            <div class='form-check'>
                <label class='btn btn-link'>
                <input type='radio' class='btn-check' name='radio_btn".$k."' id='radio_btn".$k."' value='".$list_answer_Kor[$random_int]."'>
                $list_answer_Kor[$random_int]
                </label>
            </div>";

            echo "<input type='hidden' name='answer".$k."' value='".$q_answer_strKor."'>";
            echo "<input type='hidden' name='eng_answer".$k."' value='".$q_answer_strEng."'>";
            $random_int_answer = rand(0, 4);
        }
        
        for($i=0; $i<5; $i++){
            if($i == $random_int_answer){
                printf("%s", $str_answer);
            }
            else{
                $random_int = rand(1, $q_intNumberCount);
                $querys = "select * from t_voca_eng_kor where strId = '".$u_id."' LIMIT ".$random_int.",1;";
                $query_result = mysqli_query($conn, $querys);
                while($row = mysqli_fetch_array($query_result)){
                    $q_strEng = $row['strEngVoca'];
                    $q_strKor = $row['strKorVoca'];
                    $list_Kor = explode(", ", $q_strKor);
                    #printf("%s </br>", $q_strEng);

                    $random_int = rand(0, count($list_Kor)-1);
                    if(in_array($random_int, $already_list)){
                        $random_int = rand(0, count($list_Kor)-1);
                        $already_list.array_push($already_list,$random_int);
                    }
                    else{
                        $random_int = rand(0, count($list_Kor)-1);
                        $already_list.array_push($already_list,$random_int);
                    }
                    #echo $list_Kor[$random_int];
                    ?>
                    <div class='form-check'>
                        <label class='btn btn-link'>
                            <input type='radio' class='btn-check' name='radio_btn<?php echo $k ?>' id='radio_btn<?php echo $k ?>' value='<?php echo $list_Kor[$random_int]?>'>
                            <?php echo $list_Kor[$random_int]?>
                        </label>
                    </div>
                    <?php
                }
            }
        }
        ?>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <input type="submit" class="btn btn-outline-success" value="제출">
        </li>
    </ul>
    </form>
    <?php
    //----------------------------------------------//
?>