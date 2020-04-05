<?php

declare(strict_types=1);

namespace AbstractFactory\Repository;

use AbstractFactory\Contract\UserRepositoryInterface;
use AbstractFactory\Entity\User;

/**
 * Class RedisUserRepository Реализация репозитория пользователей, который
 * работает с redis-БД.
 * @package Repository
 */
class RedisUserRepository extends BaseRedisRepository
    implements UserRepositoryInterface
{
    /**
     * @param User $user
     */
    public function add(User $user)
    {
        // Для коннекта к redis используется $this->getRedisConnection().
        echo 'Добавляем в redis пользователя $user.' . PHP_EOL;
    }

    /**
     * @param User $user
     */
    public function delete(User $user)
    {
        // Для коннекта к redis используется $this->getRedisConnection().
        echo 'Удаляем в redis пользователя $user.' . PHP_EOL;
    }

    /**
     * @param User $user
     */
    public function update(User $user)
    {
        // Для коннекта к redis используется $this->getRedisConnection().
        echo 'Обновляем в redis пользователя $user.' . PHP_EOL;
    }
}