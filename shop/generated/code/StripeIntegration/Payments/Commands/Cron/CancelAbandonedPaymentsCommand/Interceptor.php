<?php
namespace StripeIntegration\Payments\Commands\Cron\CancelAbandonedPaymentsCommand;

/**
 * Interceptor class for @see \StripeIntegration\Payments\Commands\Cron\CancelAbandonedPaymentsCommand
 */
class Interceptor extends \StripeIntegration\Payments\Commands\Cron\CancelAbandonedPaymentsCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(?string $name = null)
    {
        $this->___init();
        parent::__construct($name);
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
