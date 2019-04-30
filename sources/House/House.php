<?php
/**
 * @brief		House Model
 * @author		<a href='https://www.everneth.com'>Everneth SMP</a>
 * @copyright	(c) Everneth
 * @license		MIT
 * @package		EverPanel
 * @since		29 Apr 2019
 */

namespace IPS\everpanel;

 /* To prevent PHP errors (extending class does not exist) revealing path */
 if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
 {
     header( ( isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0' ) . ' 403 Forbidden' );
     exit;
 }

class _House extends \IPS\Node\Model {
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
	public static $databaseTable = 'everpanel_houses';
		
	/**
	 * @brief	[ActiveRecord] ID Database Column
	 */
	public static $databaseColumnId = 'id';
	
	/**
	 * @brief	[ActiveRecord] Database ID Fields
	 */
    protected static $databaseIdFields = array( 'name' );
    
      /**
     * @var string
     */
    //public static $databaseColumnOrder = 'house_name';
    //public static $databaseColumnParent = 'parent';
    public static $databasePrefix = 'house_';
    public static $nodeSortable = false;
    public static $nodeTitle = 'everpanel_houses';
	
	/**
	 * @brief	[ActiveRecord] Multiton Map
	 */
    protected static $multitonMap	= array();
    
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
				$house = parent::load( $id, $idField, $extraWhereClause );
				return $house;
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

    /**
     * @return mixed
     */
    protected function get__name()
    {
        return $this->name;
    }

    /**
     * @param $form
     */
    public function form( &$form )
    {
        $form->add(new \IPS\Helpers\Form\YesNo('house_enabled', isset( $this->enabled ) ? $this->enabled : TRUE, FALSE, array()));
        $form->add( new \IPS\Helpers\Form\Text( 'house_name', $this->name, TRUE, array() ) );
        $form->add( new \IPS\Helpers\Form\Upload( 'house_icon', $this->icon ? \IPS\File::get('everpanel_Houses', $this->icon ) : NULL, TRUE, array('storageExtension' => 'everpanel_Houses', 'storageContainer' => 'houses', 'image' => TRUE, 'allowedFileTypes' => array( 'png', 'jpg', 'gif', 'svg' ), 'obscure' => true ), NULL, NULL, NULL, 'type_url' ) );
        $form->add( new \IPS\Helpers\Form\Editor( 'house_description',  $this->id ? $this->description : NULL, TRUE, array ('app' => 'everpanel', 'key' => 'Houses', 'autoSaveKey' => 'houses-new-house', 'attachIds' => ( $this->id === NULL ? NULL : array( $this->id ) ) ) ) );
    }
}