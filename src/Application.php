<?php

namespace Aurora;

use Aurora\DI\ResolverInterface;
use Aurora\DI\Rule;
use Aurora\Exception\NotCallableException;

class Application
{

	/**
	* Instance of Dependency resolver with ProviderInterface
	* @var \ResolverInterface Dependency resolver
	*/
	public $Resolver;

	/**
	* Contains Configuration for Aurora
	* @var \Aurora\Config Config
	*/
	private $Config;

	/**
	* Contains Configuration for Aurora
	* @var \Aurora\Config Config
	*/
	private $ApplicationConfig;

	/**
	* Constructor
	* @param Config   $Config   Instance of Config must be given
	* @param Dice $Dice Dice instance
	*/
	public function __construct(
		Config $Config,
		ResolverInterface $Resolver
	) {
		$this->Config = $Config;
		$this->Resolver = $Resolver;
	}

	public function setApplicationConfig(Config $Config)
	{
		$this->ApplicationConfig = $Config;
	}

	/**
	* Run
	*
	* @param  string $controller Namespace of controller
	* @param  string $action     Method of the given controller
	* @param  array  $vars       Variables passed for method
	* @return null               Not handled for now
	*/
	public function run($callable, $params = array())
	{
		$isArray = is_array($callable);

		if ($isArray) {

			/* Assign variables for callable */
			$controllerClass = self::getNamespace($callable[0]);
			$controllermethod = $callable[1];

			/* Create callable */
			$callableController = array($controllerClass, $controllermethod);

			if (!is_callable($callableController)) {

				throw new NotCallableException("Class: ${controllerClass}, with method: ${controllermethod}, is not callable");

			} else {
				$Rule = new Rule($controllerClass);
				$Rule->reflectionable = true;
				$Rule->hasInstance = true;

				$Instance = $this->Resolver->make($controllerClass);
				$Instance->ApplicationConfig = $this->ApplicationConfig;
				$Instance->Param = (object) $params;

				$Rule->Instance = $Instance;
				$this->Resolver->addRule($Rule);

				$this->Resolver->callMethod($controllerClass, "onConstruct");
				$this->Resolver->callMethod($controllerClass, "before");
				$this->Resolver->callMethod($controllerClass, $controllermethod);

				$Instance->Response->content = $this->Resolver->callMethod($controllerClass, "render");
				$Instance->Response->send();
				
				$this->Resolver->callMethod($controllerClass, "after");
			}

		} else if (is_callable($callable)) {
			$this->Resolver->execute($callable, $params);
		}
	}
}
