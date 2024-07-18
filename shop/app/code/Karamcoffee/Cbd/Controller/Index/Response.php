<?php
namespace Karamcoffee\Cbd\Controller\Index;
 
use Magento\Framework\App\Action\Context;
 use Magento\Checkout\Model\Session;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderFactory;
class Response extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;
    protected $checkoutSession;
    protected $orderFactory;
 
    public function __construct(Context $context, Session $checkoutSession, OrderFactory $orderFactory, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;

        parent::__construct($context);
    }
 
    public function execute()
    {
        $orderState = 'new';
        $orderStatus = 'pending_payment';
        $orderId = $this->checkoutSession->getLastOrderId();
        //if($this->checkoutSession->getLastOrderStatus() == 'pending'){
            $order = $this->orderFactory->create()->load($orderId);
            $order->setState(Order::STATE_PENDING_PAYMENT, true);
            $order->setStatus(Order::STATE_PENDING_PAYMENT);
            $order->save();
            $resultPage = $this->_resultPageFactory->create();
            return $resultPage;
        //}
    }
}
