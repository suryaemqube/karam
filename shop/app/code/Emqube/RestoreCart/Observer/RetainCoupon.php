<?php
 
namespace Emqube\RestoreCart\Observer;
 
use Magento\SalesRule\Model\Coupon;
use Magento\SalesRule\Model\RuleFactory;
 
class RetainCoupon
{
    protected $couponModel;
    protected $rule;
 
    public function __construct(
        Coupon $couponModel,
        RuleFactory $rule
 
    )
    {
        $this->couponModel = $couponModel;
        $this->rule = $rule;
    }
 
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $order = $event->getPayment()->getOrder();
        if ($order->canCancel()) {
            echo "hi";
            exit;
            if ($code = $order->getCouponCode()) {
                $coupon = $this->couponModel->create()->load($code, 'coupon_code');
                $coupon->setTimesUsed($coupon->getTimesUsed() - 1);
                $coupon->save();
                if ($customerId = $order->getCustomerId()) {
                    if ($customerCoupon = $this->rule->create()->load($coupon->getId())) {
                        $customerCoupon->setTimesUsed($customerCoupon->getTimesUsed() - 1);
                        $customerCoupon->save();
                    }
                }
            }
        }
        $urlInterface = \Magento\Framework\App\ObjectManager::getInstance()->get('Magento\Framework\UrlInterface');
        return $urlInterface->getCurrentUrl();
    }
}