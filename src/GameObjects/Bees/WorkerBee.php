<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 13:31
 */

namespace Game\GameObjects\Bees;


class WorkerBee extends AbstractBee
{
	protected $type = 'Worker Bee';
	protected $hitPoints = 75;
	protected $damageTaken = 10;
}