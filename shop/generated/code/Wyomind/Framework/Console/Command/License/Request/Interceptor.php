<?php
namespace Wyomind\Framework\Console\Command\License\Request;

/**
 * Interceptor class for @see \Wyomind\Framework\Console\Command\License\Request
 */
class Interceptor extends \Wyomind\Framework\Console\Command\License\Request implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\State $state, \Wyomind\Framework\Helper\ModuleFactory $license, \Wyomind\Framework\Model\ResourceModel\ConfigFactory $configFactory, \Magento\Framework\App\DeploymentConfig $deploymentConfig)
    {
        $this->___init();
        parent::__construct($state, $license, $configFactory, $deploymentConfig);
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
