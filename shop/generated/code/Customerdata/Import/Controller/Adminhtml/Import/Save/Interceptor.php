<?php
namespace Customerdata\Import\Controller\Adminhtml\Import\Save;

/**
 * Interceptor class for @see \Customerdata\Import\Controller\Adminhtml\Import\Save
 */
class Interceptor extends \Customerdata\Import\Controller\Adminhtml\Import\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Framework\Filesystem $filesystem, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, \Magento\Framework\App\ResourceConnection $resource, \Magento\Framework\App\Config\ConfigResource\ConfigInterface $configResource, \Magento\Catalog\Model\Product\Media\Config $mediaConfig, \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface, \Magento\Customer\Model\CustomerFactory $customerFactory)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $filesystem, $storeManager, $scopeConfig, $resource, $configResource, $mediaConfig, $customerRepositoryInterface, $customerFactory);
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
