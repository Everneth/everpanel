//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_player_profile_posturl extends _HOOK_CLASS_
{

/* !Hook Data - DO NOT REMOVE */
public static function hookData() {
 return array_merge_recursive( array (
  'postContainer' => 
  array (
    0 => 
    array (
      'selector' => 'article > aside.ipsComment_author.cAuthorPane.ipsColumn.ipsColumn_medium.ipsResponsive_hidePhone > ul.cAuthorPane_info.ipsList_reset',
      'type' => 'add_inside_end',
      'content' => '{template="playerLink" app="everpanel" group="global" params="$comment->author()"}',
    ),
  ),
), parent::hookData() );
}
/* End Hook Data */


}
