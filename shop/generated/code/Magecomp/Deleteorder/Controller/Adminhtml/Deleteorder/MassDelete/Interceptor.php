<?php
namespace Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\MassDelete;

/**
 * Interceptor class for @see \Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\MassDelete
 */
class Interceptor extends \Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $collectionFactory, \Magecomp\Deleteorder\Model\OrderFactory $modelOrderFactory)
    {
        $this->___init();
        parent::__construct($context, $filter, $collectionFactory, $modelOrderFactory);
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
