<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventInterface as Event;

use Zend\Log\Logger,
    Zend\Log\Writer\ChromePhp as Writer;

class Module
{
    // ModuleManager calls this on every module, on every request, so only lightweight tasks (like attaching listeners)
    public function onBootstrap(MvcEvent $e)
    {
        $this->_log('onBootstrap called');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    
    // ModuleManager calls this on every module, on every request, so only lightweight tasks (like attaching listeners)
    public function init(ModuleManager $moduleManager)
    {
        $this->_log('init called');
        $events = $moduleManager->getEventManager();
        // for performing any actions once ALL modules are loaded, config merging happens here
        $events->attach('loadModules.post', array($this, '_loadModulesPost'));
    }

    // ModuleManager calls this and merges the returned array (or Traversable) into the main app config
    public function getConfig()
    {
        $this->_log('getConfig called');
        return include __DIR__ . '/config/module.config.php';
    }

    // ModuleManager calls this and returns the array to Zend\Loader\AutoloaderFactory
    public function getAutoloaderConfig()
    {
        $this->_log('getAutoloaderConfig called');
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    // 
    private function _log($message)
    {
        $logger = new Logger();
        $logger->addWriter(new Writer());

        $logger->log(Logger::ALERT, $message . ' @ ' . date('h:i:s A'));
    }
    
    public function _loadModulesPost(Event $e)
    {
        // This method is called once all modules are loaded.
        $this->_log('_loadModulesPost called');
    }
}
