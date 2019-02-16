<?php
/**
 * @brief		Profile Completion Extension
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	EverPanel
 * @since		11 Feb 2019
 */

namespace IPS\everpanel\extensions\core\ProfileSteps;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Profile Completion Extension
 */
class _MinecraftStep
{
	/**
	 * Available Actions to complete steps
	 *
	 * @return	array	array( 'key' => 'lang_string' )
	 */
	public static function actions()
	{
		$return = array( 'player_profile' => 'complete_profile_player_profile' );

		return $return;
	}

	/**
	 * Available sub actions to complete steps
	 *
	 * @return	array	array( 'key' => 'lang_string' )
	 */
	public static function subActions()
	{
		$return['player_profile'] = array(
			'player_ign'			=> 'complete_profile_ign'
		);

		return $return;
	}

	/**
	 * Can the actions have multiple choices?
	 *
	 * @param	string		$action		Action key (basic_profile, etc)
	 * @return	boolean
	 */
	public static function actionMultipleChoice( $action )
	{
		return TRUE;
	}
	
	/**
	 * Has a specific step been completed?
	 *
	 * @param	\IPS\Member\ProfileStep	$step   The step to check
	 * @param	\IPS\Member|NULL		$member The member to check, or NULL for currently logged in
	 * @return	bool
	 */
	public function completed( \IPS\Member\ProfileStep $step, \IPS\Member $member = NULL )
	{
		$member = $member ?: \IPS\Member::loggedIn();
		
		if ( ! $member->group['g_edit_profile'] )
		{
			/* Member has no permission to edit profile */
			return TRUE;
		}
		
		/* Does the member have any profile fields? */
		if ( ! count( $member->profileFields() ) ) 
		{
			return FALSE;
		}
		
		$done = 0;
		foreach( $step->subcompletion_act as $item )
		{

		}
		return ( $done === count( $step->subcompletion_act ) );
	}
	
	/**
	 * Can be set as required?
	 *
	 * @return	array
	 * @note	This is intended for items which have their own independent settings and dedicated enable pages, such as MFA and Social Login integration
	 */
	public static function canBeRequired()
	{
		return array('player_profile');
	}
	
	/**
	 * Action URL
	 *
	 * @param	string				$action The action
	 * @param	\IPS\Member|NULL	$member The member, or NULL for currently logged in
	 * @return	\IPS\Http\Url
	 */
	public function url( $action, \IPS\Member $member = NULL )
	{
		return \IPS\Http\Url::internal(  );
	}
	
	/**
	 * Post ACP Save
	 *
	 * @param	\IPS\Member\ProfileStep		$step   The step
	 * @param	array						$values Form Values
	 * @return	void
	 */
	public function postAcpSave( \IPS\Member\ProfileStep $step, array $values )
	{
		
	}
	
	/**
	 * Format Form Values
	 *
	 * @param	array                   $values The values from the form
	 * @param	\IPS\Member             $member The member
	 * @param	\IPS\Helpers\Form       $form   The form
	 * @return	void
	 */
	public static function formatFormValues( $values, &$member, &$form )
	{
		
	}

	/**
	 * Wizard Steps
	 *
	 * @param	\IPS\Member	$member	Member or NULL for currently logged in member
	 * @return	array
	 */
	public static function wizard( \IPS\Member $member = NULL )
	{
		return array(  );
	}

	/**
	 * Post Delete
	 * @param	\IPS\Member\ProfileStep		The step
	 *
	 * @return	void
	 */
	public function onDelete( \IPS\Member\ProfileStep $step )
    {

    }
}