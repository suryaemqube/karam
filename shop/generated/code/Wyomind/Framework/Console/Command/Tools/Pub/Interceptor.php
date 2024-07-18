<?php
namespace Wyomind\Framework\Console\Command\Tools\Pub;

/**
 * Interceptor class for @see \Wyomind\Framework\Console\Command\Tools\Pub
 */
class Interceptor extends \Wyomind\Framework\Console\Command\Tools\Pub implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Wyomind\Framework\Helper\ModuleFactory $module)
    {
        $this->___init();
        parent::__construct($module);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        return $pluginInfo ? $this->___callPlugins('run', func_get_args(), $pluginInfo) : parent::run($input, $output);
    }
}
