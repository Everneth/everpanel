<?php
/**
 * @brief		EverPanel Application Class
 * @author		<a href='http://everneth.com'>TptMike</a>
 * @copyright	(c) 2018 TptMike
 * @package		Invision Community
 * @subpackage	EverPanel
 * @since		12 Nov 2018
 * @version		
 */
 
namespace IPS\everpanel;

/**
 * EverPanel Application Class
 */
class _Application extends \IPS\Application
{
	/**
	 * [Node] Get Icon for tree
	 *
	 * @note	Return the class for the icon (e.g. 'globe')
	 * @return	string|null
	 */
	protected function get__icon()
	{
		return 'coffee';
	}
}