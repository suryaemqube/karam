<?php
namespace Mirasvit\RewardsBehavior\Controller\Twitter\Tweet;

/**
 * Interceptor class for @see \Mirasvit\RewardsBehavior\Controller\Twitter\Tweet
 */
class Interceptor extends \Mirasvit\RewardsBehavior\Controller\Twitter\Tweet implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Model\Config $config, \Mirasvit\Rewards\Helper\BehaviorRule $rewardsBehavior, \Mirasvit\Rewards\Helper\Data $rewardsData, \Magento\Customer\Model\CustomerFactory $customerFactory, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Customer\Model\Session $customerSession, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($config, $rewardsBehavior, $rewardsData, $customerFactory, $resultJsonFactory, $customerSession, $storeManager, $context);
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
