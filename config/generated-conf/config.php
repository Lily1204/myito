<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('myito', 'pgsql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'pgsql:host=localhost;port=5432;dbname=myito;user=postgres;password=1234',
  'user' => 'postgres',
  'password' => 1234,
  'settings' =>
  array (
    'charset' => 'utf8',
    'queries' =>
    array (
      'utf8' => 'SET NAMES \'UTF8\'',
    ),
  ),
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('myito');
$serviceContainer->setConnectionManager('myito', $manager);
$serviceContainer->setDefaultDatasource('myito');