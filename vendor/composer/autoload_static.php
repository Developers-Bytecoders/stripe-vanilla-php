<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit713499bf84fe7423016ae4c4bbee8523
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
        'A' => 
        array (
            'Anghel\\StripeTestPayment\\' => 25,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
        'Anghel\\StripeTestPayment\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit713499bf84fe7423016ae4c4bbee8523::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit713499bf84fe7423016ae4c4bbee8523::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit713499bf84fe7423016ae4c4bbee8523::$classMap;

        }, null, ClassLoader::class);
    }
}
