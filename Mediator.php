<?php

class Mediator
{
    private array $listeners = [];

    public function addListener(string $eventName, callable $callable)
    {
        $this->listeners[$eventName][] = $callable;
    }

    public function dispatch(string $eventName)
    {
        foreach ($this->listeners[$eventName] ?? [] as $callable) {
            $callable();
        }
    }
}

// Dans la configuration de Symfony
$mediator = new Mediator();
$mediator->addListener('order.payed', function () {
    echo "COOL c'est payé !\n";
});

// Dans ton code
$mediator->dispatch('order.payed');
$mediator->dispatch('404');
