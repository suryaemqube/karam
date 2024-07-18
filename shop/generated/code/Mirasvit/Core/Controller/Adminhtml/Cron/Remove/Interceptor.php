<?php
namespace Mirasvit\Core\Controller\Adminhtml\Cron\Remove;

/**
 * Interceptor class for @see \Mirasvit\Core\Controller\Adminhtml\Cron\Remove
 */
class Interceptor extends \Mirasvit\Core\Controller\Adminhtml\Cron\Remove implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Backend\App\Action\Context $context, \Magento\Cron\Model\ResourceModel\Schedule\CollectionFactory $scheduleCollectionFactory)
    {
        $this->___init();
        parent::__construct($context, $scheduleCollectionFactory);
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
