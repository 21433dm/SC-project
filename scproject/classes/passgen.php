<?php
 
/**
 * The letter l (lowercase L) and the number 1
 * have been removed, as they can be mistaken
 * for each other.
 */
 
function createRandomPassword() {
 
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
 
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
 
    return $pass;
 
}

function createRandomUsername() {
 
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $user = '' ;
 
    while ($i <= 2) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 2);
        $user = $user . $tmp;
        $i++;
    }
 
    return $user;
 
}
// Usage
// $username = createRandomUsername();
// $password = createRandomPassword();
// echo "Your random username is: $username<br>";
// echo "Your random password is: $password";
 
?>