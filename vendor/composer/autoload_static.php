<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit95b756fa22864e45a2146a2ed9503ccc
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'models\\' => 7,
        ),
        'c' => 
        array (
            'controllers\\' => 12,
        ),
        'a' => 
        array (
            'app\\helpers\\' => 12,
            'app\\db\\' => 7,
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'app\\helpers\\' => 
        array (
            0 => __DIR__ . '/..' . '/traits',
        ),
        'app\\db\\' => 
        array (
            0 => __DIR__ . '/..' . '/db',
        ),
        'app\\' => 
        array (
            0 => 'W:\\domains\\comments\\vendor',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit95b756fa22864e45a2146a2ed9503ccc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit95b756fa22864e45a2146a2ed9503ccc::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
