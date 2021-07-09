<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Pollen\Database\DatabaseManagerInterface;
use Illuminate\Database\Query\Builder;

interface DbProxyInterface
{
    /**
     * Retrieve database manager instance|Get the query builder for a specific table.
     *
     * @param string|null $dbTable
     *
     * @return DatabaseManagerInterface|Builder
     */
    public function db(?string $dbTable = null);

    /**
     * Get instance of database schema builder.
     *
     * @param string $name
     *
     * @return SchemaBuilder
     */
    public function schema(string $name = 'default'): SchemaBuilder;

    /**
     * Set database manager instance.
     *
     * @param DatabaseManagerInterface $dbManager
     *
     * @return void
     */
    public function setDbManager(DatabaseManagerInterface $dbManager): void;
}