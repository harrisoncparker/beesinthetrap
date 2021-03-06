<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:05
 */

namespace Tests;


use PHPUnit\Framework\TestCase;

use Game\GameObjects\BeeHive;
use Game\GameObjects\Bees\QueenBee;
use Game\GameObjects\Bees\WorkerBee;
use Game\GameObjects\Bees\DroneBee;

class BeesTest extends TestCase
{
	/** @test */
	public function bees_take_the_correct_amount_of_damage()
	{
		$queenBee  = new QueenBee( 1 );
		$workerBee = new WorkerBee( 2 );
		$droneBee  = new DroneBee( 3 );

		$this->assertEquals( 100, $queenBee->getHitPoints() );
		$this->assertEquals( 75, $workerBee->getHitPoints() );
		$this->assertEquals( 50, $droneBee->getHitPoints() );

		$queenBee->damage();
		$workerBee->damage();
		$droneBee->damage();

		$this->assertEquals( 100 - 8, $queenBee->getHitPoints() );
		$this->assertEquals( 75 - 10, $workerBee->getHitPoints() );
		$this->assertEquals( 50 - 12, $droneBee->getHitPoints() );
	}

	/** @test */
	public function bees_take_persistent_damage()
	{
		$queenBee = new QueenBee( 1 );

		$this->assertEquals( 100, $queenBee->getHitPoints() );
		$queenBee->damage();
		$this->assertEquals( 92, $queenBee->getHitPoints() );
		$queenBee->damage();
		$this->assertEquals( 84, $queenBee->getHitPoints() );
	}

	/** @test */
	public function can_target_a_bee_in_hive_by_id()
	{
		$hive = new BeeHive();

		$hive->hitBee( 3 );

		$this->assertEquals( 'Worker Bee', $hive->getBeesInHive()[3]->getType(),
			'This test is expecting bee 3 to be a Worker Bee.'
		);
		$this->assertEquals( 'Worker Bee', $hive->getBeesInHive()[4]->getType(),
			'This test is expecting bee 4 to be a Worker Bee.'
		);

		$this->assertEquals( 65, $hive->getBeesInHive()[3]->getHitPoints() );
		$this->assertEquals( 75, $hive->getBeesInHive()[4]->getHitPoints() );
	}
}