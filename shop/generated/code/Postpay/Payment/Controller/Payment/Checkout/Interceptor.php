<?php
namespace Postpay\Payment\Controller\Payment\Checkout;

/**
 * Interceptor class for @see \Postpay\Payment\Controller\Payment\Checkout
 */
class Interceptor extends \Postpay\Payment\Controller\Payment\Checkout implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Quote\Api\CartRepositoryInterface $quoteRepository, \Postpay\Payment\Model\Adapter\AdapterInterface $postpayAdapter, \Magento\Sales\Model\OrderFactory $orderFactory)
    {
        $this->___init();
        parent::__construct($context, $checkoutSession, $quoteRepository, $postpayAdapter, $orderFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
