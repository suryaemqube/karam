<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Creditmemo\Totals;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Creditmemo\Totals
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Creditmemo\Totals implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Data $rewardsData, \Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Sales\Helper\Admin $adminHelper, array $data = [])
    {
        $this->___init();
        parent::__construct($rewardsData, $context, $registry, $adminHelper, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getOrder');
        return $pluginInfo ? $this->___callPlugins('getOrder', func_get_args(), $pluginInfo) : parent::getOrder();
    }
}
