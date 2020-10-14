<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite32c41cc88c6034d208959eab74715e9
{
    public static $prefixLengthsPsr4 = array (
        'f' => 
        array (
            'funcs\\' => 6,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'funcs\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/funcs',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite32c41cc88c6034d208959eab74715e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite32c41cc88c6034d208959eab74715e9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
