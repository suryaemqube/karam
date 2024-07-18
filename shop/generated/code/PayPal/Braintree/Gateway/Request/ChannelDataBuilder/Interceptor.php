<?php
namespace PayPal\Braintree\Gateway\Request\ChannelDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\ChannelDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\ChannelDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct()
    {
        $this->___init();
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
