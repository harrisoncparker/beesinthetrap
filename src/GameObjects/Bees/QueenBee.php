<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 13:31
 */

namespace Game\GameObjects\Bees;


class QueenBee extends AbstractBee
{
	protected $type = 'Queen Bee';
	protected $hitPoints = 100;
	protected $damageTaken = 8;
}