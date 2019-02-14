
<?php

// Esta función nos permite conctarnos al servidor de ldap que queremos.

function conect_ldap($user , $passwd){

  $ds = ldap_connect ("ldaps://repldap.lab.it.uc3m.es",636) //Nos conectamos al servidor de ldap
  or die ("Could not connect to LDAP Server");
  $ldaprdn = "uid=".$user.",ou=Alum,dc=lab,dc=it,dc=uc3m,dc=es";
  $ldappass = $passwd;
  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

    return array ($ds , $ldaprdn , $ldappass);

}

?>