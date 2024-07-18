<?php
namespace Wyomind\PickupAtStore\Controller\Update\Shippingmethod;

/**
 * Interceptor class for @see \Wyomind\PickupAtStore\Controller\Update\Shippingmethod
 */
class Interceptor extends \Wyomind\PickupAtStore\Controller\Update\Shippingmethod implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\Json\Helper\Data $jsonHelper, \Magento\Quote\Api\CartRepositoryInterface $quoteRepository, \Magento\Checkout\Model\Session $checkoutSession, \Magento\Backend\Model\Session\Quote $backendQuote, \Wyomind\Framework\Helper\Module $framework, \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory, \Wyomind\PointOfSale\Helper\DataFactory $posHelperFactory, \Wyomind\PickupAtStore\Helper\Config $configHelper, \Wyomind\PickupAtStore\Helper\Data $pasHelper, \Magento\Directory\Model\Region $region, \Wyomind\PickupAtStore\Logger\Logger $logger)
    {
        $this->___init();
        parent::__construct($context, $jsonHelper, $quoteRepository, $checkoutSession, $backendQuote, $framework, $posCollectionFactory, $posHelperFactory, $configHelper, $pasHelper, $region, $logger);
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
