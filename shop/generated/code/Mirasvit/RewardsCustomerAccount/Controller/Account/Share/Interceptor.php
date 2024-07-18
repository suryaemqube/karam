<?php
namespace Mirasvit\RewardsCustomerAccount\Controller\Account\Share;

/**
 * Interceptor class for @see \Mirasvit\RewardsCustomerAccount\Controller\Account\Share
 */
class Interceptor extends \Mirasvit\RewardsCustomerAccount\Controller\Account\Share implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Service\MenuLink $menuLink, \Mirasvit\RewardsCustomerAccount\Helper\Account\Rule $accountRuleHelper, \Mirasvit\Rewards\Model\Config $config, \Mirasvit\Rewards\Model\TransactionFactory $transactionFactory, \Magento\Framework\Registry $registry, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($menuLink, $accountRuleHelper, $config, $transactionFactory, $registry, $customerSession, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }
}
