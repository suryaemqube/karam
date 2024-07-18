<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Report\Aggregate;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Report\Aggregate
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Report\Aggregate implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\RewardsAdminUi\Model\ResourceModel\Report\PointsFactory $reportPointsFactory, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($reportPointsFactory, $context);
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
