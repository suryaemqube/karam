<?php
namespace Mirasvit\RewardsCheckout\Controller\Checkout\ApplyPointsApptanaOnestepcheckout;

/**
 * Interceptor class for @see \Mirasvit\RewardsCheckout\Controller\Checkout\ApplyPointsApptanaOnestepcheckout
 */
class Interceptor extends \Mirasvit\RewardsCheckout\Controller\Checkout\ApplyPointsApptanaOnestepcheckout implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Checkout\Model\Type\Onepage $typeOnepage, \Mirasvit\Rewards\Helper\Checkout $rewardsCheckout, \Psr\Log\LoggerInterface $logger, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\Json\Helper\Data $jsonEncoder, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator, \Magento\Checkout\Model\Cart $cart, \Magento\Framework\Serialize\Serializer\Json $serializer, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($typeOnepage, $rewardsCheckout, $logger, $scopeConfig, $jsonEncoder, $checkoutSession, $storeManager, $formKeyValidator, $cart, $serializer, $context);
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
