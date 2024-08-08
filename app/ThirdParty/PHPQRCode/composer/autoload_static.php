<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7bc7e74d008ff541d4e83879a1d471b1
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chillerlan\\Settings\\' => 20,
            'chillerlan\\QRCode\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chillerlan\\Settings\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-settings-container/src',
        ),
        'chillerlan\\QRCode\\' => 
        array (
            0 => __DIR__ . '/..' . '/chillerlan/php-qrcode/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7bc7e74d008ff541d4e83879a1d471b1::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7bc7e74d008ff541d4e83879a1d471b1::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7bc7e74d008ff541d4e83879a1d471b1::$classMap;

        }, null, ClassLoader::class);
    }
}
