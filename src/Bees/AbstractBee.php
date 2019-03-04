<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 11:45
 */

namespace Game\Bees;


abstract class AbstractBee
{
	private $type;
	private $HitPoints;

	public static function showInformation()
	{
		echo "This is some bee information \n";
	}
}