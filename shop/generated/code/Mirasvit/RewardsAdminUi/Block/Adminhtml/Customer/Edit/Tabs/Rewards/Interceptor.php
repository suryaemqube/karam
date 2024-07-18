<?php
namespace Mirasvit\RewardsAdminUi\Block\Adminhtml\Customer\Edit\Tabs\Rewards;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Block\Adminhtml\Customer\Edit\Tabs\Rewards
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Block\Adminhtml\Customer\Edit\Tabs\Rewards implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Balance $rewardsBalance, \Mirasvit\Rewards\Helper\Data $rewardsData, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Framework\Registry $registry, \Magento\Backend\Block\Widget\Context $context, \Magento\Customer\Model\Customer $customerRepository, array $data = [])
    {
        $this->___init();
        parent::__construct($rewardsBalance, $rewardsData, $formFactory, $registry, $context, $customerRepository, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getForm()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getForm');
        return $pluginInfo ? $this->___callPlugins('getForm', func_get_args(), $pluginInfo) : parent::getForm();
    }
}
