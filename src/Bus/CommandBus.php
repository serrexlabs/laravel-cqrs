<?php


namespace Serrexlabs\Cqrs\Bus;

use Illuminate\Container\Container;

/**
 * @author Sanath Samarasinghe <sanath@serrexlabs.com>
 */
class CommandBus
{
    protected $handlers = [];
    /**
     * @var Container
     */
    private $container;
    /**
     * @var string
     */
    private $commandNamespace;
    /**
     * @var string
     */
    private $handlerNamespace;

    /**
     * @param Container $container
     * @param string $commandNamespace
     * @param string $handlerNamespace
     */
    public function __construct(Container $container, $commandNamespace, $handlerNamespace)
    {
        $this->container = $container;
        $this->commandNamespace = $commandNamespace;
        $this->handlerNamespace = $handlerNamespace;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch($command)
    {
        $commandHandler = $this->getCommandHandler($command);
        $this->container->call([$commandHandler, "__invoke"], [$command]);
    }

    /**
     * Retrieve the handler for a command.
     *
     * @param  mixed  $command
     * @return bool|mixed
     */
    private function getCommandHandler($command)
    {
        if (!$this->hasCommandHandler($command)) {
            $this->registerCommandHandler($command);
        }

        return $this->container->make($this->handlers[get_class($command)]);
    }


    /**
     * Determine if the given command has a handler.
     *
     * @param  mixed  $command
     * @return bool
     */
    public function hasCommandHandler($command)
    {
        return array_key_exists(get_class($command), $this->handlers);
    }

    /**
     * Register a command handler
     * @param $command
     */
    private function registerCommandHandler($command)
    {
        $fqns = get_class($command);
        $handlerName =  "Handlers\\" . class_basename(get_class($command)) . "Handler";
        $handler = str_replace(class_basename(get_class($command)),$handlerName,$fqns);

        if (!class_exists($handler)) {
            throw  new \InvalidArgumentException($handler. "Not found!");
        }

        $this->handlers[get_class($command)] = $handler;
    }
}