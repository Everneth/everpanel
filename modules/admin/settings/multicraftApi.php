<?php


namespace IPS\everpanel\modules\admin\settings;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * multicraftApi
 */
class _multicraftApi extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'multicraftApi_manage' );
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		$form = new \IPS\Helpers\Form;
		$form->add( new \IPS\Helpers\Form\Text('multicraft_api_key',\IPS\Settings::i()->multicraft_api_key), NULL, NULL, NULL, 'multicraft_api_key' );
		$form->add( new \IPS\Helpers\Form\Text('multicraft_api_user',\IPS\Settings::i()->multicraft_api_user), NULL, NULL, NULL, 'multicraft_api_user' );
		$form->add( new \IPS\Helpers\Form\Text('multicraft_api_url',\IPS\Settings::i()->multicraft_api_url), NULL, NULL, NULL, 'multicraft_api_url' );

		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('multicraft_api_settings');
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global' )->block( 'menu__everpanel_settings_multicraft_api', $form );
		
		if ( $values = $form->values() )
		{
			$form->saveAsSettings($values);
		}
		// This is the default method if no 'do' parameter is specified
	}
	
	// Create new methods with the same name as the 'do' parameter which should execute it
}