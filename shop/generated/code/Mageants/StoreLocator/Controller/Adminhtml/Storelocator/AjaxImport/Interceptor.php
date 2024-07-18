<?php
namespace Mageants\StoreLocator\Controller\Adminhtml\Storelocator\AjaxImport;

/**
 * Interceptor class for @see \Mageants\StoreLocator\Controller\Adminhtml\Storelocator\AjaxImport
 */
class Interceptor extends \Mageants\StoreLocator\Controller\Adminhtml\Storelocator\AjaxImport implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\App\Request\Http $request, \Mageants\StoreLocator\Model\ManageStore $storeModel, \Mageants\StoreLocator\Model\StoreProduct $productModel)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $request, $storeModel, $productModel);
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
