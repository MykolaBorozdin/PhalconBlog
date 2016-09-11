<?php

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

try {
    define('APP_PATH', realpath('..') . '/');
    
    // Read the configuration
    $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
    // require APP_PATH . 'app/config/loader.php';
    
    // Register an autoloader
    $loader = new Phalcon\Loader();

    // We're a registering a set of directories taken from the configuration file
     $loader->registerDirs(
        [
            APP_PATH . $config->application->controllersDir,
            APP_PATH . $config->application->pluginsDir,
            APP_PATH . $config->application->libraryDir,
            APP_PATH . $config->application->modelsDir,
            APP_PATH . $config->application->formsDir,
        ]
    )->register();
    // Create a DI
    $di = new FactoryDefault();

    // Simple database connection to localhost
    $di->set('mongo', function () {
        $mongo = new MongoClient();
        $config = new ConfigIni(APP_PATH . 'app/config/config.ini');
        return $mongo->selectDB($config->database->name);
    }, true);
    
    $di->set('collectionManager', function(){
        return new Phalcon\Mvc\Collection\Manager();
    }, true);
    
    /**
     * The URL component is used to generate all kind of URLs in the application
     */
    $di->set('url', function () use ($config) {
        $url = new UrlProvider();
    
        $url->setBaseUri($config->application->baseUri);
    
        return $url;
    });
    
    
    $di->set('dispatcher', function () {
    
        // Create an events manager
        $eventsManager = new EventsManager();
    
        // Listen for events produced in the dispatcher using the Security plugin
        // $eventsManager->attach('dispatch:beforeExecuteRoute', new SecurityPlugin);
    
        // Handle exceptions and not-found exceptions using NotFoundPlugin
        $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);
    
        $dispatcher = new Dispatcher();
    
        // Assign the events manager to the dispatcher
        $dispatcher->setEventsManager($eventsManager);
    
        return $dispatcher;
    });
    
    $di->set('view', function () {

        $view = new View();

        $view->setViewsDir('../app/view/');

        return $view;
    }, true);

    $application = new Application($di);

    // Handle the request
    $response = $application->handle();

    $response->send();

} catch (\Exception $e) {
     echo "Exception: ", $e->getMessage();
}
?>