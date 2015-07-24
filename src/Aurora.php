<?php

namespace Aurora;

class Auroraq1
{
	public $Application;

	public function __construct(Application $Application)
	{
		$this->Application = $Application;
	}

	public function run($callable, $params = array())
	{
		$this->Application->run($callable, $params);
	}

	public function init()
	{
		$this->Application->Resolver->define("Aurora\\Http\\Request", [
			":GET" => $_GET,
			":POST" => $_POST,
			":COOKIE" => $_COOKIE,
			":FILES" => $_FILES,
			":SERVER" => $_SERVER,
		]);

		$this->Application->Resolver->alias("Aurora\\Http\\Request", "Request");
		$this->Application->Resolver->alias("Aurora\\Http\\Response", "Response");
	}
}
