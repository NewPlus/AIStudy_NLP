<?php
	$ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    $querys = "select * from t_voca_eng_kor order by intWrong desc;";

    // 어휘집 전체 보기                              //
    printf("<table border=1>");
    $query_result = mysqli_query($conn, $querys);
    while($row = mysqli_fetch_array($query_result)){
        $q_strEng = $row['strEngVoca'];
        $q_strKor = $row['strKorVoca'];
        printf("<tr><td>%s</td> <td>%s</td></tr>", $q_strEng, $q_strKor);
    }
    printf("</table>");
    //----------------------------------------------//
    
?>
</br>
<input type="button" value="시험 페이지" onClick="location.href='voca_test.php' ">
<input type="button" value="단어 추가" onClick="location.href='voca_add.php' ">