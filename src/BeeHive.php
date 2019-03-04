<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:51
 */

namespace Game;

use Game\Bees\QueenBee;
use Game\Bees\WorkerBee;
use Game\Bees\DroneBee;

class BeeHive
{
	/**
	 * The quantity of each bee type
	 * @var array
	 */
	private $beeQuantities = [
		QueenBee::class  => 1,
		WorkerBee::class => 5,
		DroneBee::class  => 8
	];

	/**
	 * An array of all the bees in this hive
	 * @var array
	 */
	private $beesInHive = [];

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
	private function startNewBeeHive()
	{
		print "Starting new game: Bees In The Trap\n";
		$this->addBeesToHive();
	}

	/**
	 * Add the initial bees to the hive
	 */
	private function addBeesToHive()
	{
		$beeID = 1;
		foreach ( $this->beeQuantities as $beeType => $quantity ) {
			$beeCount = 0;
			while ( $beeCount < $quantity ) {
				$this->beesInHive[] = new $beeType($beeID);
				$beeCount++;
				$beeID++;
			}
		}
	}

	/**
	 * @return array
	 */
	public function getBeeInformation()
	{
		return array_map( function ($bee) {
			return [
				'type' => $bee->getType(),
				'hitPoints' => $bee->getHitPoints(),
			];
		}, $this->beesInHive );
	}
}