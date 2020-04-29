<?php

function affichagePrix($prix1){

    $count1=strlen($prix1);

    
    if($count1==4){
        echo $prix1[0].' '.$prix1[1].$prix1[2].$prix1[3].' $ ';
    }
    if($count1==5){
        echo $prix1[0].$prix1[1].' '.$prix1[2].$prix1[3].$prix1[4].' $ ';
    }
    if($count1==6){
        echo $prix1[0].$prix1[1].$prix1[2].' '.$prix1[3].$prix1[4].$prix1[5].' $ ';
    }
    if($count1==7){
        echo $prix1[0].' '.$prix1[1].$prix1[2].$prix1[3].' '.$prix1[4].$prix1[5].$prix1[6].' $ ';
    }
    if($count1==8){
        echo $prix1[0].$prix1[1].' '.$prix1[2].$prix1[3].$prix1[4].' '.$prix1[5].$prix1[6].$prix1[7].' $ ';
    }
    if($count1==9){
        echo $prix1[0].$prix1[1].$prix1[2].' '.$prix1[3].$prix1[4].$prix1[5].' '.$prix1[6].$prix1[7].$prix1[8].' $ ';
    }
}



?>