<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 12:05
 */

namespace Tests;


use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Game\Commands\NewGameCommand;

class GamePlayTest extends TestCase
{
	/** @var Application */
	private $app;

	/** Set Up */
	protected function setUp()
	{
		$this->app = new Application();

		$this->app->add( new NewGameCommand() );
	}

	/**
	 * Set up a command tester for a specific command
	 *
	 * @param $commandName
	 *
	 * @return CommandTester
	 */
	private function setUpCommandTester( $commandName )
	{
		$command = $this->app->find( $commandName );

		return new CommandTester( $command );
	}

	/**
	 * @note An array of common outputs used in most tests
	 *
	 * @var array
	 */
	private $expectedOutputs = [
		'newGame'  => "\n" .
					  "You've started a new game! A fresh new beehive has bee created for you to destroy.\n" .
					  "===================================================================================\n" .
					  "\n" .
					  "Type a command: ",
		'exitGame' => "You've given up on killing bees.\n" .
					  "Goodbye.\n" .
					  "\n"
	];

	/**
	 * TESTS
	 */

	/** @test */
	public function can_start_a_new_game_and_exit_it()
	{
		$newGameCommandTester = $this->setUpCommandTester( 'new-game' );

		$newGameCommandTester->setInputs( [ 'exit' ] )->execute( [] );

		$this->assertEquals(
			$this->expectedOutputs['newGame'] . $this->expectedOutputs['exitGame'],
			$newGameCommandTester->getDisplay()
		);
	}

	/** @test */
	public function can_win_game()
	{
		$newGameCommandTester = $this->setUpCommandTester( 'new-game' );

		$newGameCommandTester->setInputs(
			array_fill( 0, 13, 'hit' )
		)->execute( [ 'test' => 'true' ] );

		// Check that the game starts
		$this->assertContains(
			$this->expectedOutputs['newGame'],
			$newGameCommandTester->getDisplay()
		);

		// Check that the queen bee is hit 13 times
		$this->assertEquals(
			13,
			substr_count( $newGameCommandTester->getDisplay(),
				"Type a command: Direct Hit!\n" .
				"You took 8 hit points from a Queen Bee\n"
			)
		);

		// Check that the game is won
		$this->assertContains(
			"Congratulations, you've destroyed the beehive!\n" .
			"It took you 13 hits.\n" .
			"\n",
			$newGameCommandTester->getDisplay()
		);
	}
}