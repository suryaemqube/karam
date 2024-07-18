<?php
namespace PayPal\Braintree\Gateway\Request\CaptureDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\CaptureDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\CaptureDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Gateway\Helper\SubjectReader $subjectReader)
    {
        $this->___init();
        parent::__construct($subjectReader);
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
