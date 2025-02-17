<?php

/**
 * Test: Nette\ComponentModel\Container component named factory 6.
 */

declare(strict_types=1);

use Nette\ComponentModel\Container;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';


class TestClass extends Container
{
	public function createComponentB($name)
	{
		$this->addComponent($component = new self, $name);
		return $component;
	}
}


$a = new TestClass;
Assert::same('b', $a->getComponent('b')->getName());
Assert::same('b', $a->getComponentIfExists('b')->getName());


Assert::exception(function () use ($a) {
	$a->getComponent('B')->getName();
}, InvalidArgumentException::class, "Component with name 'B' does not exist, did you mean 'b'?");

Assert::null($a->getComponentIfExists('B'));
