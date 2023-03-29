<?php
declare(strict_types = 1);
function getBMI(int $height, float $weight): ? float{
    if ($weight < 1.0 or $weight > 300.0) {
        return null;
    }
    if ($height < 10 or $height > 300) {
        return null;
    }
    else{
        $I = $weight / (($height / 100) ** 2);
        $I = round($I, 2);
        return $I;
    }
}
//$res = getBMI($height = 170.0, $weight = 0.1);
//echo $res;
