<?php
namespace PayPal\Braintree\Gateway\Request\AchDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\AchDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\AchDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Gateway\Helper\SubjectReader $subjectReader, \PayPal\Braintree\Gateway\Config\Config $braintreeConfig)
    {
        $this->___init();
        parent::__construct($subjectReader, $braintreeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function build(array $buildSubject)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'build');
        return $pluginInfo ? $this->___callPlugins('build', func_get_args(), $pluginInfo) : parent::build($buildSubject);
    }
}
