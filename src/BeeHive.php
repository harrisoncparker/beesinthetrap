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
	/** @var array  */
	private $deadBees = [
		'Queen Bee' => 0,
		'Worker Bee' => 0,
		'Drone Bee' => 0
	];

	/**
	 * BeeHive constructor.
	 */
	public function __construct()
	{
		$this->startNewBeeHive();
	}

	public function hiveIntact()
	{
		return $this->hiveContains('Queen Bee') && count($this->beesInHive);
	}

	private function hiveContains($beeType)
	{
		$count = 0;
		foreach ($this->beesInHive as $bee) {
			if($bee->getType() === $beeType) {
				$count++;
			}
		}
		return $count;
	}

	/**
	 * Start a new game by generating a new beehive for the player to destroy.
	 */
	private function startNewBeeHive()
	{
		print "Starting new game: Bees In The Trap\n\n";
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

	public function displayBeehiveInformation()
	{
		if($this->hiveIntact()) {
			echo "The hive is still intact and the Queen Bee is alive.\n";
			$beeGroups = [
				'Queen Bee' => 0,
				'Worker Bee' => 0,
				'Drone Bee' => 0,
			];

			foreach ($this->getBeeInformation() as $bee) {
				switch($bee['type']){
					case 'Queen Bee':
						$beeGroups['Queen Bee']++;
						break;
					case 'Worker Bee':
						$beeGroups['Worker Bee']++;
						break;
					case 'Drone Bee':
						$beeGroups['Drone Bee']++;
						break;
				}
			}

			foreach ($beeGroups as $beeGroupName => $quantity) {
				if($beeGroupName != 'Queen Bee') {
					echo "There are $quantity {$beeGroupName}s alive and "
						 . $this->deadBees[$beeGroupName] . " dead\n";
				}
			}


		} else {
			echo "This hive has been destroyed\n";
			echo "Attack a new hive? (y/n)\n";
		}
	}
}