<?php


namespace IPS\everpanel\modules\admin\settings;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * emiApi
 */
class _emiApi extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		\IPS\Dispatcher::i()->checkAcpPermission( 'emiApi_manage' );
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
		$key_input = new \IPS\Helpers\Form\Text('emi_api_key',\IPS\Settings::i()->emi_api_key);
		$key_input->description = "This is the private key issued by EMI to send REST requests.";
		$form->add( $key_input, NULL, NULL, NULL, 'emi_api_key' );

		\IPS\Output::i()->title		= \IPS\Member::loggedIn()->language()->addToStack('emi_api_settings');
		\IPS\Output::i()->output	= \IPS\Theme::i()->getTemplate( 'global' )->block( 'menu__everpanel_settings_emi_api', $form );
		
		if ( $values = $form->values() )
		{
			$form->saveAsSettings($values);
		}
		
		// This is the default method if no 'do' parameter is specified
	}
	
	// Create new methods with the same name as the 'do' parameter which should execute it
}