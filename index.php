<?php 
	require __DIR__ . "/vendor/autoload.php";
	
	class test
	{
		use Ppo\Model\Repository\CreateQueryTrait;
		public function t()
		{
			return $this->insertQuery('test', array('a1', 's2'));
		}
	}
	
	$test = new test;


	echo $test->t();
