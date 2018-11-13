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
		return "Hello, World!";
	}
}