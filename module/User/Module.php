<?php
namespace User;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Authentication\Adapter\DbTable as DbAuthAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Session\Container;

class Module
{
    public function onBootstrap(MvcEvent $e)
  {
      $eventManager = $e->getApplication()->getEventManager();
      $moduleRouteListener = new ModuleRouteListener();
      $moduleRouteListener->attach($eventManager);
  }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                    //This is to include the custom libraries
                    'Libraries' => __DIR__.'/../../vendor/Libraries'
                ),
            ),
        );
    } 

    public function getServiceConfig()
   {
       return array(
           'factories' => array(
               'AuthService' => function($sm){
                   $adapter = $sm->get('Zend\Db\Adapter\Adapter');
                   $dbAuthAdapter = new DbAuthAdapter($adapter, 'user', 'user_email', 'user_password');

                   $auth = new AuthenticationService();
                   $auth->setAdapter($dbAuthAdapter);
                   return $auth;
               }
           ),
       );
   }



}
