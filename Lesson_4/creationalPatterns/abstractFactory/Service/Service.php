<?php

declare(strict_types=1);

namespace AbstractFactory\Service;

use AbstractFactory\Contract\OrderRepositoryInterface;
use AbstractFactory\Contract\RepositoryFactoryInterface;
use AbstractFactory\Contract\UserRepositoryInterface;
use AbstractFactory\Entity\Order;
use AbstractFactory\Entity\User;

/**
 * Class Service Класс-сервис (в данном случае он один для примера), будет
 * предоставлять доступ до каких-то действий с данными, здесь должна быть
 * прописана бизнес-логика приложения (мы это пропустили, т.к. это пример).
 * Для корректной работы данного сервиса, необходим доступ к данным, данные
 * могут храниться в redis или postgres (возможно и в других хранилищах).
 * Данный сервис не должен знать о том откуда эти данные мы будем получать,
 * сервис должен просто обратиться к репозиторию и репозиторий должен вернуть
 * данные. Мы точно не знаем какой репозиторий будет у нас в свойствах
 * $userRepository и $orderRepository, будут ли они работать с redis или
 * postgres, но мы точно знаем что эти репозитории будут предоставлять интерфейс
 * для работы, а именно UserRepositoryInterface и OrderRepositoryInterface.
 * А значит мы точно сможем получить данные, откуда - в данном сервисе не важно.
 * @package Service
 */
class Service
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * OrderService constructor. В конструктор передается фабрика, которая может
     * нам создать любой репозиторий, который нам нужен. Данная фабрика уже
     * знает, с каким хранилищем должны работать репозитории, которые она будет
     * создавать. При вызове данного конструктора передается фабрика, которая
     * создат репозитории определенного типа, которые работают с определенным
     * хранилищем.
     * @param RepositoryFactoryInterface $repositoryFactory
     */
    public function __construct(RepositoryFactoryInterface $repositoryFactory)
    {
        $this->userRepository = $repositoryFactory->createUserRepository();
        $this->orderRepository = $repositoryFactory->createOrderRepository();
    }

    /**
     * Действия для добавления пользователя (просто пример использования).
     */
    public function addUser(): void {
        // С помощью другой фабрики можно собрать пользователя, что было
        // пропущено для упрощения.
        $user = new User();
        // Добавляем пользователя в хранилище.
        $this->userRepository->add($user);
    }

    /**
     * Действия для добавления заказа (просто пример использования).
     */
    public function addOrder(): void {
        // С помощью другой фабрики можно собрать заказ, что было
        // пропущено для упрощения.
        $order = new Order();
        // Добавляем заказ в хранилище.
        $this->orderRepository->add($order);
    }
}