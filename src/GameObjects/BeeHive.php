<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:51
 */

namespace Game\GameObjects;

use Game\GameObjects\Bees\QueenBee;
use Game\GameObjects\Bees\WorkerBee;
use Game\GameObjects\Bees\DroneBee;

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

	private $hitsTaken = 0;

	/**
	 * BeeHive constructor.
	 *
	 * @param bool $testMode
	 */
	public function __construct($testMode = false)
	{
		if($testMode) {
			$this->beeQuantities = [
				QueenBee::class  => 1
			];
		}

		$this->startNewBeeHive();
	}

	/**
	 * @return bool
	 */
	public function hiveIntact()
	{
		return $this->hiveContains( 'Queen Bee' ) && count( $this->beesInHive );
	}

	/**
	 * @param $beeType
	 *
	 * @return int
	 */
	private function hiveContains( $beeType )
	{
		$count = 0;
		foreach ( $this->beesInHive as $bee ) {
			if ( $bee->getType() === $beeType ) {
				$count ++;
			}
		}

		return $count;
	}

	/**
	 * @return array
	 */
	public function getBeesInHive()
	{
		return $this->beesInHive;
	}

	/**
	 * @return int
	 */
	public function getHitsTaken()
	{
		return $this->hitsTaken;
	}

	/**
	 * Start a new game by generating a new beehive for the player to destroy.
	 */
	private function startNewBeeHive()
	{
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
				$this->beesInHive[ $beeID ] = new $beeType( $beeID );
				$beeCount ++;
				$beeID ++;
			}
		}
	}

	/**
	 * @return array
	 */
	public function getBeeGroups()
	{
		$beeGroups = [
			'Queen Bee'  => [ 'quantity' => 0, 'bees' => [] ],
			'Worker Bee' => [ 'quantity' => 0, 'bees' => [] ],
			'Drone Bee'  => [ 'quantity' => 0, 'bees' => [] ],
		];

		foreach ( $this->getBeesInHive() as $bee ) {
			switch ( $bee->getType() ) {
				case 'Queen Bee':
					$beeGroups['Queen Bee']['quantity'] ++;
					break;
				case 'Worker Bee':
					$beeGroups['Worker Bee']['quantity'] ++;
					break;
				case 'Drone Bee':
					$beeGroups['Drone Bee']['quantity'] ++;
					break;
			}
		}

		return $beeGroups;
	}

	/**
	 * @param int $beeID
	 *
	 * @return mixed
	 */
	public function hitBee( $beeID = - 1 )
	{
		$this->hitsTaken ++;

		if ( array_key_exists( $beeID, $this->beesInHive ) ) {
			$result = $this->beesInHive[ $beeID ]->damage();
		} else {
			$result = $this->beesInHive[ array_rand( $this->beesInHive, 1 ) ]->damage();
		}

		if ( $result['isDead'] ) {
			unset( $this->beesInHive[ $result['id'] ] );
		}

		return $result;
	}
}