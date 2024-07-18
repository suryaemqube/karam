<?php
namespace Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\Deleteorder;

/**
 * Interceptor class for @see \Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\Deleteorder
 */
class Interceptor extends \Magecomp\Deleteorder\Controller\Adminhtml\Deleteorder\Deleteorder implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magecomp\Deleteorder\Model\OrderFactory $modelOrderFactory)
    {
        $this->___init();
        parent::__construct($context, $modelOrderFactory);
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
