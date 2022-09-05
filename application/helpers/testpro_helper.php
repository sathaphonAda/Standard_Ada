<?php

    function tDateToDB($dDate=null){
        if($dDate){
           $aDate = explode('/', $dDate);
           $tNewDate = $aDate[2]."-".$aDate[0].'-'.$aDate[1];
           return $tNewDate;
        }
    }
    // function tDBToDate($dDate=null){
    //     if($dDate){
    //        $aDate = explode('-', $dDate);
    //        $tNewDate = $aDate[2]."-".$aDate[0].'-'.$aDate[1];
    //        return $tNewDate;
    //     }
    // }
?>