<?php 

function checkPassword($input){
    return filter_var($input, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,16}$/")));
}

function passwordRequirements(){
    return "Password must be 6 to 16 characters long and must include at least one upper case letter, one lower case letter, and one numeric digit.";
}

?>