<?php

?>
<form name="addform" action="voca_add_check.php" method="POST">
    <input type="textbox" placeholder="영단어" name="eng_word">
    <input type="textbox" placeholder="한글 뜻" name="kor_word">
    <input type="submit" value="제출">
</form>
<input type="button" value="어휘 페이지" onClick="location.href='voca.php' ">