<?php
namespace Postpay\Payment\Controller\Payment\Confirmation;

/**
 * Interceptor class for @see \Postpay\Payment\Controller\Payment\Confirmation
 */
class Interceptor extends \Postpay\Payment\Controller\Payment\Confirmation implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\App\Request\Http $request, \Postpay\Payment\Model\Adapter\AdapterInterface $postpayAdapter, \Magento\Sales\Model\Order $order, \Postpay\Payment\Gateway\Config\Config $config, \Magento\Sales\Model\Order\Email\Sender\OrderSender $orderSender, \Magento\Sales\Model\Service\InvoiceService $invoiceService, \Magento\Sales\Model\Order\Email\Sender\InvoiceSender $invoiceSender, \Magento\Framework\DB\TransactionFactory $transactionFactory, \Magento\Sales\Model\Order\Payment\Transaction\Builder $transactionBuilder)
    {
        $this->___init();
        parent::__construct($context, $request, $postpayAdapter, $order, $config, $orderSender, $invoiceService, $invoiceSender, $transactionFactory, $transactionBuilder);
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
