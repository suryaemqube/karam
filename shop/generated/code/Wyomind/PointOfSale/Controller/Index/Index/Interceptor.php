<?php
namespace Wyomind\PointOfSale\Controller\Index\Index;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Controller\Index\Index
 */
class Interceptor extends \Wyomind\PointOfSale\Controller\Index\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Store\Model\StoreManager $storeManager, \Wyomind\Framework\Helper\Module $framework)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $storeManager, $framework);
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
