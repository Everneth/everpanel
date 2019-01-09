<?php


namespace IPS\everpanel\modules\front\system;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * settings
 */
class _settings extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		/* Only logged in members */
		if ( !\IPS\Member::loggedIn()->member_id and !in_array( \IPS\Request::i()->do, array( 'mfarecovery', 'mfarecoveryvalidate' ) ) )
		{
			\IPS\Output::i()->error( 'no_module_permission_guest', '2C122/1', 403, '' );
		}
		
		\IPS\Output::i()->sidebar['enabled'] = FALSE;
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		/* Work out output */
		$area = \IPS\Request::i()->area ?: 'overview';
		if ( method_exists( $this, "_{$area}" ) )
		{
			$output = call_user_func( array( $this, "_{$area}" ) );
		}

		\IPS\Output::i()->title = \IPS\Member::loggedIn()->language()->addToStack('settings');
		\IPS\Output::i()->breadcrumb[] = array( NULL, \IPS\Member::loggedIn()->language()->addToStack('settings') );
		if ( !\IPS\Request::i()->isAjax() )
		{
			if ( \IPS\Request::i()->service )
			{
				$area = "{$area}_" . \IPS\Request::i()->service;
			}
            
            \IPS\Output::i()->cssFiles	= array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'styles/settings.css' ) );
            
            if ( \IPS\Theme::i()->settings['responsive'] )
            {
                \IPS\Output::i()->cssFiles	= array_merge( \IPS\Output::i()->cssFiles, \IPS\Theme::i()->css( 'styles/settings_responsive.css' ) );
            }
            
            if ( $output )
            {
				\IPS\Output::i()->output .= $this->_wrapOutputInTemplate( $area, $output );
			}
		}
		elseif ( $output )
		{
			\IPS\Output::i()->output .= $output;
		}
	}

	/**
	 * Wrap output in template
	 *
	 * @param	string	$area	Active area
	 * @param	string	$output	Output
	 * @return	string
	 */
	protected function _wrapOutputInTemplate( $area, $output )
	{
		/* Add sync services */
		//$services = \IPS\core\ProfileSync\ProfileSyncAbstract::services();
		
		/* Return */
		return \IPS\Theme::i()->getTemplate( 'system' )->settings( $area, $output );
	}
	/**
	 * Overview
	 *
	 * @return	string
	 */
	protected function _overview()
	{
		// Autoload the member
		$member = \IPS\Member::load(\IPS\Member::loggedIn()->member_id);
		$player = \IPS\everpanel\Player::load($member->member_id, 'member_id');
		
		//Did we find a player?
		if($player == NULL)
		{
			//No lets create a temporary one in memory
			$player = new \IPS\everpanel\Player;
		}
		return \IPS\Theme::i()->getTemplate( 'system' )->settingsOverview($player);
	}

	/**
	 * Name
	 * @return string
	 */
	protected function _name()
	{
		// Autoload the member
		$member = \IPS\Member::load(\IPS\Member::loggedIn()->member_id);
		$player = \IPS\everpanel\Player::load($member->member_id, 'member_id');

		/* Build form */
		$form = new \IPS\Helpers\Form;

		// Check if its the default insert player or an active record
		if($player->member_id == NULL)
		{
			// Null, allow the edit
			$form->add( new \IPS\Helpers\Form\Text( 'ep_name', $player->player_name, TRUE));
		}
		else
		{
			// Not null, disallow the edit
			$form->add( new \IPS\Helpers\Form\Text( 'ep_name', $player->player_name, TRUE, array('disabled' => TRUE)));
		}

		/* Handle Submissions */
		if ( $values = $form->values() )
		{
			// Test if the record exists in the database, if it doesn't our player is unknown
			// If it does, our player load has an active record
			if(strcmp($player->player_name, 'Unknown') != 0)
			{
				$row = \IPS\Db::i()->insert('everpanel_players',  array('player_name' => NULL, 'player_uuid' => NULL, 'member_id' => $member->member_id, 'api_uuid' => NULL));
				$player = \IPS\everpanel\Player::load($member->member_id, 'member_id');		
			}
			$player->player_name = $values['ep_name'];
			$player->player_uuid = \IPS\everpanel\MojangAPI::getUuid($values['ep_name']);
			$player->member_id = $member->member_id;

			$UUID = $player->player_uuid;
			$UUID = mb_substr($UUID, 0, 8) . '-' . mb_substr($UUID, 8, 4) . '-' . mb_substr($UUID, 12, 4) . '-' . mb_substr($UUID, 16, 4)  . '-' . mb_substr($UUID, 20);
			$player->api_uuid = $UUID;
			$player->player_seo_name = mb_strtolower($player->player_name);
			$player->save();
			//We're done (?)
			\IPS\Output::i()->redirect( \IPS\Http\Url::internal( 'app=everpanel&module=system&controller=settings', 'front', 'settings' ));			
		}
		return \IPS\Theme::i()->getTemplate( 'system' )->settingsName($form, $player, $member);
	}
	// Create new methods with the same name as the 'do' parameter which should execute it
}