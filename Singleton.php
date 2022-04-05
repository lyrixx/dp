<?php

class Singleton
{
    private static self $instance;

    private function __construct()
    {
    }

    public static function getMainInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}

$singleton1 = Singleton::getMainInstance();
$singleton2 = Singleton::getMainInstance();
$singleton3 = Singleton::getMainInstance();

dump($singleton1, $singleton2, $singleton3);
