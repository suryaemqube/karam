<?php
namespace Mirasvit\RewardsCatalog\Controller\Product\Points;

/**
 * Interceptor class for @see \Mirasvit\RewardsCatalog\Controller\Product\Points
 */
class Interceptor extends \Mirasvit\RewardsCatalog\Controller\Product\Points implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\RewardsCatalog\Service\CacheService $rewardsCacheService, \Mirasvit\Rewards\Helper\Data $rewardsDataHelper, \Mirasvit\RewardsCatalog\Helper\EarnProductPage $earnProductPageHelper, \Mirasvit\RewardsCatalog\Helper\Spend $spendHelper, \Mirasvit\Rewards\Model\Config $config, \Magento\Catalog\Api\ProductRepositoryInterface $productRepository, \Magento\Customer\Model\Session $customerSession, \Magento\Store\Model\StoreManagerInterface $storeManager, \Mirasvit\Rewards\Repository\TierRepository $tierRepository, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($rewardsCacheService, $rewardsDataHelper, $earnProductPageHelper, $spendHelper, $config, $productRepository, $customerSession, $storeManager, $tierRepository, $context);
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
