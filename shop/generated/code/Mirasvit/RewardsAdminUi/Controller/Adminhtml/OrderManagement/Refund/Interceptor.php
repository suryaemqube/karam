<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\OrderManagement\Refund;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\OrderManagement\Refund
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\OrderManagement\Refund implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Balance $rewardsBalance, \Mirasvit\Rewards\Helper\Data $rewardsData, \Mirasvit\Rewards\Service\Order\Transaction $transactionService, \Magento\Sales\Model\OrderRepository $orderRepository, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($rewardsBalance, $rewardsData, $transactionService, $orderRepository, $context);
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
