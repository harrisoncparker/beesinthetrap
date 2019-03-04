<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 13:31
 */

namespace Game\Bees;


class DroneBee extends AbstractBee
{
	protected $type = 'Drone Bee';
	protected $HitPoints = 50;
	protected $damageTaken = 12;
}