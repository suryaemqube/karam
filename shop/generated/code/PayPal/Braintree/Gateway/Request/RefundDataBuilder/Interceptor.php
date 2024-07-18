<?php
namespace PayPal\Braintree\Gateway\Request\RefundDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\RefundDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\RefundDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\PayPal\Braintree\Gateway\Helper\SubjectReader $subjectReader, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($subjectReader, $logger);
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
