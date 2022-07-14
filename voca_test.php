<?php

    $ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    $querys = "select * from t_voca_eng_kor;";
    
    // 어휘 랜덤 문제                              //
    ?>
    <form name="testform" action="voca_score.php" method="POST">
    <?php
    $already_list = [];
    for($k=0; $k<10; $k++){
        $querys = "select count(*) from t_voca_eng_kor;";
        $query_result = mysqli_query($conn, $querys);
        $random_int = 0;
        $q_intNumberCount = 0;
        while($row = mysqli_fetch_array($query_result)){
            $q_intNumberCount = $row['count(*)'];
            $random_int = rand(1, $q_intNumberCount);
            if(in_array($random_int, $already_list)){
                $already_list.array_push($already_list);
            }
            else{
                $random_int = rand(1, $q_intNumberCount);
                $already_list.array_push($already_list);
            }
        }

        $querys_answer = "select * from t_voca_eng_kor where intNumber=".$random_int.";";
        $query_answer_result = mysqli_query($conn, $querys_answer);
        $list_answer_Kor = [];
        $q_answer_strEng = "";
        $str_answer = "";

        while($row = mysqli_fetch_array($query_answer_result)){
            $q_answer_strEng = $row['strEngVoca'];
            $q_answer_strKor = $row['strKorVoca'];
            $list_answer_Kor = explode(", ", $q_answer_strKor);
            printf("%s </br>", $q_answer_strEng);
            
            $random_int = rand(0, count($list_answer_Kor)-1);
            if(in_array($random_int, $already_list)){
                $random_int = rand(0, count($list_answer_Kor)-1);
            }
            else{
                $random_int = rand(0, count($list_answer_Kor)-1);
                $already_list.array_push($already_list);
            }

            $str_answer = "<input type='radio' name='radio_btn".$k."' value='".$list_answer_Kor[$random_int]."'>".$list_answer_Kor[$random_int];
            echo "<input type='hidden' name='answer".$k."' value='".$q_answer_strKor."'>";
            echo "<input type='hidden' name='eng_answer".$k."' value='".$q_answer_strEng."'>";
            $random_int_answer = rand(0, 4);
        }

        for($i=0; $i<5; $i++){
            if($i == $random_int_answer){
                printf("%s </br>", $str_answer);
            }
            else{
                $random_int = rand(1, $q_intNumberCount);
                $querys = "select * from t_voca_eng_kor where intNumber=".$random_int.";";
                $query_result = mysqli_query($conn, $querys);
                while($row = mysqli_fetch_array($query_result)){
                    $q_strEng = $row['strEngVoca'];
                    $q_strKor = $row['strKorVoca'];
                    $list_Kor = explode(", ", $q_strKor);
                    #printf("%s </br>", $q_strEng);

                    $random_int = rand(0, count($list_Kor)-1);
                    if(in_array($random_int, $already_list)){
                        $random_int = rand(0, count($list_Kor)-1);
                    }
                    else{
                        $random_int = rand(0, count($list_Kor)-1);
                        $already_list.array_push($already_list);
                    }
                    #echo $list_Kor[$random_int];
                    printf("<input type='radio' name='radio_btn".$k."' value='%s'>%s", $list_Kor[$random_int], $list_Kor[$random_int]);
                    printf("</br>");
                }
            }
        }
    }
    ?>
        <input type="submit" value="제출">
    </form>
    <?php
    //----------------------------------------------//
?>