<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita84de630168d942ebb10f5aaf8828c77
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita84de630168d942ebb10f5aaf8828c77::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita84de630168d942ebb10f5aaf8828c77::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita84de630168d942ebb10f5aaf8828c77::$classMap;

        }, null, ClassLoader::class);
    }
}