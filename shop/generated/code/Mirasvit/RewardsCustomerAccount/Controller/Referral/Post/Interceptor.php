<?php
namespace Mirasvit\RewardsCustomerAccount\Controller\Referral\Post;

/**
 * Interceptor class for @see \Mirasvit\RewardsCustomerAccount\Controller\Referral\Post
 */
class Interceptor extends \Mirasvit\RewardsCustomerAccount\Controller\Referral\Post implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Rewards\Model\ReferralFactory $referralFactory, \Mirasvit\Rewards\Model\ResourceModel\ReferralLink\CollectionFactory $referralLinkCollectionFactory, \Mirasvit\Rewards\Helper\Referral $rewardsReferral, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\Registry $registry, \Magento\Customer\Model\Session $customerSession, \Magento\Framework\Session\SessionManagerInterface $session, \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($referralFactory, $referralLinkCollectionFactory, $rewardsReferral, $storeManager, $registry, $customerSession, $session, $formKeyValidator, $context);
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
