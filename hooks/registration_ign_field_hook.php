//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_registration_ign_field_hook extends _HOOK_CLASS_
{
  
	/**
	 * Build Registration Form
	 *
	 * @return	\IPS\Helpers\Form
	 */
	static public function buildRegistrationForm()
	{
		$form = parent::buildRegistrationForm();
    $form->add( new \IPS\Helpers\Form\Text( 'ep_ign', NULL, TRUE, array( 'maxLength' => 16 ) ), 'password_confirm' );
    return $form;
	}
  
	/**
	 * Create Member
	 *
	 * @param array $values       Values from form
	 * @param array $profileFields    Profile field values from registration
	 * @return  \IPS\Member
	 */
	static public function _createMember( $values, $profileFields )
	{
      
      $member = parent::_createMember( $values, $profileFields );
			
			$row = \IPS\Db::i()->insert('everpanel_players',  array('player_name' => NULL, 'player_uuid' => NULL, 'member_id' => $member->member_id, 'api_uuid' => NULL, 'api_uuid' => NULL, 'player_seo_name' => NULL));
			$player = \IPS\everpanel\Player::load($member->member_id, 'member_id');
			
			$player->member_id = $member->member_id;
			$player->player_name = $values['ep_ign'];
			$player->player_uuid = \IPS\everpanel\MojangAPI::getUuid($values['ep_ign']);
			$UUID = $player->player_uuid;
			$UUID = mb_substr($UUID, 0, 8) . '-' . mb_substr($UUID, 8, 4) . '-' . mb_substr($UUID, 12, 4) . '-' . mb_substr($UUID, 16, 4)  . '-' . mb_substr($UUID, 20);
			$player->api_uuid = $UUID;
			$player->player_seo_name = mb_strtolower($player->player_name);
			$player->save();
			
      return $member;
	}

}
