<?php


namespace IPS\everpanel\modules\admin\houses;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * manageHouses
 */
class _manageHouses extends \IPS\Dispatcher\Controller
{
	/**
	 * Node Class
	 */
	protected $nodeClass = 'IPS\everpanel\House';
	
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'manageHouses_manage' );
		parent::execute();
	}
}