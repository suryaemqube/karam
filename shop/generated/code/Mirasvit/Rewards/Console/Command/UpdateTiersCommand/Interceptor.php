<?php
namespace Mirasvit\Rewards\Console\Command\UpdateTiersCommand;

/**
 * Interceptor class for @see \Mirasvit\Rewards\Console\Command\UpdateTiersCommand
 */
class Interceptor extends \Mirasvit\Rewards\Console\Command\UpdateTiersCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ObjectManagerFactory $objectManagerFactory)
    {
        $this->___init();
        parent::__construct($objectManagerFactory);
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
