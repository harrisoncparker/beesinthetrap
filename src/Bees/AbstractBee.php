<?php
/**
 * Created by PhpStorm.
 * User: harrisonparker
 * Date: 04/03/2019
 * Time: 11:45
 */

namespace Game\Bees;


abstract class AbstractBee
{
	private $id;

	protected $type;
	protected $HitPoints;
	protected $damageTaken;

	public function __construct($id)
	{
		$this->id = $id;
	}

	public function getType() {
		return $this->type;
	}

	public function getHitPoints() {
		return $this->HitPoints;
	}
}