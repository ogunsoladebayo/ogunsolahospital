<?php

function print_alert(){
    $types = ['success', 'error', 'info'];
    $colors = ['success', 'danger', 'info'];

    for($i = 0; $i < count($types); $i++){
        if (isset($_SESSION[$types[$i]]) && !empty($_SESSION[$types[$i]])){
            echo "<div class='alert alert-" . $colors[$i] . "' role='alert'>" . $_SESSION[$types[$i]] .  "</div>";
            session_destroy();
        }

    }

}

function set_Alert($type = 'success', $content = ""){
switch($type){
    case 'success':
        $_SESSION['success'] = $content;
    break;
    case 'error':
        $_SESSION['error'] = $content;
    break;
    case 'info':
        $_SESSION['info'] = $content;
    break;
    default:
    $_SESSION['success'] = $content;
break;

}
}