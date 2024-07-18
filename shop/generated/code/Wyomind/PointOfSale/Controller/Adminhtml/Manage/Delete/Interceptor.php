<?php
namespace Wyomind\PointOfSale\Controller\Adminhtml\Manage\Delete;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Controller\Adminhtml\Manage\Delete
 */
class Interceptor extends \Wyomind\PointOfSale\Controller\Adminhtml\Manage\Delete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory, \Magento\Directory\Model\ResourceModel\Region\Collection $regionCollection, \Magento\Framework\Registry $coreRegistry, \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection $posCollection, \Wyomind\PointOfSale\Model\PointOfSaleFactory $posModelFactory, \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory, \Magento\Framework\Controller\Result\RawFactory $resultRawFactory, \Wyomind\Framework\Helper\Download $framework, \Magento\Framework\Filesystem $filesystem)
    {
        $this->___init();
        parent::__construct($context, $resultPageFactory, $regionCollection, $coreRegistry, $posCollection, $posModelFactory, $resultForwardFactory, $resultRawFactory, $framework, $filesystem);
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
