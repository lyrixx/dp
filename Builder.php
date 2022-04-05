<?php

class Builder
{
    private string $table;
    private array $fields;
    private array $wheres = [];
    private int $limit;
    private int $offset;

    public function select(string $table, array $fields): self
    {
        $this->table = $table;
        $this->fields = $fields;

        return $this;
    }

    public function where(string $field, string $value, string $operator = '='): self
    {
        $this->wheres[] = sprintf('\'%s\' %s \'%s\'', $field, $operator, $value);

        return $this;
    }

    public function limit(int $limit, int $offset): self
    {
        $this->limit = $limit;
        $this->offset = $offset;

        return $this;
    }

    public function getSQL(): string
    {
        if (!isset($this->table)) {
            throw new \LogicException(sprintf('You must call %s::select() before calling %s', __CLASS__, __METHOD__));
        }

        $sql = 'SELECT ';
        $sql .= implode(', ', $this->fields);
        $sql .= ' FROM ';
        $sql .= $this->table;

        if ($this->wheres) {
            $sql .= ' WHERE ';
            $sql .= implode(' AND ', $this->wheres);
        }

        if (isset($this->limit)) {
            $sql .= sprintf(' LIMIT %s OFFSET %s', $this->limit, $this->offset);
        }

        $sql .= ';';

        return $sql;
    }
}

try {
    $sql = (new Builder())->getSQL();
} catch (\Throwable $e) {
    dump($e);
}

$sql = (new Builder())
    ->select('my_table', ['a', 'b'])
    ->where('a', '12')
    ->where('c', 'coucou')
    ->limit(10, 0)
    ->getSQL()
;

dump($sql);
