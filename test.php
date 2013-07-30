<?php

function arrayDiffKeyRecursive ($arrayOriginal, $arrayCompare)
{

    foreach($arrayOriginal as $key => $value)
    {
        //$return[$key] = is_array($value) ? self::arrayDiffKeyRecursive($arrayOriginal[$key], $arrayCompare[$key]) : array_diff_key($arrayOriginal, $arrayCompare);
        if(is_array($value))
        {
            $return[$key] = arrayDiffKeyRecursive($arrayOriginal[$key], $arrayCompare[$key]);
        }else {
            if(is_array($arrayCompare))
                $return = array_diff_key($arrayOriginal, $arrayCompare);
            else{
                $return = $arrayOriginal;
            }
        }

        if(isset($return[$key]) && is_array($return[$key]) && count($return[$key]) == 0)
        {
            unset($return[$key]);
        }
    }
    return $return;
}
$a1 = array('bla' => 'value');
$a2 = array('bla1' => 'test','bla2' => array('sub-bla1' => 'bla1'));
$diff = arrayDiffKeyRecursive($a1, $a2);
echo '1';
var_dump($a1);
echo '2';
var_dump($a2);
echo 'diff';
var_dump($diff);
if (!empty($diff)){
    $new_array = array_replace_recursive($a1, $a2);
    echo 'replace';
    var_dump($new_array);
}