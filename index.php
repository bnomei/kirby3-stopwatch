<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('bnomei/stopwatch', [
    'options' => [
        'precision' => true,
    ],
    'siteMethods' => [
        'stopwatch' => function () {
            return \Bnomei\Stopwatch::singleton();
        },
    ],
]);
