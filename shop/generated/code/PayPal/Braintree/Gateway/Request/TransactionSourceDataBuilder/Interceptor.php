<?php
namespace PayPal\Braintree\Gateway\Request\TransactionSourceDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\TransactionSourceDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\TransactionSourceDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\State $state)
    {
        $this->___init();
        parent::__construct($state);
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $buildSubject) : array
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'build');
        return $pluginInfo ? $this->___callPlugins('build', func_get_args(), $pluginInfo) : parent::build($buildSubject);
    }
}
