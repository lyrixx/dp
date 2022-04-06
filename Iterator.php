<?php

class CsvIterator implements Iterator
{
    private $handle;
    private int $lineNumber;

    public function __construct(
        string $filename,
    ) {
        $this->handle = fopen($filename, 'r');
        $this->lineNumber = 0;
    }

    public function current(): mixed
    {
        return fgetcsv($this->handle);
    }

    public function key(): mixed
    {
        return $this->lineNumber;
    }

    public function next(): void
    {
        ++$this->lineNumber;
    }

    public function valid(): bool
    {
        return !feof($this->handle);
    }

    public function rewind(): void
    {
        fseek($this->handle, 0);
        $this->lineNumber = 0;
    }
}

class CsvIteratorWithYield implements IteratorAggregate
{
    public function __construct(
        private readonly string $filename,
    ) {
    }

    public function getIterator(): Traversable
    {
        $handle = fopen($this->filename, 'r');

        while (!feof($handle)) {
            yield fgetcsv($handle);
        }
    }
}

class MyFilterIterator implements IteratorAggregate
{
    public function __construct(
        private readonly iterable $iterable
    ) {
    }

    public function getIterator(): Traversable
    {
        $i = 0;
        foreach ($this->iterable as $key => $value) {
            if (!is_countable($value) || 4 !== count($value)) {
                continue;
            }

            yield $i++ => $value;
        }
    }
}

$csv = new MyFilterIterator(new CsvIterator('data.csv'));
// $csv = new CsvIteratorWithYield('data.csv');

foreach ($csv as $lineno => $line) {
    dump([$lineno => $line]);
}
foreach ($csv as $lineno => $line) {
    dump([$lineno => $line]);
}
