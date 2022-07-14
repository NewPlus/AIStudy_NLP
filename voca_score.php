<?php

    $ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    $querys = "select intWrong from t_voca_eng_kor;";

    $answer_cnt = 0;
    for($i=0; $i<10; $i++){
        $my_answer = $_POST['radio_btn'.$i];
        $real_answer = $_POST['answer'.$i];
        $real_eng_answer = $_POST['eng_answer'.$i];
        if($my_answer == $real_answer){
            echo ($i+1)."번 정답!";
            $answer_cnt++;
        }
        else{
            echo ($i+1)."번 오답! </br> 정답 : ".$real_eng_answer." ".$real_answer;
            $querys = "select intWrong from t_voca_eng_kor where strEngVoca = '".$real_eng_answer."';";
            $query_result = mysqli_query($conn, $querys);
            $q_intWrong = 0;
            while($row = mysqli_fetch_array($query_result)){
                $q_intWrong = $row['intWrong'] + 1;
            }
            $querys = "UPDATE t_voca_eng_kor SET intWrong=".$q_intWrong." WHERE strEngVoca = '".$real_eng_answer."';";
            $query_result = mysqli_query($conn, $querys);
        }
        echo "<br>";
    }
    echo "결과 : ".$answer_cnt."/10";
?>
</br>
<input type="button" value="시험 페이지" onClick="location.href='voca_test.php' ">
</br>
<input type="button" value="어휘 페이지" onClick="location.href='voca.php' ">