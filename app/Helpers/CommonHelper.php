<?php
use App\UserLogs;

function user_logs($name = NULL, $operation = NULL, $description = NULL, $table = NULL, $refer_id = NULL){
    $user = new Userlogs;
    $user->form_name = $name;
    $user->operation_type = $operation;
    $user->user_id = 1;
    $user->description = $description;
    $user->OS = 'WEB';
    $user->table_name = $table;
    $user->reference_id = $refer_id;
    $user->ip_device_id = "000:00:00";
    $user->user_type_id = 1;
    $user->save();
}
