<?php

namespace Common\Behavior;
use \Think\Behavior;

class TestBehavior extends Behavior{

	public function run(&$param)
	{
		echo $param;
	}
}