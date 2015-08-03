<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

$config =
	array(
		// set on "base_url" the relative url that point to HybridAuth Endpoint
		'base_url' => '/hauth/endpoint',

		"providers" => array (
			// openid providers
			"OpenID" => array (
				"enabled" => false
			),

			"Yahoo" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" ),
			),

			"AOL"  => array (
				"enabled" => false
			),

			"Google" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "937720646213-dmaacrh1dedl6fpqs0n9hosb6sf9vd0q.apps.googleusercontent.com", "secret" => "SkriBBK9NdYvE1gF9nYrkWtF" )
				
			),

			"Facebook" => array (
				"enabled" => true,
//				"keys"    => array ( "id" => "1643177945900345", "secret" => "0b3009f12c6b831b43fc58f02acc5451" ),
				"keys"    => array ( "id" => "1452795161694777", "secret" => "1e14657671351bdb6ab188d5ea0c2ebd" ),
                "scope"   => "email, user_about_me, user_birthday, user_hometown, user_website,publish_actions"
			),

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "kqLspf15ZKqldwvkU0tLCSLw8", "secret" => "Wu8ZrqYivsTkkkMgdiVNtyXxoUpBqUP6PCRGE3wgGnYMjFKqDg" )
			),

			// windows live
			"Live" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),

			"MySpace" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"LinkedIn" => array (
				"enabled" => false,
				"keys"    => array ( "key" => "", "secret" => "" )
			),

			"Foursquare" => array (
				"enabled" => false,
				"keys"    => array ( "id" => "", "secret" => "" )
			),
			"Instagram" => array (
				"enabled" => true,
				"keys"    => array ( "id" => "a9bf45427ca2419d98537e2b992b71b3", "secret" => "02bf79f5db8142a29c36065f374d1c95" )
			),
		),

		// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
		"debug_mode" => false,

		"debug_file" => APPPATH.'/logs/hybridauth.log',
	);


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */