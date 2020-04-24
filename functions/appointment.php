<?php function save_appointment($department){
    
    $data = file_get_contents("db/appointments/" . $department . ".json");
    $update = json_decode($data, true);
    return $update;
}
?>