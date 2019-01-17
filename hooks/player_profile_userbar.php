//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_player_profile_userbar extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'userBar' => 
  array (
    0 => 
    array (
      'selector' => '#elUserLink_menu > li.ipsMenu_item[data-menuitem=\'profile\']',
      'type' => 'add_after',
      'content' => '				{{if \IPS\Member::loggedIn()->canAccessModule( \IPS\Application\Module::get( \'everpanel\', \'players\', \'front\' ) )}}
					<li class=\'ipsMenu_item\' data-menuItem=\'profile\'><a href=\'{member="playerUrl()"}\' title=\'{lang="view_my_profile"}\'>{lang="menu_player_profile"}</a></li>
				{{endif}}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
