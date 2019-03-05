<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 16:15
 */

namespace Game\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Game\GameObjects\BeeHive;

class NewGameCommand extends Command
{
	/** @var string */
	protected static $defaultName = 'new-game';

	/** @var InputInterface */
	private $input;
	/** @var OutputInterface */
	private $output;

	/** @var mixed */
	private $questionHelper;
	/** @var Question */
	private $commandNamePrompt;

	/** @var \Game\GameObjects\BeeHive */
	private $beehive;

	/** @var bool */
	private $runGame = true;

	/** @var array */
	private $allowedGameCommands = [
		'hit',
		'hitagain',
		'hivestatus',
		'exit'
	];

	/** @var int */
	private $lastBeeHit = - 1;

	/**
	 * Configure the new game command
	 */
	protected function configure()
	{
		$this->setDescription( "Creates a new beehive for the player to destroy." );
		$this->addArgument( 'test', InputArgument::OPTIONAL, 'Run in test mode' );
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int|null|void
	 * @throws \Exception
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$this->input  = $input;
		$this->output = $output;

		$this->beehive = new BeeHive( $this->input->getArgument( 'test' ) );

		$this->output->writeln( [
			'',
			'<info>You\'ve started a new game! A fresh new beehive has bee created for you to destroy.</info>',
			'<info>===================================================================================</info>',
			''
		] );

		$this->questionHelper    = $this->getHelper( 'question' );
		$this->commandNamePrompt = new Question( 'Type a command: ', 25 );

		while ( $this->beehive->hiveIntact() && $this->runGame ) {
			$this->askForGameCommand();
		}

		if ( ! $this->beehive->hiveIntact() ) {
			$this->winGame();
		}
	}

	/**
	 * @throws \Exception
	 */
	private function notACommand()
	{
		$this->output->writeln( [
			'That command does not exist in this game.',
			''
		] );
		$this->askForGameCommand();
	}

	/**
	 * @throws \Exception
	 */
	private function askForGameCommand()
	{
		$commandName = $this->questionHelper->ask( $this->input, $this->output, $this->commandNamePrompt );

		if ( method_exists( $this, $commandName ) && in_array( $commandName, $this->allowedGameCommands ) ) {
			$this->$commandName();
			$this->output->writeln( [ '' ] );
		} else {
			$this->notACommand();
		}
	}

	/**
	 * Win Game message and functionality
	 */
	private function winGame()
	{
		$this->output->writeln( [
			"<info>Congratulations, you've destroyed the beehive!</info>",
			"<info>It took you {$this->beehive->getHitsTaken()} hits.</info>",
			''
		] );
	}

	/**
	 * Game Commands
	 */

	private function hit()
	{
		$this->handleHitResult( $this->beehive->hitBee() );
	}

	private function hitagain()
	{
		$this->handleHitResult( $this->lastBeeHit ? $this->beehive->hitBee( $this->lastBeeHit ) : 0 );
	}

	private function handleHitResult( $result )
	{
		$this->lastBeeHit = $result['id'];

		$this->output->writeln( [
			'Direct Hit!',
			"You took {$result['damage']} hit points from a {$result['type']}"
		] );

		if ( $result['isDead'] ) {
			$this->output->writeln( [ 'You\'ve killed this Bee!' ] );
		} else if ( $result['looksDying'] ) {
			$this->output->writeln( [ 'This Bee looks like it\'s dying.' ] );
		} else if ( $result['looksWeak'] ) {
			$this->output->writeln( [ 'This Bee is getting weak.' ] );
		}
	}

	private function hivestatus()
	{
		$beesLeft  = count( $this->beehive->getBeesInHive() );
		$beeGroups = $this->beehive->getBeeGroups();

		if ( $beesLeft === 1 ) {
			$beeCountText = "There is $beesLeft bee in the beehive!";
		} else {
			$beeCountText = "There are $beesLeft bees in the beehive.";
		}

		$this->output->writeln( [ $beeCountText ] );

		foreach ( $beeGroups as $beeType => $group ) {
			$this->output->writeln( [
				"{$beeType}s: {$group['quantity']}"
			] );
		}
	}

	private function exit()
	{
		$this->output->writeln( [
			'You\'ve given up on killing bees.',
			'Goodbye.'
		] );
		$this->runGame = false;
	}
}