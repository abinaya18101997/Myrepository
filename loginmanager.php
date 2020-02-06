<?php
$username = $_POST['HRMS_id'];
$password = $_POST['password'];


$ldapconfig['host'] = 'GINBAC01.utcain.com';//CHANGE THIS TO THE CORRECT LDAP SERVER
$ldapconfig['port'] = '389';
$ldapconfig['basedn'] = 'DC=utcain,DC=com';//CHANGE THIS TO THE CORRECT BASE DN
$ldapconfig['usersdn'] = 'OU=UTAS,OU=APAC,OU=CSC_Users,OU=.Resources';//CHANGE THIS TO THE CORRECT USER OU/CN
$ds=ldap_connect($ldapconfig['host'], $ldapconfig['port']);

ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
ldap_set_option($ds, LDAP_OPT_NETWORK_TIMEOUT, 10);

$dn="uid=".$username.",".$ldapconfig['usersdn'].",".$ldapconfig['basedn'];
if(isset($_POST['username'])){
if ($bind=ldap_bind($ds, $dn, $password)) {
  echo("Login correct");//REPLACE THIS WITH THE CORRECT FUNCTION LIKE A REDIRECT;
} else {
 echo "Login Failed: Please check your username or password";
}
}
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<form action="" method="post">
<input name="HRMS_id">
<input type="password" name="password">
<input type="submit" value="Submit">
</form>
</body>
</html>