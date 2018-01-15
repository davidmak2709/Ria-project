<?php
	use Phalcon\Loader;
	use Phalcon\DI\FactoryDefault;
	use Phalcon\Mvc\View;
	use Phalcon\Mvc\Url as UrlProvider;
	use Phalcon\Mvc\Application;
	use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
	use Phalcon\Session\Adapter\Files as Session;
	use Phalcon\Flash\Direct as FlashDirect;
	use Phalcon\Flash\Session as FlashSession;
	use Phalcon\Config\Adapter\Ini as ConfigIni;



	define('BASE_PATH',dirname(__DIR__));
	define('APP_PATH',BASE_PATH . '/app');

	$config = new ConfigIni(
    	APP_PATH . '/config/config.ini'
	);


	$loader = new Loader();
	$loader->registerDirs(
		[
			APP_PATH . '/controllers/',
			APP_PATH . '/models/',
		]
	);

	$loader->register();

	require_once BASE_PATH . '/vendor/autoload.php';

	$di = new FactoryDefault();

	$di->set('view', function (){
		$view = new View();
		$view->setViewsDir(APP_PATH . '/views/');
		return $view;
	});

	$di->set('url',function(){
		$url = new UrlProvider();
		$url->setBaseUri('/');
		return $url;
	});

	$di->set('config', function() use ($config) {
			return $config;
	}, true);



	$di->set('db',function () use ($config){
		return new DbAdapter([
			'host' => $config->database->host,
			'username' => $config->database->username,
			'password' => $config->database->password,
			'dbname' => $config->database->name,
			'options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
		]);
	});

	$di->setShared("session",function (){
		$session = new Session();
		$session->start();
		return $session;
	});

	$di->set(
    	'flash',
    	function () {
        	return new FlashDirect();
    	}
	);

	$di->set(
    	'flashSession',
    	function () {
        	return new FlashSession();
    	}
	);


	$app = new Application($di);

	try {
		$response = $app->handle();
		$response->send();

	} catch (Exception $e) {
		echo "Exception: ".$e->getMessage();
	}


?>