<?php
/**
 * @brief		ACP Member Profile Block
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	EverPanel
 * @since		13 Nov 2018
 */

namespace IPS\everpanel\extensions\core\MemberACPProfileBlocks;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * @brief	ACP Member Profile Block
 */
class _PlayerInfo extends \IPS\core\MemberACPProfile\Block
{
	/**
	 * Get output
	 *
	 * @return	string
	 */
	public function output()
	{
		$player = \IPS\everpanel\Player::load($this->member->member_id, 'member_id');
		return \IPS\Theme::i()->getTemplate('memberprofile', 'everpanel', 'admin')->playerInfo($this->member, $player);
	}

	/**
	 * Get Block Title
	 *
	 * @return	string
	 */
	public function blockTitle()
	{
		return 'profile_data';
	}

	/**
	 * Show Edit Link?
	 *
	 * @return	bool
	 */
	protected function showEditLink()
	{
		return true;
	}

	/**
	 * Edit Window
	 *
	 * @return	string
	 */
	public function edit()
	{
		/* Build basic form */
		$form = new \IPS\Helpers\Form;
		$form->addHeader('profile_data');
		$form->add( new \IPS\Helpers\Form\Text( 'ep_name', $player->player_name, TRUE));
		$form->add( new \IPS\Helpers\Form\Text( 'ep_uuid', $player->player_uuid, TRUE));
		return $form;
	}
}