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
	/** @test */
	public function TestPlayerIsNotifiedWhenNewBeehiveIsCreated()
	{
		$this->expectOutputString("Starting new game: Bees In The Trap\n");
		new BeeHive();
	}
}