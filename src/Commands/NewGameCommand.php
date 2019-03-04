<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 16:15
 */

namespace Game\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Game\BeeHive;

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

	/** @var BeeHive */
	private $beehive;

	/** @var bool  */
	private $runGame = true;

	/**
	 * Configure the new game command
	 */
	protected function configure()
	{
		$this->setDescription( "Creates a new beehive for the player to destroy." );
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
		$this->beehive = new BeeHive();

		$this->input  = $input;
		$this->output = $output;

		$this->output->writeln( [
			'<info>You\'ve started a new game! A fresh new beehive has bee created for you to destroy.</info>',
			'<info>===================================================================================</info>',
			''
		] );

		$this->questionHelper    = $this->getHelper( 'question' );
		$this->commandNamePrompt = new Question( 'Type a command: ', 25 );

		while ( $this->beehive->hiveIntact() &&  $this->runGame) {
			$this->askForGameCommand();
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

		if ( $this->getApplication()->has( $commandName ) ) {

			$returnCode = $this->runCommand($commandName);

			if($returnCode == 'exit-game') {
				$this->runGame = false;
			}

			$this->output->writeln( [ '' ] );

		} else {
			/**
			 * @note I created the ExitCommand class instead as I
			 * wanted the user to see this in the `list` of commands
			 */
			// $this->runGame = $commandName == 'exit' ? false : true;

			$this->notACommand();
		};
	}

	/**
	 * @param $commandName
	 * @param array $input
	 *
	 * @throws \Exception
	 *
	 * @return mixed
	 */
	private function runCommand($commandName, $input = []) {
		return $this->getApplication()
			 ->find( $commandName )
			 ->run(
				 new ArrayInput( $input ),
				 $this->output
			 );
	}
}