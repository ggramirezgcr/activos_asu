<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9690c81c3a710f247b28d31a54863da6
{
    public static $files = array (
        'a9ed0d27b5a698798a89181429f162c5' => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib/Common/customFunctions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'Z' => 
        array (
            'Zxing\\' => 6,
        ),
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Zxing\\' => 
        array (
            0 => __DIR__ . '/..' . '/khanamiryan/qrcode-detector-decoder/lib',
            1 => __DIR__ . '/..' . '/zxing/qr-reader/lib',
        ),
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
    );

    public static $prefixesPsr0 = array (
        'R' => 
        array (
            'RobbieP\\ZbarQrdecoder\\' => 
            array (
                0 => __DIR__ . '/..' . '/robbiep/zbar-qrdecoder/src',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9690c81c3a710f247b28d31a54863da6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9690c81c3a710f247b28d31a54863da6::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit9690c81c3a710f247b28d31a54863da6::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit9690c81c3a710f247b28d31a54863da6::$classMap;

        }, null, ClassLoader::class);
    }
}
