<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:05
 */

namespace Tests;


use PHPUnit\Framework\TestCase;
use Game\BeeHive;

class BeeHiveTest extends TestCase
{
	/** @var  */
	private $beehive;
	/** @var string  */
	private $gameStartText = "Starting new game: Bees In The Trap\n\n";

	/**
	 * Create a new beehive before every test in this file
	 */
	protected function setUp()
	{
		$this->beehive = new BeeHive();
	}

	/** @test */
	public function TestPlayerIsNotifiedWhenNewBeehiveIsCreated()
	{
		$this->expectOutputString($this->gameStartText);
	}

	/** @test */
	public function TestCanCreateABeehiveFullOfBees()
	{
		self::assertEquals([
			[ 'type' => 'Queen Bee', 'hitPoints' => 100 ],
			[ 'type' => 'Worker Bee', 'hitPoints' => 75 ],
			[ 'type' => 'Worker Bee', 'hitPoints' => 75 ],
			[ 'type' => 'Worker Bee', 'hitPoints' => 75 ],
			[ 'type' => 'Worker Bee', 'hitPoints' => 75 ],
			[ 'type' => 'Worker Bee', 'hitPoints' => 75 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
			[ 'type' => 'Drone Bee', 'hitPoints' => 50 ],
		],$this->beehive->getBeeInformation()) ;
	}

	/** @test */
	public function TestCanPrintHiveInformationToConsole()
	{
		$this->beehive->displayBeehiveInformation();
		$this->expectOutputString(
			$this->gameStartText.
			"The hive is still intact and the Queen Bee is alive.\n".
			"There are 5 Worker Bees alive and 0 dead\n".
			"There are 8 Drone Bees alive and 0 dead\n"
		);
	}

	/** @test */
	public function TestCanCheckIfHiveIsIntact() {
		self::assertTrue($this->beehive->hiveIntact());
	}
}