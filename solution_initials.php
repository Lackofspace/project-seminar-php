<?php
declare(strict_types = 1);
function getInitials(string $FIO): ? string{
    $get = mb_convert_case($FIO, MB_CASE_TITLE);
    if (mb_strlen($get) == 0) {
        return null;
    }
    $arr = explode(" ", $get);
    if (count($arr) < 2) {
        return null;
    }

    $str1 = $arr[0].' ';
    PHP_EOL;
    for ($i = 1; $i < count($arr); $i++) {
        $arr[$i] = explode("-", $arr[$i]);
    }
    for ($i = 1; $i < count($arr); $i++){
        if (count($arr[$i]) > 1){
            for ($j = 0; $j < count($arr[$i]); $j++){
                $arr[$i][$j] = mb_strimwidth($arr[$i][$j], 0, 1);
                $nstr = $arr[$i][$j];
                if ($j == 0){
                    $str1 = $str1.$nstr.'.';
                }
                if ($j > 0){
                    $str1 = $str1.'-'.$nstr.'.';
                }
            }
        }
        else{
            $arr[$i][0] = mb_strimwidth($arr[$i][0], 0, 1);
            $nstr = $arr[$i][0];
            $str1 = $str1.$nstr.'.';
        }
    }
    return $str1;
}
//$m = [0,1,2];
//$res = getInitials($m);
//echo $res;
