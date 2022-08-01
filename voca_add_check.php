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
<?php
$ini_array = parse_ini_file("dbconnect.ini", true);
$host = $ini_array['DOTHOME']['HOST'];
$dbuser = $ini_array['DOTHOME']['USER'];
$dbpw = $ini_array['DOTHOME']['PW'];
$dbname = $ini_array['DOTHOME']['DBNAME'];

$conn = new mysqli($host, $dbuser, $dbpw, $dbname);

$strKor = $_POST["kor_word"];
$strEng = $_POST["eng_word"];

$querys = "select * from t_voca_eng_kor where strId = '".$u_id."';";
$query_result = mysqli_query($conn, $querys);
$flag = 0;
while($row = mysqli_fetch_array($query_result)){
    if($strEng == $row['strEngVoca']){
        $flag = 1;
        break;
    }
}
if($flag){
    echo '<script type="text/javascript">'; 
    echo 'alert("이미 등록된 단어입니다!");'; 
    echo 'window.location.href = "voca_add.php";';
    echo '</script>';
}
else{
    $querys = "INSERT INTO t_voca_eng_kor(strEngVoca, strKorVoca, strId) VALUES('".$strEng."', '".$strKor."', '".$u_id."');";
    $query_result = mysqli_query($conn, $querys);
    Header("Location:voca_add.php"); 
}
?>