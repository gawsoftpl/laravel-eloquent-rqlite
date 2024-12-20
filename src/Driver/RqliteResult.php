<?php

namespace Gawsoft\LaravelEloquentRqlite\Driver;

use Doctrine\DBAL\Driver\Exception;

class RqliteResult implements \Doctrine\DBAL\Driver\Result
{
    /**
     * @var array
     */
    private array $results;

    /**
     * @var int
     */
    private int $num = 0;

    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchNumeric(): array|false
    {
        $row = $this->fetch();

        if ($row === false) {
            return false;
        }

        return $row;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAssociative(): array|false
    {
        $row = $this->fetch();

        if ($row === false) {
            return false;
        }

        return array_combine($this->results['columns'], $row);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchOne(): mixed
    {
        $row = $this->fetch();

        if ($row === false) {
            return false;
        }

        return reset($row);
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAllNumeric(): array
    {
        $rows = [];

        while (($row = $this->fetchNumeric()) !== false) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchAllAssociative(): array
    {
        $rows = [];

        while (($row = $this->fetchAssociative()) !== false) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * {@inheritDoc}
     */
    public function fetchFirstColumn(): array
    {
        $rows = [];

        while (($row = $this->fetchOne()) !== false) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * {@inheritDoc}
     */
    public function rowCount(): int
    {
        return isset($this->results['values']) ? count($this->results['values']) : 0;
    }

    /**
     * {@inheritDoc}
     */
    public function columnCount(): int
    {
        return count($this->results['columns']);
    }

    /**
     * {@inheritDoc}
     */
    public function free(): void
    {
        $this->results = [];
    }

    private function fetch()
    {
        if (! isset($this->results['values'])) {
            return false;
        }

        if (! isset($this->results['values'][$this->num])) {
            return false;
        }

        return $this->results['values'][$this->num++];
    }

    /**
     * @deprecated 仅参考
     *
     * @throws Exception
     */
    public function fetchAll(): array
    {
        $rows = [];

        while (($row = $this->fetchAssociative()) !== false) {
            $rows[] = $row;
        }

        return $rows;
    }
}
