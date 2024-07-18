<?php
namespace PayPal\Braintree\Gateway\Request\CvvDataBuilder;

/**
 * Interceptor class for @see \PayPal\Braintree\Gateway\Request\CvvDataBuilder
 */
class Interceptor extends \PayPal\Braintree\Gateway\Request\CvvDataBuilder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\RequestInterface $request, \PayPal\Braintree\Gateway\Config\Config $config, \Psr\Log\LoggerInterface $logger)
    {
        $this->___init();
        parent::__construct($request, $config, $logger);
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
