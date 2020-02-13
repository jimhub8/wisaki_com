<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2aa81088f2917c34e131d918b4bea540
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Psr\\Cache\\' => 10,
        ),
        'M' => 
        array (
            'MatthiasMullie\\PathConverter\\' => 29,
            'MatthiasMullie\\Minify\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Psr\\Cache\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/cache/src',
        ),
        'MatthiasMullie\\PathConverter\\' => 
        array (
            0 => __DIR__ . '/..' . '/matthiasmullie/path-converter/src',
        ),
        'MatthiasMullie\\Minify\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
            1 => __DIR__ . '/..' . '/matthiasmullie/minify/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2aa81088f2917c34e131d918b4bea540::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2aa81088f2917c34e131d918b4bea540::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
