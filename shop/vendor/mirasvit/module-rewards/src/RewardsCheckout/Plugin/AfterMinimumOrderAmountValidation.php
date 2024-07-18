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



namespace Mirasvit\RewardsCheckout\Plugin;

use Mirasvit\Rewards\Model\Config;
use Magento\Quote\Model\Quote\Address;
use Mirasvit\Rewards\Helper\Purchase;
use Mirasvit\RewardsCheckout\Registry;

/**
 * @package Mirasvit\Rewards\Plugin
 * @see \Magento\Quote\Model\Quote\Address
 */
class AfterMinimumOrderAmountValidation
{
    private $config;

    private $rewardsPurchase;

    private $registry;

    public function __construct(
        Purchase $rewardsPurchase,
        Config $config,
        Registry $registry
    ) {
        $this->config          = $config;
        $this->rewardsPurchase = $rewardsPurchase;
        $this->registry        = $registry;
    }

    /**
     * @param Address $quoteAddress
     * @param    bool     $result
     */
    public function afterValidateMinimumAmount(Address $quoteAddress, $result)
    {
        $this->registry->isSkipOrderAmountValidation(true);
    }
}
