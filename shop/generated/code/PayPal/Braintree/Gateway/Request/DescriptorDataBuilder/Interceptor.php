<?php
namespace PayPal\Braintree\Gateway\Request\DescriptorDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\DescriptorDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\DescriptorDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Gateway\Config\Config $config)
    {
        $this->___init();
        parent::__construct($config);
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
