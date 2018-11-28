<?php
/**
 * @brief		MembPlayerer Model
 * @author		<a href='https://www.everneth.com'>Everneth SMP</a>
 * @copyright	(c) Everneth
 * @license		MIT
 * @package		EverPanel
 * @since		27 Nov 2018
 */

 namespace everpanel;

 /* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
	exit;
}

/**
 * Player Model
 */

 class _Player extends \IPS\Patterns\ActiveRecord
 {
     	/**
	 * @brief	Application
	 */
	public static $application = 'everpanel';
	
	/* !\IPS\Patterns\ActiveRecord */
	
	/**
	 * @brief	[ActiveRecord] Multiton Store
	 */
	protected static $multitons;
	
	/**
	 * @brief	[ActiveRecord] Database Table
	 */
	public static $databaseTable = 'everpanel_players';
		
	/**
	 * @brief	[ActiveRecord] ID Database Column
	 */
	public static $databaseColumnId = 'player_id';
	
	/**
	 * @brief	[ActiveRecord] Database ID Fields
	 */
	protected static $databaseIdFields = array( 'player_uuid' );
	
	/**
	 * @brief	[ActiveRecord] Multiton Map
	 */
	protected static $multitonMap	= array();
	
	/**
	 * @brief	Bitwise values for members_bitoptions field
	 */
    //TODO: bitwise access
    	/**
	 * Load Record
	 * We override it so we return a guest object for a non-existant member
	 *
	 * @see		\IPS\Db::build
	 * @param	int|string	$id					ID
	 * @param	string		$idField			The database column that the $id parameter pertains to (NULL will use static::$databaseColumnId)
	 * @param	mixed		$extraWhereClause	Additional where clause (see \IPS\Db::build for details)
	 * @return	static
	 */
	public static function load( $id, $idField=NULL, $extraWhereClause=NULL )
    {
		try
		{
			if( $id === NULL OR $id === 0 OR $id === '' )
			{
				$classname = get_called_class();
				return new $classname;
			}
			else
			{
				$player = parent::load( $id, $idField, $extraWhereClause );
				return $member;
			}
		}
		catch ( \OutOfRangeException $e )
		{
			$classname = get_called_class();
			return new $classname;
		}
    }
    
    /**
	 * [ActiveRecord] Save Changed Columns
	 *
	 * @return	void
	 * @note	We have to be careful when upgrading in case we are coming from an older version
	 */
	public function save()
	{
		parent::save();
    }
    
    /* !Getters/Setters Data */

    /**
	 * Get name
	 *
	 * @return	string
	 */
	public function get_player_name()
	{
		if( !isset( $this->_data['player_name'] ) )
		{
			return \IPS\Member::loggedIn()->language()->addToStack('unknown');
		}
		
		return $this->player_id ? $this->_data['player_name'] : \IPS\Member::loggedIn()->language()->addToStack( 'guest_name_shown', NULL, array( 'sprintf' => array( $this->_data['player_name'] ) ) );
    }
    
    	/**
	 * Set name
	 *
	 * @param	string	$value	Value
	 * @return	void
	 */
	public function set_player_name( $value )
	{
		$this->_data['player_name']				= $value;
    }
    
        /**
	 * Get uuid
	 *
	 * @return	string
	 */
	public function get_player_uuid()
	{
		if( !isset( $this->_data['player_uuid'] ) )
		{
			return \IPS\Member::loggedIn()->language()->addToStack('unknown');
		}
		
		return $this->player_id ? $this->_data['player_uuid'] : \IPS\Member::loggedIn()->language()->addToStack( 'guest_name_shown', NULL, array( 'sprintf' => array( $this->_data['player_uuid'] ) ) );
    }
    
    	/**
	 * Set uuid
	 *
	 * @param	string	$value	Value
	 * @return	void
	 */
	public function set_player_uuid( $value )
	{
		$this->_data['player_uuid']				= $value;
	}

 }