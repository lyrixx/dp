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

class Page
{
    public function __construct(
        private readonly Mediator $mediator,
    ) {
    }

    public function addEventListener(string $eventName, callable $callable)
    {
        $this->mediator->addListener($eventName, $callable);
    }

    public function publish()
    {
        $this->mediator->dispatch('publish');
    }

    public function unpublish()
    {
        $this->mediator->dispatch('unpublish');
    }
}

// Dans la configuration de Symfony
$page = new Page(new Mediator());

$page->addEventListener('publish', function () {
    echo "COOL c'est publié !\n";
});

$page->addEventListener('unpublish', function () {
    echo "COOL c'est dépublié !\n";
});

$page->publish();
$page->unpublish();
