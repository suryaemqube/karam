<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Totals;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Totals
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Sales\Order\Totals implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Model\Config $config, \Magento\Framework\App\ResourceConnection $resource, \Mirasvit\Rewards\Helper\Purchase $rewardsPurchase, \Mirasvit\Rewards\Helper\Data $rewardsData, \Mirasvit\Rewards\Api\Service\RefundServiceInterface $refundService, \Mirasvit\Rewards\Service\Order\Transaction\CancelEarnedPoints $cancelEarnedPointsService, \Magento\Framework\Locale\CurrencyInterface $localeCurrency, \Magento\Framework\View\Element\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Sales\Helper\Admin $adminHelper, array $data = [])
    {
        $this->___init();
        parent::__construct($config, $resource, $rewardsPurchase, $rewardsData, $refundService, $cancelEarnedPointsService, $localeCurrency, $context, $registry, $adminHelper, $data);
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
