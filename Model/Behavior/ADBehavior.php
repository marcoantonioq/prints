<?php

class ADBehavior extends ModelBehavior {

	/**
	 * Instância de classe AD
	 * @var object
	 */
	private $ldap_host = "dc-goias.ifg.br";
    private $ldap_port = "389";
    private $base_dn = "OU=IFG,DC=ifg,DC=br";
    private $ldap_user ="goiservice";
    private $ldap_pass = "Brasil05";
	private $suffix = '@ifg.br';
    private $attr = array("displayname", "mail", "mobile", "homephone", "telephonenumber", "streetaddress", "postalcode", "physicaldeliveryofficename", "l", "group");
	

	private function getUserAD($suap = null){

    	$filter = "name={$suap}"; // suap

	    $connect = ldap_connect( $this->ldap_host, $this->ldap_port);
	    ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);

	    $bind = ldap_bind($connect, $this->ldap_user, $this->ldap_pass); // or die("Erro bind");
	    $read = ldap_search($connect, $this->base_dn, $filter, $this->attr); // or die("Erro search");
	    
	    $user = ldap_get_entries($connect, $read); 

	    ldap_close($connect);
	    // ldap_unbind($connect);

	    return $user;
	}

	public function getUser(Model $Model, $suap = null){
		return $this->getUserAD($suap);
	}



	public function sycAD(Model $Model, $users = array()){

		foreach ($users as $key => $user) {
			if (empty($user['User']['suap']))
				continue;
			
			$userAD = $this->getUserAD($user['User']['suap']);
			
			if (!empty($userAD['0']['displayname']['0'])) 
				$users[$key]['User']['name'] = $userAD['0']['displayname']['0'];
			if (!empty($userAD['0']['mail']['0'])) 
				$users[$key]['User']['email'] = $userAD['0']['mail']['0'];
			// pr($userAD);
		}
		// pr($users); exit;
		foreach ($users as $key => $user) {
			$Model->save($user);
		}
		return $users;
	}	

	public function authUser(Model $Model, $suap = null, $pass = null) {
		
		$connect 	= ldap_connect( $this->ldap_host, $this->ldap_port);		
		ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
		$ldap_bind 	= @ldap_bind($connect, "{$suap}{$this->suffix}", $pass);
		
		ldap_close($connect);
		return $ldap_bind;
	}
}