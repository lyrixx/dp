<?php

interface FilterInterface
{
    public function filter(string $content): string;
}

class NoFilter implements FilterInterface
{
    public function filter(string $content): string
    {
        return $content;
    }
}

class 🔵To🔴 implements FilterInterface
{
    public function __construct(
        private readonly FilterInterface $filter
    ) {
    }

    public function filter(string $content): string
    {
        $content = $this->filter->filter($content);

        return str_replace('blue', 'red', $content);
    }
}

class 🟡To🟢 implements FilterInterface
{
    public function __construct(
        private readonly FilterInterface $filter
    ) {
    }

    public function filter(string $content): string
    {
        $content = str_replace('yellow', 'green', $content);

        return $this->filter->filter($content);
    }
}

$noFilter = new NoFilter();
$filter1 = new 🔵To🔴($noFilter);
$filter2 = new 🟡To🟢($filter1);

$content = 'The sky is blue and the sun is yellow';
dump($filter2->filter($content));
