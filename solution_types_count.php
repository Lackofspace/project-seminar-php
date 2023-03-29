<?php
function typesCounter(...$mixedParams): ? array
{
    $arr = [
        'boolean' => 0,
        'integer' => 0,
        'float' => 0,
        'string' => 0,
        'object' => 0,
        'array' => 0
    ];
    foreach ($mixedParams as $value) {
        if (gettype($value) == 'boolean'){
            $arr['boolean'] += 1;
        }
        elseif (gettype($value) == 'integer'){
            $arr['integer'] += 1;
        }
        elseif (gettype($value) == 'double'){   //float - скалярный тип (числа с плавающей точкой или 'double')
            $arr['float'] += 1;             //(числа с плавающей точкой или 'double')
        }
        elseif (gettype($value) == 'string'){
            $arr['string'] += 1;
        }
        elseif (gettype($value) == 'object'){
            $arr['object'] += 1;
        }
        elseif (gettype($value) == 'array'){
            $arr['array'] += 1;
        }
        else{
            return null;
        }
    }
    return $arr;
}