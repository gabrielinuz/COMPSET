<?php
/**
* Copyright Gabriel Nicolás González Ferreira <gabrielinuz@gmail.com>
* Released under the GPL3 license
* https://opensource.org/licenses/GPL-3.0
**/
include_once('Autoloader.php');
include_once('ConcretePathsProvider.php');

/*PATHS PROVIDER*/
$pathsProvider = new ConcretePathsProvider;

/*THIS*/
// $pathsProvider->appendPath('TestClassesFolder01/');
// $pathsProvider->appendPath('TestClassesFolder02/');

/*OR THIS*/
$pathsProvider->setFile('paths.ini');

Autoloader::initWith( $pathsProvider );

new TestClass01a;
new TestClass01b;
new TestClass01c;
new TestClass01d;
new TestClass01e;
new TestClass01f;
new TestClass01g;

new TestClass02a;
new TestClass02b;
new TestClass02c;
new TestClass02d;
new TestClass02e;
new TestClass02f;
new TestClass02g;

new TestClass03; //Fatal error: Uncaught Error: Class 'TestClass03' not found... 