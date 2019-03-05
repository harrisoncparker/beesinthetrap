<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 11:45
 */

namespace Game\GameObjects\Bees;


abstract class AbstractBee
{
	private $id;

	protected $type;
	protected $maxHitPoints;
	protected $hitPoints;
	protected $damageTaken;

	public function __construct( $id )
	{
		$this->id = $id;
		$this->maxHitPoints = $this->hitPoints;
	}

	public function getType()
	{
		return $this->type;
	}

	public function getHitPoints()
	{
		return $this->hitPoints;
	}

	public function damage()
	{
		$this->hitPoints = $this->hitPoints - $this->damageTaken;

		return [
			'id' => $this->id,
			'type' => $this->type,
			'damage' => $this->damageTaken,
			'looksWeak' => ($this->hitPoints * 2) < $this->maxHitPoints,
			'looksDying' => ($this->hitPoints * 2) < ($this->maxHitPoints / 2),
			'isDead' => $this->hitPoints <= 0
		];
	}
}