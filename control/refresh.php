<?php

$currentPage = $_POST['currentPage'];
$boundaries = $_POST['boundaries'];
$around = $_POST['around'];
$totalPages = $_POST['totalPages'];

$output = "";
$isSelected = "";
$finalArray = [];
$aroundArray = [];
$boundariesMin = [];
$boundariesMax = [];


if ($around === "" && $boundaries === "") {
    for ($i = 1; $i <= $totalPages; $i++) {
        $isSelected = isSelected($currentPage, $i);
        $output .= "<a class='button is-link is-small pagination_btn {$isSelected}'>{$i}</a> ";
    }
    echo $output;
} else {
    $finalArray[] = intval($currentPage);
//around
    if ($around) {
        for ($y = $currentPage - $around; $y <= $currentPage + $around; $y++) {
            if ($y <= $totalPages && $y > 0) {
                $finalArray[] = intval($y);
//                $aroundArray[] = intval($y);
            }
        }
    }

//boundaries
    if ($boundaries) {
        //boundaries min
        for ($k = 1; $k <= $boundaries; $k++) {
            if ($k <= $totalPages && $k > 0) {
                $finalArray[] = intval($k);
//                $boundariesMin[] = intval($k);
            }
        }
        //boundaries max
        for ($z = $totalPages; $z > $totalPages - $boundaries; $z--) {
            if ($z <= $totalPages && $z > 0) {
                $finalArray[] = intval($z);
//                $boundariesMax[] = intval($z);
            }
        }
        /*
        $maxInitial = $boundariesMin[sizeof($boundariesMin) - 1];
        $minMiddle = $aroundArray[0];
        $maxMiddle = $aroundArray[sizeof($aroundArray) - 1];
        $minFinal = $boundariesMax[0];
        
        
        var_dump($maxInitial);
        var_dump($minMiddle);
        var_dump($maxMiddle);
        var_dump($minFinal);
        */
        
        /*
        if ($boundariesMin[sizeof($boundariesMin) - 1] < $aroundArray[0]) {
            foreach ($boundariesMin as $singleBMin) {
                $finalArray[] .= $singleBMin;
            }
            $finalArray[] .= " ... ";
            foreach ($aroundArray as $singleAr) {
                $finalArray[] .= $singleAr;
            }
        }
        */
        
        
    }
    
    $finalArray = array_unique($finalArray);
    sort($finalArray);
    $finalArray = ellipsis($finalArray);
    
    foreach ($finalArray as $singleElement) {
        $isSelected = isSelected($currentPage, $singleElement);
        if($singleElement == " ... "){
            $output .= "<span class='ellipsis is-small'>{$singleElement}</span> ";
        }else {
            $output .= "<a class='button is-link is-small pagination_btn {$isSelected}'>{$singleElement}</a> ";
        }
    }
    echo $output;
}


function ellipsis($array){
    $count = 1;
    $previousCheck = false;
    for ($i = 0; $i < sizeof($array); $i++) {
        
        if ($array[$i] != $count) {
            if($previousCheck == false) {
                $returnArray[] = " ... ";
                $previousCheck = true;
                $i--;
            }else{
                $i--;
            }
        } else {
            $returnArray[] = $array[$i];
            $previousCheck = false;
        }
        $count++;
    }
    return $returnArray;
}

function isSelected($currentPage, $element)
{
    if ($currentPage == $element) {
        return "selected_btn";
    } else {
        return "";
    }
}
