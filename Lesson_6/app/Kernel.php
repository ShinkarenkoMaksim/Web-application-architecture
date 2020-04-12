<?php

declare(strict_types = 1);

use Framework\Command\RegisterConfigsCommand;
use Framework\Command\RegisterRoutesCommand;
use Framework\Registry;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

class Kernel
{
    /**
     * @var RegisterRoutesCommand
     */
    protected $routeRegister;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    public function __construct(ContainerBuilder $containerBuilder)
    {
        $this->containerBuilder = $containerBuilder;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function handle(Request $request): Response
    {
        //Что-то накодил, но так и не понял - зачем. Для будущего развития? Разъясните, пожалуйста. Ну и, скорее всего,
        //накодил что-то не то =) Не самый простой паттерн...
        (new RegisterConfigsCommand($this->containerBuilder))->execute();

        $this->routeRegister = new RegisterRoutesCommand($this->containerBuilder);
        $this->routeRegister->execute();

        return $this->process($request);
    }

    /**
     * @param Request $request
     * @return Response
     */
    protected function process(Request $request): Response
    {
        $matcher = new UrlMatcher($this->routeRegister->getRoutes(), new RequestContext());
        $matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($matcher->match($request->getPathInfo()));
            $request->setSession(new Session());

            $controller = (new ControllerResolver())->getController($request);
            $arguments = (new ArgumentResolver())->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            return new Response('Page not found. 404', Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            $error = 'Server error occurred. 500';
            if (Registry::getDataConfig('environment') === 'dev') {
                $error .= '<pre>' . $e->getTraceAsString() . '</pre>';
            }

            return new Response($error, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
