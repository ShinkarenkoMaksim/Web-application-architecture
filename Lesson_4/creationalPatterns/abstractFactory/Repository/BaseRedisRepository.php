<?php

declare(strict_types=1);

namespace AbstractFactory\Repository;

use AbstractFactory\Db\Redis;

/**
 * Class BaseRedisRepository Абстрактный класс для каждого репозитория,
 * который будет работать с redis-БД. Здесь будет храниться соединение с БД.
 * @package Repository
 */
abstract class BaseRedisRepository
{
    /**
     * @var Redis
     */
    private $redisConnection;

    /**
     * BaseRedisRepository constructor.
     * @param Redis $redisConnection
     */
    public function __construct(Redis $redisConnection)
    {
        $this->redisConnection = $redisConnection;
    }

    /**
     * @return Redis
     */
    public function getRedisConnection(): Redis
    {
        return $this->redisConnection;
    }
}