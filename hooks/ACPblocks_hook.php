//<?php

/* To prevent PHP errors (extending class does not exist) revealing path */
if ( !defined( '\IPS\SUITE_UNIQUE_KEY' ) )
{
	exit;
}

class everpanel_hook_ACPblocks_hook extends _HOOK_CLASS_
{
	public function mainColumnBlocks()
	{
		$blocks = parent::mainColumnBlocks();

		$blocks[] = '\IPS\everpanel\extensions\core\MemberACPProfileBlocks\RoyalHouseProfileBlock';

		return $blocks;
	}
}
