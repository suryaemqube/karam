<?php
namespace PayPal\Braintree\Gateway\Request\CustomFieldsDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\CustomFieldsDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\CustomFieldsDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Model\CustomFields\Pool $pool)
    {
        $this->___init();
        parent::__construct($pool);
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
