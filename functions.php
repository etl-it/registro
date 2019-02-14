
<?php

/*  Esta función nos permite conctarnos al servidor de ldap del departamento.

PARAMETROS DE ENTRADAS:

      $user --> Usuario que queremos buscar en el árbol.
      $passwd --> Contraseña del usuario.
      $arbol --> Este parámetro lo utilizamos para contorlar a que árbol del departamento queremos consultar,
                  el de alumnos o el de administradores.
PARAMETROS DEVUELTOS:

      $ds --> Es la consulta al servidor que utilizaremos despues para comprobar si hay fallo o no.
      $ldaprdn --> Es el árbol completo en el que vamos a consultar.
      $ldappass --> Contraseña de ldap.

*/
function conect_ldap($user , $passwd , $arbol){

  $ds = ldap_connect ("ldaps://repldap.lab.it.uc3m.es",636) //Nos conectamos al servidor de ldap
  or die ("Could not connect to LDAP Server");
  $ldaprdn = "uid=".$user.",ou=".$arbol.",dc=lab,dc=it,dc=uc3m,dc=es";
  $ldappass = $passwd;
  ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

    return array ($ds , $ldaprdn , $ldappass);

}




?>