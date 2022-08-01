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
<?php

$lang_num = $_POST['lang_num'];

if($lang_num == 0){
    echo '<script type="text/javascript">'; 
    echo 'alert("언어를 선택하세요!!");'; 
    echo 'window.location.href = "aistudy_add.php";';
    echo '</script>';
}
else if($lang_num == 3){
    echo '<script type="text/javascript">'; 
    echo 'alert("日本語はまだ準備中です！");'; 
    echo 'window.location.href = "aistudy_add.php";';
    echo '</script>';
}
else if($lang_num == 2){
    echo '<script type="text/javascript">'; 
    echo 'alert("English is still being prepared!");'; 
    echo 'window.location.href = "aistudy_add.php";';
    echo '</script>';
}
else{
    $ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);

    $strKeyword = $_POST['key_text'];
    $strRealAnswer = $_POST['query_text'];
    $intLanguage = $_POST['lang_num'];

    $querys = "select * from aistudy_problem_t where strId = '".$u_id."';";
    $query_result = mysqli_query($conn, $querys);
    $flag = 0;
    while($row = mysqli_fetch_array($query_result)){
        if($strKeyword == $row['strKeyword']){
            $flag = 1;
            break;
        }
    }
    if($flag){
        echo '<script type="text/javascript">'; 
        echo 'alert("이미 등록된 단어입니다!");'; 
        echo 'window.location.href = "aistudy_add.php";';
        echo '</script>';
    }
    else{
        $querys = "INSERT INTO aistudy_problem_t(strKeyword, strRealAnswer, intLanguage, strId) VALUES('".$strKeyword."', '".$strRealAnswer."', ".$intLanguage.", '".$u_id."');";
        $query_result = mysqli_query($conn, $querys);
        Header("Location:aistudy_add.php");
    }
}

?>