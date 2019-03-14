<?php
/**
 * @brief		Member Sync
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	EverPanel
 * @since		15 Feb 2019
 */

namespace IPS\everpanel\extensions\core\MemberSync;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Member Sync
 */
class _EverPanelSync
{
	/**
	 * Member account has been created
	 *
	 * @param	$member	\IPS\Member	New member account
	 * @return	void
	 */
	public function onCreateAccount( $member )
	{
		\IPS\Db::i()->insert('everpanel_players',  array('player_name' => NULL, 'player_uuid' => NULL, 'member_id' => $member->member_id, 'api_uuid' => NULL));
	}
	
	/**
	 * Member has validated
	 *
	 * @param	\IPS\Member	$member		Member validated
	 * @return	void
	 */
	public function onValidate( $member )
	{
	
	}
	
	/**
	 * Member has logged on
	 *
	 * @param	\IPS\Member	$member		Member that logged in
	 * @return	void
	 */
	public function onLogin( $member )
	{
	
	}
	
	/**
	 * Member has logged out
	 *
	 * @param	\IPS\Member		$member			Member that logged out
	 * @param	\IPS\Http\Url	$returnUrl	    The URL to send the user back to
	 * @return	void
	 */
	public function onLogout( $member, $returnUrl )
	{
	
	}
	
	/**
	 * Member account has been updated
	 *
	 * @param	$member		\IPS\Member	Member updating profile
	 * @param	$changes	array		The changes
	 * @return	void
	 */
	public function onProfileUpdate( $member, $changes )
	{
	
	}
	
	/**
	 * Member is flagged as spammer
	 *
	 * @param	$member	\IPS\Member	The member
	 * @return	void
	 */
	public function onSetAsSpammer( $member )
	{
		
	}
	
	/**
	 * Member is unflagged as spammer
	 *
	 * @param	$member	\IPS\Member	The member
	 * @return	void
	 */
	public function onUnSetAsSpammer( $member )
	{
		
	}
	
	/**
	 * Member is merged with another member
	 *
	 * @param	\IPS\Member	$member		Member being kept
	 * @param	\IPS\Member	$member2	Member being removed
	 * @return	void
	 */
	public function onMerge( $member, $member2 )
	{
		
	}
	
	/**
	 * Member is deleted
	 *
	 * @param	$member	\IPS\Member	The member
	 * @return	void
	 */
	public function onDelete( $member )
	{

	}

	/**
	 * Email address is changed
	 *
	 * @param	\IPS\Member	$member	The member
	 * @param 	string		$new	New email address
	 * @param 	string		$old	Old email address
	 * @return	void
	 */
	public function onEmailChange( $member, $new, $old )
	{

	}

	/**
	 * Password is changed
	 *
	 * @param	\IPS\Member	$member	The member
	 * @param 	string		$new	New password
	 * @return	void
	 */
	public function onPassChange( $member, $new )
	{

	}
}