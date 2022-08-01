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
        <title>AIStudy</title>
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
                <h1> What's the AIStudy System?</h1></br>
                제 스스로 전공에 투자하는 공부시간을 아끼면서 동시에 개발 능력 향상과 연구활동에 도움을 주기 위한 웹 개발 프로젝트입니다.</br>
                이 페이지는 저의 첫 번째 'Natural Language Processing' 시험판으로 문장의 유사도로 주관식 시험지 생성 페이지입니다.</br>
            <input type="button" class="btn btn-outline-primary mx-1" value="Add Study" onClick="location.href='aistudy_add.php' ">
            <input type="button" class="btn btn-outline-success mx-1" value="Test" onClick="location.href='aistudy_test.php' ">
            <input type="button" class="btn btn-outline-primary" value="Voca 페이지" onClick="location.href='http://voca.studyforme.kro.kr/pro1/voca/voca.php' ">
        </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>