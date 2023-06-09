<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInita84de630168d942ebb10f5aaf8828c77
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

        spl_autoload_register(array('ComposerAutoloaderInita84de630168d942ebb10f5aaf8828c77', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInita84de630168d942ebb10f5aaf8828c77', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInita84de630168d942ebb10f5aaf8828c77::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
