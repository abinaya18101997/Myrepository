<?php
function authenticate($user,$password) {
	if(empty($user) || empty($password)) return false;
 
	// active directory server
	$ldap_host = " GINBAC01.utcain.com";
 
	// active directory DN (base location of ldap search)
	$ldap_dn = "OU=UTAS,OU=APAC,OU=CSC_Users,OU=.Resources,DC=utcain,DC=com";

	// active directory user group name
	$ldap_user_group = "WebUsers";
 
	// domain, for purposes of constructing $user
	$ldap_usr_dom = '@UTCAIN.COM';
 
	// connect to active directory
	$ldap = ldap_connect($ldap_host);
 
	// configure ldap params
	ldap_set_option($ldap,LDAP_OPT_PROTOCOL_VERSION,3);
	ldap_set_option($ldap,LDAP_OPT_REFERRALS,0);
 
	// verify user and password
	if($bind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(sAMAccountName=".$user")";
		$attr = array("memberof");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);
 
		if($access != 0) {
			// establish session variables
			$_SESSION['user'] = $password;
			$_SESSION['access'] = $access;
			return true;
		} else {
			// user has no rights
			return false;
		}
 
	} else {
		// invalid name or password
		return false;
	}
}
?>