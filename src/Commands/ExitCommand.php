<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 16:15
 *
 * @note This class was added as I wanted the player to see this command when they typed `list`
 */

namespace Game\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ExitCommand extends Command
{
	/** @var string */
	protected static $defaultName = 'exit';

	/**
	 * Configure the exit command
	 */
	protected function configure()
	{
		$this->setDescription( "Quits the game." );
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return string
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{
		$output->writeln([
			'You\'ve given up on killing bees.',
			'Goodbye.'
		]);

		return 'exit-game';
	}
}