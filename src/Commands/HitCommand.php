<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 16:15
 */

namespace Game\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HitCommand extends Command
{
	/** @var string */
	protected static $defaultName = 'hit';

	/**
	 * Configure the hit command
	 */
	protected function configure()
	{
		$this->setDescription( "Hits a bee." );
	}

	/**
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 *
	 * @return int|null|void
	 */
	protected function execute( InputInterface $input, OutputInterface $output )
	{



		$output->writeln([
			'You Hit a bee'
		]);
	}
}