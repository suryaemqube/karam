<?php
namespace Mirasvit\RewardsAdminUi\Controller\Adminhtml\Earning\Rule\MassDelete;

/**
 * Interceptor class for @see \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Earning\Rule\MassDelete
 */
class Interceptor extends \Mirasvit\RewardsAdminUi\Controller\Adminhtml\Earning\Rule\MassDelete implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Helper\Json $jsonHelper, \Mirasvit\Rewards\Helper\Serializer $serializer, \Mirasvit\Rewards\Model\Earning\RuleFactory $earningRuleFactory, \Magento\Framework\Stdlib\DateTime\Filter\Date $dateFilter, \Mirasvit\Rewards\Service\Rule\TierValidationService $tierValidationService, \Magento\Framework\Stdlib\DateTime\TimezoneInterface $localeDate, \Magento\Framework\Registry $registry, \Magento\Backend\App\Action\Context $context, \Magento\Ui\Component\MassAction\Filter $filter, \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\CollectionFactory $collectionFactory)
    {
        $this->___init();
        parent::__construct($jsonHelper, $serializer, $earningRuleFactory, $dateFilter, $tierValidationService, $localeDate, $registry, $context, $filter, $collectionFactory);
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
