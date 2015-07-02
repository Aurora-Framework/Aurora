<?php
include "../vendor/autoload.php";

class A
{
	public $doing;
	public $DependencyA;

	function __construct(B $B, $doing, DependencyA $DependencyA)
	{
		$this->B = $B;
		$this->doing = $doing;
		$this->DependencyA = $DependencyA;
	}

	public function sayHello($entity = "World")
	{
		echo "Hello: ".$entity.PHP_EOL;
	}
	public function bye()
	{
		echo "Bye".PHP_EOL;
	}
}
class B
{
	public $C;
	function __construct(C $C)
	{
		$this->C = $C;
	}
}
class C
{
	public $D;
	function __construct(D $D)
	{
		$this->D = $D;
	}
}
class D
{
	public $E;
	public $F;

	function __construct(E $E, F $F)
	{
		$this->E = $E;
		$this->F = $F;
	}
}
class E
{
	public $bar;
	public $call;

	function __construct($bar, $call)
	{
		$this->bar = $bar;
		$this->call = $call;
	}
}
class F
{
	function __construct()
	{
	}
}
class DependencyA
{
	public $make;

	public function __construct($make)
	{
		$this->make = $make;
	}

	function callMe()
	{
		echo "baby";
	}
}
class DependencyB
{
	public $make;

	public function __construct($make)
	{
		$this->make = $make;
	}

	function callMe()
	{
		echo "baby";
	}
}

$Injector = new Aurora\Injector();
$Injector->define("A", [
	"DependencyA" => new DependencyA("LOOOVE"),
	":doing" => "Cradt"
]);
$Injector->share('A');
echo $Injector->make("A") === $Injector->make("A");
$Injector->make("A");

$Injector->define("E", [
	":bar" => "Great Rocket",
	":call" => "jimmy"
]);


class NoConstructor
{
	function callMe()
	{
		echo "baby".PHP_EOL;
	}
}

class CallMe
{
	public function onConstruct()
	{
		echo "onConstruct".PHP_EOL;
	}

	function maybe($name = "Dan", NoConstructor $NoConstructor)
	{
		$NoConstructor->callMe();
		echo $name;
	}
}

$start = microtime();

$Injector->saveReflection("CallMe");
$CallMe = $Injector->make("CallMe");

$Injector->callMethod("A", "sayHello");
$Injector->callMethod("A", "bye");

echo (microtime() - $start)*0.000006;

//var_dump(get_defined_vars());
