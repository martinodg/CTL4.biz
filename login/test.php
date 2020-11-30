<?

function strToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}
function strToMD5($string){
    $md5strng= md5($string);
    $cleaner = trim(strip_tags($md5strng));
    return $cleaner;
}
function randomPassword($length) {
 
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&_";
    $password = substr( str_shuffle( $chars ), 0, $length );
         
    return $password; 
}

$hex = strToHex('juliju77@gmail.com');
echo $hex;
echo "<br>";
$emede5 = "T_".strToMD5('SFF_juliju77@gmail.com');
echo $emede5;
echo "<br>";
$pass_gen = randomPassword(16);
echo $pass_gen;
?>