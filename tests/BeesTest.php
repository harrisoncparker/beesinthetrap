<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:05
 */

namespace Tests;



use PHPUnit\Framework\TestCase;

use Game\Bees\QueenBee;
use Game\Bees\WorkerBee;
use Game\Bees\DroneBee;

class BeesTest extends TestCase
{
	/** @test */
	public function TestBeesTakeTheCorrectAmountOfDamageDamage()
	{
		$queenBee = new QueenBee(1);
		$workerBee = new WorkerBee(2);
		$droneBee = new DroneBee(3);

		$this->assertEquals(100, $queenBee->getHitPoints());
		$this->assertEquals(75, $workerBee->getHitPoints());
		$this->assertEquals(50, $droneBee->getHitPoints());

		$queenBee->damage();
		$workerBee->damage();
		$droneBee->damage();

		$this->assertEquals(100 - 8, $queenBee->getHitPoints());
		$this->assertEquals(75  - 10, $workerBee->getHitPoints());
		$this->assertEquals(50  - 12, $droneBee->getHitPoints());
	}

	/** @test */
	public function TestBeesTakePersistentDamage()
	{
		$queenBee = new QueenBee(1);

		$this->assertEquals(100, $queenBee->getHitPoints());
		$queenBee->damage();
		$this->assertEquals(92, $queenBee->getHitPoints());
		$queenBee->damage();
		$this->assertEquals(84, $queenBee->getHitPoints());
	}
}