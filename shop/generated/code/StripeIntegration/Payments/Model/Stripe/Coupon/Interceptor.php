<?php
namespace StripeIntegration\Payments\Model\Stripe\Coupon;

/**
 * Interceptor class for @see \StripeIntegration\Payments\Model\Stripe\Coupon
 */
class Interceptor extends \StripeIntegration\Payments\Model\Stripe\Coupon implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\StripeIntegration\Payments\Model\Config $config, \StripeIntegration\Payments\Helper\Generic $helper, \StripeIntegration\Payments\Helper\Data $dataHelper, \StripeIntegration\Payments\Helper\Subscriptions $subscriptionsHelper, \StripeIntegration\Payments\Helper\RequestCache $requestCache, \StripeIntegration\Payments\Helper\Compare $compare)
    {
        $this->___init();
        parent::__construct($config, $helper, $dataHelper, $subscriptionsHelper, $requestCache, $compare);
    }
}
