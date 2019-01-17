//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_player_profile_url extends _HOOK_CLASS_
{
	/**
	 * @brief	Cached URL
	 */
	protected $_playerUrl	= NULL;

  	public function playerUrl()
	{
		if( $this->_playerUrl === NULL )
		{
			$this->_playerUrl = \IPS\Http\Url::internal( "app=everpanel&module=players&controller=player&pid={$this->member_id}", 'front', 'player', $this->members_seo_name );
		}

		return $this->_playerUrl;
	}
}
