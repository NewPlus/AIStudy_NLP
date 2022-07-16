<html>
    <head>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    <body>
    <script type="text/javascript">
      function filter(){

        var value, name, item, i;

        value = document.getElementById("value").value.toUpperCase();
        item = document.getElementsByClassName("word");

        for(i=0;i<item.length;i++){
          name = item[i].getElementsByClassName("eng-word");
          if(name[0].innerHTML.toUpperCase().indexOf(value) > -1){
            item[i].style.display = "table-row";
          }else{
            item[i].style.display = "none";
          }
        }
      }
</script>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top d-flex justify-content-between">
            <a class="navbar-brand" href="#">English Vocabulary</a>
            <input onkeyup="filter()" id="value" class="form-control col-5" type="search" placeholder="Search" aria-label="Search">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="voca.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="voca_test.php">Test</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="voca_add.php">Add Voca</a>
                </li>
                <li class="nav-item dropdown disabled">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
                </ul>
            </div>
            </nav>

<?php
	$ini_array = parse_ini_file("dbconnect.ini", true);
    $host = $ini_array['DOTHOME']['HOST'];
    $dbuser = $ini_array['DOTHOME']['USER'];
    $dbpw = $ini_array['DOTHOME']['PW'];
    $dbname = $ini_array['DOTHOME']['DBNAME'];

    $conn = new mysqli($host, $dbuser, $dbpw, $dbname);
    $querys = "select * from t_voca_eng_kor order by intWrong desc;";

    // 어휘집 전체 보기                              //
    
    ?>
    <div class="mt-5 text-center" style="width: 700px; float:none; margin:0 auto">
    <table border=1 class="table table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">English</th>
                <th scope="col">Korean</th>
            </tr>
        </thead>
    <?php
    $query_result = mysqli_query($conn, $querys);
    while($row = mysqli_fetch_array($query_result)){
        $q_strEng = $row['strEngVoca'];
        $q_strKor = $row['strKorVoca'];
        printf("<tr class='word'><td class='eng-word'>%s</td> <td>%s</td></tr>", $q_strEng, $q_strKor);
    }
    printf("</table>");
    //----------------------------------------------//
    
?>
    </div>
        </br>
        <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    </body>
</html>