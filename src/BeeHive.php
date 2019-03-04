<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:51
 */

namespace Game;

class BeeHive
{
	/**
	 * BeeHive constructor.
	 */
	public function __construct()
	{
		$this->startNewBeeHive();
	}

	/**
	 * Start a new game by generating a new beehive for the player to destroy.
	 */
	public function startNewBeeHive()
	{
		print "Starting new game: Bees In The Trap\n";
	}
}