<?php


namespace IPS\everpanel\modules\admin\consoles;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * mainConsole
 */
class _mainConsole extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'mainConsole_manage' );
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		// This is the default method if no 'do' parameter is specified
		@include( \IPS\ROOT_PATH . '/applications/everpanel/sources/MulticraftAPI/MulticraftAPI.php' );
		$mc_api = new \IPS\everpanel\MulticraftAPI(\IPS\Settings::i()->multicraft_api_url, \IPS\Settings::i()->multicraft_api_user, \IPS\Settings::i()->multicraft_api_key);
		//$mc_api = new \IPS\everpanel\MulticraftAPI(\IPS\Settings::i()->multicraft_api_url, \IPS\Settings::i()->multicraft_api_user, \IPS\Settings::i()->multicraft_api_key);
		$server = $mc_api->getServerStatus(1, true);

		//$name = $server['data']['status'];
		//$name = 'Toodles';
		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('main_server_console');
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'consoles' )->mainConsole( 'menu__everpanel_settings_multicraft_api', $server );
		
	}
	
	// Create new methods with the same name as the 'do' parameter which should execute it
}