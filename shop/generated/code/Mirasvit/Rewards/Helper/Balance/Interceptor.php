<?php
namespace Mirasvit\Rewards\Helper\Balance;

/**
 * Interceptor class for @see \Mirasvit\Rewards\Helper\Balance
 */
class Interceptor extends \Mirasvit\Rewards\Helper\Balance implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Model\BalanceFactory $balanceFactory, \Mirasvit\Rewards\Model\TransactionFactory $transactionFactory, \Mirasvit\Rewards\Model\ResourceModel\Transaction\CollectionFactory $transactionCollectionFactory, \Mirasvit\Rewards\Helper\Mail $rewardsMail, \Magento\Framework\App\ResourceConnection $resource, \Magento\Framework\App\Helper\Context $context)
    {
        $this->___init();
        parent::__construct($balanceFactory, $transactionFactory, $transactionCollectionFactory, $rewardsMail, $resource, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function changePointsBalance($customer, $pointsNum, $historyMessage, $isAllowPending, $code = false, $notifyByEmail = false, $emailMessage = false, $storeId = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'changePointsBalance');
        return $pluginInfo ? $this->___callPlugins('changePointsBalance', func_get_args(), $pluginInfo) : parent::changePointsBalance($customer, $pointsNum, $historyMessage, $isAllowPending, $code, $notifyByEmail, $emailMessage, $storeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getBalancePoints($customer)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getBalancePoints');
        return $pluginInfo ? $this->___callPlugins('getBalancePoints', func_get_args(), $pluginInfo) : parent::getBalancePoints($customer);
    }

    /**
     * {@inheritdoc}
     */
    public function getAllBalances()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getAllBalances');
        return $pluginInfo ? $this->___callPlugins('getAllBalances', func_get_args(), $pluginInfo) : parent::getAllBalances();
    }

    /**
     * {@inheritdoc}
     */
    public function getPointsForLastDays($customer, $days)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPointsForLastDays');
        return $pluginInfo ? $this->___callPlugins('getPointsForLastDays', func_get_args(), $pluginInfo) : parent::getPointsForLastDays($customer, $days);
    }

    /**
     * {@inheritdoc}
     */
    public function cancelEarnedPoints($customer, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'cancelEarnedPoints');
        return $pluginInfo ? $this->___callPlugins('cancelEarnedPoints', func_get_args(), $pluginInfo) : parent::cancelEarnedPoints($customer, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getEarnedPointsTransaction($customer, $code)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getEarnedPointsTransaction');
        return $pluginInfo ? $this->___callPlugins('getEarnedPointsTransaction', func_get_args(), $pluginInfo) : parent::getEarnedPointsTransaction($customer, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'isModuleOutputEnabled');
        return $pluginInfo ? $this->___callPlugins('isModuleOutputEnabled', func_get_args(), $pluginInfo) : parent::isModuleOutputEnabled($moduleName);
    }
}
