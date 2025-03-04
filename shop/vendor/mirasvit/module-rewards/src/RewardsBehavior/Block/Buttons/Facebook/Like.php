<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   3.2.4
 * @copyright Copyright (C) 2024 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\RewardsBehavior\Block\Buttons\Facebook;

/**
 * Class Like
 *
 * Displays fb like button
 *
 * @package Mirasvit\RewardsBehavior\Block\Buttons\Facebook
 */
class Like extends \Mirasvit\RewardsBehavior\Block\Buttons\AbstractButtons
{
    /**
     * @var \Mirasvit\Rewards\Helper\Balance
     */
    protected $rewardsSocialBalance;
    /**
     * @var \Mirasvit\Rewards\Helper\Behavior
     */
    protected $rewardsBehavior;

    public function __construct(
        \Mirasvit\Rewards\Helper\Balance $rewardsSocialBalance,
        \Mirasvit\Rewards\Helper\Behavior $rewardsBehavior,
        \Mirasvit\Rewards\Model\Config $config,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Catalog\Model\ProductFactory $productFactory,
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        $this->rewardsSocialBalance = $rewardsSocialBalance;
        $this->rewardsBehavior = $rewardsBehavior;
        $this->context = $context;
        parent::__construct($config, $registry, $customerFactory, $customerSession, $productFactory, $context, $data);
    }

    /**
     * @return bool
     */
    public function isLiked()
    {
        if (!$customer = $this->_getCustomer()) {
            return false;
        }
        $url = $this->getCurrentUrl();
        $earnedTransaction = $this->rewardsSocialBalance->getEarnedPointsTransaction(
            $customer, \Mirasvit\Rewards\Model\Config::BEHAVIOR_TRIGGER_FACEBOOK_SHARE.'-'.$url
        );
        if ($earnedTransaction) {
            return true;
        }
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->getConfig()->getFacebookIsActive();
    }

    /**
     * @return string
     */
    public function _toHtml()
    {
        if ($this->isActive()) {
            return parent::_toHtml();
        }
    }

    /**
     * @return int
     * @deprecated
     */
    public function getEstimatedPointsAmount()
    {
        return $this->getEstimatedEarnPoints();
    }
}
