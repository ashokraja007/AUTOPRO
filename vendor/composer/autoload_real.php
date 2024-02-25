<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitbe87c47d5d6c4f971f45a8b8d6a4dd49
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitbe87c47d5d6c4f971f45a8b8d6a4dd49', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitbe87c47d5d6c4f971f45a8b8d6a4dd49', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitbe87c47d5d6c4f971f45a8b8d6a4dd49::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
