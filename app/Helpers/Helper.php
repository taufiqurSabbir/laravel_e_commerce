<?php
function send_massage($msg,$status,$code){
    $res = [
        'status'=>$status,
        'massage' => $msg
    ];
    return response()->json($res,$code);
}
