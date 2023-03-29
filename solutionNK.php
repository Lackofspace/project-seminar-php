<?php
declare(strict_types = 1);

function getSumNK($input, int $N, int $K): ? int{

    foreach($input as &$value){
        if (!(is_int($value))){
            return -1;
        }
    }

    if(count($input) === 0){
        return 0;
    }

    if(count($input) < ($N+$K-1)){
        return -1;
    }

    if($N < 0 or $K < 0){
        return -1;
    }

    if($K === 0) {
        $K = 1;
    }

    $counter = 0;
    $FirstKeyAsNormal = 1;
    foreach($input as &$value){
        if($N === 0) {
            $counter += $value;
        }
        else if($FirstKeyAsNormal >= $K and $FirstKeyAsNormal <= ($N+$K-1)) {
            $counter += $value;
        }
        $FirstKeyAsNormal++;
    }
    return $counter;
}
