<?php

declare(strict_types=1);

namespace Pollen\Support\Proxy;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Pollen\Database\DatabaseManager;
use Pollen\Database\DatabaseManagerInterface;
use Pollen\Support\Exception\ProxyInvalidArgumentException;
use Pollen\Support\ProxyResolver;
use RuntimeException;
use Exception;

/**
 * @see \Pollen\Support\Proxy\DbProxyInterface
 */
trait DbProxy
{
    /**
     * Database manager instance.
     * @var DatabaseManagerInterface|null
     */
    private ?DatabaseManagerInterface $dbManager = null;

    /**
     * Retrieve database manager instance|Get the query builder for a specific table.
     *
     * @param string|null $dbTable
     *
     * @return DatabaseManagerInterface|Builder
     */
    public function db(?string $dbTable = null)
    {
        if ($this->dbManager === null) {
            try {
                $this->dbManager = DatabaseManager::getInstance();
            } catch (RuntimeException $e) {
                $this->dbManager = ProxyResolver::getInstance(
                    DatabaseManagerInterface::class,
                    DatabaseManager::class,
                    method_exists($this, 'getContainer') ? $this->getContainer() : null
                );
            }
        }

        if ($dbTable === null) {
            return $this->dbManager;
        }

        try {
            return $this->dbManager->getConnection()->table($dbTable);
        } catch(Exception $e) {
            throw new ProxyInvalidArgumentException(sprintf('Db Table [%s] is unavailable', $dbTable));
        }
    }

    /**
     * Get instance of database schema builder.
     *
     * @param string $name
     *
     * @return SchemaBuilder
     */
    public function schema(string $name = 'default'): SchemaBuilder
    {
        return $this->db()->getConnection($name)->getSchemaBuilder();
    }

    /**
     * Set database manager instance.
     *
     * @param DatabaseManagerInterface $dbManager
     *
     * @return void
     */
    public function setDbManager(DatabaseManagerInterface $dbManager): void
    {
        $this->dbManager = $dbManager;
    }
}