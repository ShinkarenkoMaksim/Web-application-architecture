<?php

declare(strict_types=1);

namespace AbstractFactory\Factory;

use AbstractFactory\Contract\OrderRepositoryInterface;
use AbstractFactory\Contract\RepositoryFactoryInterface;
use AbstractFactory\Contract\UserRepositoryInterface;
use AbstractFactory\Repository\RedisUserRepository;
use AbstractFactory\Repository\RedisOrderRepository;
use AbstractFactory\Db\Redis;

/**
 * Class RedisRepositoryFactory Класс-фабрика, реализующий интерфейс
 * абстрактной фабрики. Данный класс будет создавать репозитории, которые
 * работают с redis-БД.
 * @package Factory
 */
class RedisRepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * @var Redis
     */
    private $redisConnection;

    /**
     * RedisRepositoryFactory constructor.
     * @param Redis $postgresConnection
     */
    public function __construct(Redis $postgresConnection)
    {
        $this->redisConnection = $postgresConnection;
    }

    /**
     * @return UserRepositoryInterface
     */
    public function createUserRepository(): UserRepositoryInterface
    {
        return new RedisUserRepository($this->redisConnection);
    }

    /**
     * @return OrderRepositoryInterface
     */
    public function createOrderRepository(): OrderRepositoryInterface
    {
        return new RedisOrderRepository($this->redisConnection);
    }
}