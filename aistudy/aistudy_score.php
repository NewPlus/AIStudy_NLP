<?php header("Content-Type:text/html;charset=utf-8"); ?>
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
    $query_text = $_POST['query_text'];
    $corpus_text1 = $_POST['corpus_text1'];
    $lang_num = $_POST['lang_num'];

    if($lang_num == 1){
        $outputs = exec("python3 korean.py '".$query_text."' '".$corpus_text1."'");
        $outputs_s = explode(' , ', $outputs);
    }
    
    
?>
<html>
    <head>
        <title>AIStudy</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
        <div class="mt-5 text-center" style="width: 700px; float:none; margin:0 auto">
            <div class="card border-info mx-5 mt-5 mb-5">
                <div class="card-header">
                사용자가 정리한 개념
                </div>
                <div class="card-body">
                    <?php echo $query_text; ?>
                </div>
            </div>    

            <?php
                $score = floatval($outputs_s[1]);
                
                if($score > 0.5){?>
                    <div class="card border-info mx-5 mt-5 mb-5">
                        <div class="card-header">
                        사용자가 제시한 주관식 답안
                        </div>
                        <div class="card-body">
                            <h5><?php echo "<span class='badge badge-success'>정답</span>  " ?>
                            <?php echo $outputs_s[0]; ?></h5></br>
                            정답! AI는 당신의 답변을 <?php echo round($outputs_s[1]*100); ?>% 정도의 정답으로 판단하였습니다!
                        </div>
                    </div><?php
                }
                else{?>
                    <div class="card border-danger mx-5 mt-5 mb-5">
                        <div class="card-header text-danger">
                        사용자가 제시한 주관식 답안
                        </div>
                        <div class="card-body text-danger">
                            <h5><?php echo "<span class='badge badge-danger'>오답</span>  " ?>
                            <?php echo $outputs_s[0]; ?></h5></br>
                            오답입니다! 다시 작성해보세요! <?php echo round($outputs_s[1]*100); ?>%
                        </div>
                    </div><?php
                }
            ?></br>
            </br>- 정답 기준은 유사도가 0.5이상인 경우입니다.
            </br>- 또한 길이도 일정 길이가 되어야 합니다! 같은 단어의 등장횟수도 유사도에 고려합니다!
            <input type="button" class="btn btn-outline-primary" value="Voca 페이지" onClick="location.href='http://voca.studyforme.kro.kr/pro1/voca/voca.php' ">
            <input type="button" class="btn btn-outline-success" value="AI Study 페이지" onClick="location.href='aistudy.php' ">
        </div>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>