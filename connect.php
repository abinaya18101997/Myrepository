<?php

// make sure your host is the correct one
// that you issued your secure certificate to
$ldaphost = "GINBAC01.utcain.com";

// Connecting to LDAP
$ldapconn = ldap_connect($ldaphost)
          or die("That LDAP-URI was not parseable");

?>