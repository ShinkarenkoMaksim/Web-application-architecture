<?php

declare(strict_types=1);

namespace AbstractFactory\Repository;

use AbstractFactory\Db\Postgres;

/**
 * Class BasePostgresRepository Абстрактный класс для каждого репозитория,
 * который будет работать с postgres-БД. Здесь будет храниться соединение с БД.
 * @package Repository
 */
abstract class BasePostgresRepository
{
    /**
     * @var Postgres
     */
    private $postgresConnection;

    /**
     * BasePostgresRepository constructor.
     * @param Postgres $postgresConnection
     */
    public function __construct(Postgres $postgresConnection)
    {
        $this->postgresConnection = $postgresConnection;
    }

    /**
     * @return Postgres
     */
    public function getPostgresConnection(): Postgres
    {
        return $this->postgresConnection;
    }
}