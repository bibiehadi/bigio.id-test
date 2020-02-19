<?php

?>
<form action="soal1.php" method="post">
Masukan String : <input type="text" name="string"><br>
<input type="submit">
</form>

<?php

$str = $_POST['string'];
// print_r(explode(',', $str));
getSTR($str);
// $lower = strtolower($str);
// $splitSTR = str_split($lower);

// print_r($splitSTR);

function desc($string){
    $low = strtolower($string);
    $str = explode(',',$low);
    $length = count($str);
    for($i = $length; $i >= 0; $i-- ){
        $descStr .=  $str[$i];
    }
    return $descStr;
}

function getSTR($string){
    $low = strtolower($string);
    $str= explode(',',$low);
    for($i = 0; $i < count($str); $i++ ){
        $res .=  $str[$i];
    }
    $result = $res . desc($string);
    echo $result;
}

?>