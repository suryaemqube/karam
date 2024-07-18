<?php
namespace Mageants\StoreLocator\Controller\Adminhtml\Storelocator\Save;

/**
 * Interceptor class for @see \Mageants\StoreLocator\Controller\Adminhtml\Storelocator\Save
 */
class Interceptor extends \Mageants\StoreLocator\Controller\Adminhtml\Storelocator\Save implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Backend\Helper\Js $jsHelper, \Magento\Framework\Image\AdapterFactory $adapterFactory, \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory, \Magento\Framework\App\Filesystem\DirectoryList $directory_list, \Magento\Framework\Filesystem $filesystem, \Magento\Directory\Model\Region $regionDataCollection, \Mageants\StoreLocator\Model\ManageStore $manageStore, \Magento\Directory\Model\RegionFactory $regionFactory)
    {
        $this->___init();
        parent::__construct($context, $jsHelper, $adapterFactory, $uploaderFactory, $directory_list, $filesystem, $regionDataCollection, $manageStore, $regionFactory);
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
