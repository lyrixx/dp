<?php

interface ConnectorInterface
{
    public function login(): void;

    public function postContent(): void;

    public function logout(): void;
}

class TwitterConnector implements ConnectorInterface
{
    public function login(): void
    {
        dump(__METHOD__);
    }

    public function postContent(): void
    {
        dump(__METHOD__);
    }

    public function logout(): void
    {
        dump(__METHOD__);
    }
}

class GithubConnector implements ConnectorInterface
{
    public function login(): void
    {
        dump(__METHOD__);
    }

    public function postContent(): void
    {
        dump(__METHOD__);
    }

    public function logout(): void
    {
        dump(__METHOD__);
    }
}

interface FactoryInterface
{
    public function getConnector(): ConnectorInterface;
}

class Poster
{
    public function __construct(
        private readonly FactoryInterface $factory,
    ) {
    }

    public function sendContent(string $content): void
    {
        $connector = $this->factory->getConnector();

        $connector->login();
        $connector->postContent();
        $connector->logout();
    }
}

class TwitterFactory implements FactoryInterface
{
    public function getConnector(): ConnectorInterface
    {
        return new TwitterConnector();
    }
}

class GithubFactory implements FactoryInterface
{
    public function getConnector(): ConnectorInterface
    {
        return new GithubConnector();
    }
}

$client = new Poster(new TwitterFactory());
$client->sendContent('hello');

$client = new Poster(new GithubFactory());
$client->sendContent('hello');
