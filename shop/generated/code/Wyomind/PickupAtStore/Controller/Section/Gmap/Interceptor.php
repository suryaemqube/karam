<?php
namespace Wyomind\PickupAtStore\Controller\Section\Gmap;

/**
 * Interceptor class for @see \Wyomind\PickupAtStore\Controller\Section\Gmap
 */
class Interceptor extends \Wyomind\PickupAtStore\Controller\Section\Gmap implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Wyomind\Framework\Helper\Module $framework, \Wyomind\PickupAtStore\Helper\Data $cacHelper, \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory, \Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->___init();
        parent::__construct($context, $framework, $cacHelper, $posModelFactory, $storeManager);
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
