<?php 
namespace Emqube\RestoreCart\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Checkout\Model\Session\Proxy;
use Magento\Sales\Model\OrderFactory;
 
use Magento\SalesRule\Model\Coupon;
use Magento\SalesRule\Model\RuleFactory;
use Magento\Sales\Api\OrderManagementInterface;

class RetainCart implements ObserverInterface{

    private $checkoutSession;
    protected $orderFactory;
    protected $couponModel;
    protected $rule;
    protected $orderManagement;
    public function __construct(
        Proxy $checkoutSession,
        OrderFactory $orderFactory,
        Coupon $couponModel,
        RuleFactory $rule,
        OrderManagementInterface $orderManagement
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->orderFactory = $orderFactory;
        $this->couponModel = $couponModel;
        $this->rule = $rule;
        $this->orderManagement = $orderManagement;
    }
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $lastRealOrder = $this->checkoutSession->getLastRealOrder();
        if ($lastRealOrder->getPayment()) {
            
            if ($lastRealOrder->getData('state') === 'new' && $lastRealOrder->getData('status') === 'pending_payment') {
                $this->checkoutSession->restoreQuote();
                $orderId = $this->checkoutSession->getLastOrderId();
                $this->orderManagement->cancel($orderId);
                // $orderState = 'canceled';
                // $orderStatus = 'canceled';
                // $orderId = $this->checkoutSession->getLastOrderId();
                // $order = $this->orderFactory->create()->load($orderId);
                // $order->setState($orderState)->setStatus($orderStatus);
                // $order->save();
                // if ($order->canCancel()) {
                //     if ($code = $order->getCouponCode()) {
                //         $coupon = $this->couponModel->create()->load($code, 'coupon_code');
                //         $coupon->setTimesUsed($coupon->getTimesUsed() - 1);
                //         $coupon->save();
                //         if ($customerId = $order->getCustomerId()) {
                //             if ($customerCoupon = $this->rule->create()->load($coupon->getId())) {
                //                 $customerCoupon->setTimesUsed($customerCoupon->getTimesUsed() - 1);
                //                 $customerCoupon->save();
                //             }
                //         }
                //     }
                // }
                
            }
        }
        return true;
    }
}











?>