<?php


namespace IPS\everpanel\modules\front\players;

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * profile
 */
class _player extends \IPS\Dispatcher\Controller
{
	/**
	 * Execute
	 *
	 * @return	void
	 */
	public function execute()
	{
		/* Load Member */
		$this->member = \IPS\Member::load( \IPS\Request::i()->pid );
		if ( !$this->member->member_id )
		{
			\IPS\Output::i()->error( 'node_error', '2C138/1', 404, '' );
		}
		parent::execute();
	}

	/**
	 * ...
	 *
	 * @return	void
	 */
	protected function manage()
	{
		$player = \IPS\everpanel\Player::load($this->member->member_id, 'member_id');
		//\IPS\Output::i()->linkTags['canonical'] = (string) $this->member->url();
		\IPS\Output::i()->output = \IPS\Theme::i()->getTemplate( 'players' )->player( $this->member, $player );
	}
	
	// Create new methods with the same name as the 'do' parameter which should execute it
}