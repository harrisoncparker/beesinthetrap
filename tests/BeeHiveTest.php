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
	protected $beehive;

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
		$this->expectOutputString("Starting new game: Bees In The Trap\n");
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
}