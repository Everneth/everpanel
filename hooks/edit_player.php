//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_edit_player extends _HOOK_CLASS_
{
  public function editPlayerBlock()
  {
    $player = \IPS\everpanel\Player::load( \IPS\Request::i()->id, 'member_id' );
    if ( !$player->member_id )
		{
			\IPS\Output::i()->error( 'node_error', '2C114/S', 404, '' );
    }
    
    /* Check permission */
		\IPS\Dispatcher::i()->checkAcpPermission( 'member_edit' );
		if ( $member->isAdmin() )
		{
			\IPS\Dispatcher::i()->checkAcpPermission( 'member_edit_admin' );
		}
		
		/* Display */
		$class = \IPS\Request::i()->block;
		$object = new $class( $player );
		\IPS\Output::i()->output = $object->editPlayer();
  }

  public function editPlayer()
  {
    /* Check permission */
		\IPS\Dispatcher::i()->checkAcpPermission( 'member_edit' );
		
		/* Load Member */
    $player = \IPS\everpanel\Player::load( \IPS\Request::i()->id, 'member_id' );
    $member = \IPS\Member::load( \IPS\Request::i()->id );

		if ( !$player->member_id )
		{
			\IPS\Output::i()->error( 'node_error', '2C114/1', 404, '' );
		}
		if ( $member->isAdmin() )
		{
			\IPS\Dispatcher::i()->checkAcpPermission( 'member_edit_admin' );
    }
    $form = new \IPS\Helpers\Form;
    /* Handle submissions */
		if ( $values = $form->values() )
		{
			foreach ( $extensions as $class )
			{
				$class->save( $values, $player );
			}
			$player->save();
			
			\IPS\Session::i()->log( 'acplog__members_edited_prefs', array( $member->name => FALSE ) );
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=core&module=members&controller=members&do=view&id=' . $member->member_id ), 'saved' );
		}
		
		/* Display */	
		\IPS\Output::i()->title		= $member->name;
		\IPS\Output::i()->output	= $form;
  }
}
