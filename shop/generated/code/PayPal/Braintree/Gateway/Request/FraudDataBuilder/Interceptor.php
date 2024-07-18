<?php
namespace PayPal\Braintree\Gateway\Request\FraudDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\FraudDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\FraudDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Gateway\Config\Config $config, \PayPal\Braintree\Gateway\Helper\SubjectReader $subjectReader, \Magento\Framework\App\State $state)
    {
        $this->___init();
        parent::__construct($config, $subjectReader, $state);
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
