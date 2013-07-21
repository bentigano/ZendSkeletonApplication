<?php

// autoregister_zf will automatically include the library in the
// same directory as the autoloader we're using
require_once 'vendor/ChromePhp/ChromePhp.php';
require_once 'vendor/ZF2/library/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true
    )
));

if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('Unable to load ZF2.');
}
