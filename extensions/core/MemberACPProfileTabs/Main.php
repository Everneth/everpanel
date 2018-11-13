<?php
/**
 * @brief		ACP Member Profile Tab
 * @author		<a href='https://www.invisioncommunity.com'>Invision Power Services, Inc.</a>
 * @copyright	(c) Invision Power Services, Inc.
 * @license		https://www.invisioncommunity.com/legal/standards/
 * @package		Invision Community
 * @subpackage	EverPanel
 * @since		13 Nov 2018
 */

namespace IPS\everpanel\extensions\core\MemberACPProfileTabs;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * @brief	ACP Member Profile Tab
 */
class _Main extends \IPS\core\MemberACPProfile\MainTab
{	
	/**
	 * Get main-column blocks
	 *
	 * @return	array
	 */
	public function mainColumnBlocks()
	{
		return array(
			'IPS\everpanel\extensions\core\MemberACPProfileBlocks\AccessLevels',
		);
	}
	public function leftColumnBlocks()
	{
		return array(
			'IPS\everpanel\extensions\core\MemberACPProfileBlocks\AccessLevels',
		);
	}
}