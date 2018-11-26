<?php 

function checkPassword($input){
    return filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,16}$/")));
}

?>