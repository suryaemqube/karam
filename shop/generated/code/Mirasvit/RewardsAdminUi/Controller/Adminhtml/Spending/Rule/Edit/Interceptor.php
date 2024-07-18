<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\Edit;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\Edit
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Spending\Rule\Edit implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Json $jsonHelper, \Mirasvit\Rewards\Model\Spending\RuleFactory $spendingRuleFactory, \Mirasvit\Rewards\Service\Rule\TierValidationService $tierValidationService, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Magento\Framework\Registry $registry, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($jsonHelper, $spendingRuleFactory, $tierValidationService, $localeDate, $dateFilter, $registry, $context);
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
