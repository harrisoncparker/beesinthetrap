<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:05
 */

namespace Tests;


use Game\Bees\DroneBee;
use Game\Bees\QueenBee;
use Game\Bees\WorkerBee;
use PHPUnit\Framework\TestCase;
use Game\BeeHive;

class BeeHiveTest extends TestCase
{
	/** @var */
	private $beehive;
	/** @var string */
	private $gameStartText = "Starting new game: Bees In The Trap\n\n";

	/**
	 * Create a new beehive before every test in this file
	 */
	protected function setUp()
	{
		$this->beehive = new BeeHive();
	}

	/** @test */
	public function PlayerIsNotifiedWhenNewBeehiveIsCreated()
	{
		$this->expectOutputString( $this->gameStartText );
	}

	/** @test */
	public function CanCreateABeehiveFullOfBees()
	{
		self::assertEquals( [
			// 1 Queen Bee
			1  => new QueenBee( 1 ),
			// 5 Worker Bees
			2  => new WorkerBee( 2 ),
			3  => new WorkerBee( 3 ),
			4  => new WorkerBee( 4 ),
			5  => new WorkerBee( 5 ),
			6  => new WorkerBee( 6 ),
			// 8 Drone Bees
			7  => new DroneBee( 7 ),
			8  => new DroneBee( 8 ),
			9  => new DroneBee( 9 ),
			10 => new DroneBee( 10 ),
			11 => new DroneBee( 11 ),
			12 => new DroneBee( 12 ),
			13 => new DroneBee( 13 ),
			14 => new DroneBee( 14 ),
		], $this->beehive->getBeesInHive() );
	}

	/** @test */
	public function CanPrintHiveInformationToConsole()
	{
		$this->beehive->displayBeehiveInformation();
		$this->expectOutputString(
			$this->gameStartText .
			"The hive is still intact and the Queen Bee is alive.\n" .
			"There are 5 Worker Bees alive and 0 dead\n" .
			"There are 8 Drone Bees alive and 0 dead\n"
		);
	}

	/** @test */
	public function CanCheckIfHiveIsIntact()
	{
		$this->assertTrue( $this->beehive->hiveIntact() );
	}

	/** @test */
	public function CanGetInformationOfASpecificBeeInHive()
	{
		$this->assertEquals( new QueenBee( 1 ), $this->beehive->getBeesInHive()[1] );
		$this->assertEquals( new WorkerBee( 4 ), $this->beehive->getBeesInHive()[4] );
		$this->assertEquals( new DroneBee( 8 ), $this->beehive->getBeesInHive()[8] );
	}
}