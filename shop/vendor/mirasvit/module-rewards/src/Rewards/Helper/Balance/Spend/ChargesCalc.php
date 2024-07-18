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



namespace Mirasvit\Rewards\Helper\Balance\Spend;

use Magento\Quote\Model\Quote\Address;
use Magento\Tax\Model\Config as TaxConfig;
use Mirasvit\Rewards\Model\Config;
use Mirasvit\Rewards\Service\ShippingService;

class ChargesCalc
{
    private $config;
    private $shippingService;
    private $taxConfig;

    public function __construct(
        Config $config,
        ShippingService $shippingService,
        TaxConfig $taxConfig
    ) {
        $this->config = $config;
        $this->shippingService = $shippingService;
        $this->taxConfig = $taxConfig;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @param float $subtotal
     * @return float
     */
    public function applyAdditionalCharges($quote, $subtotal)
    {
        if ((!$quote->getAwUseStoreCredit() || $quote->getIncludeSurcharge()) &&
            $quote->getBaseMagecompSurchargeAmount() && $subtotal
        ) {
            $subtotal += $quote->getBaseMagecompSurchargeAmount();
        }
        if ($quote->getAwUseStoreCredit() &&
            !$quote->getIncludeSurcharge() &&
            $subtotal >= $quote->getBaseMagecompSurchargeAmount()
        ) {
            $subtotal -= $quote->getBaseMagecompSurchargeAmount();
        }
        if ($subtotal < 0) { // compatibility with Aheadworks Store Credit
            $subtotal = 0;
        }

        return $subtotal;
    }

    /**
     * @param \Magento\Quote\Model\Quote $quote
     * @return float
     */
    public function getShippingAmount($quote)
    {
        if ($this->config->getGeneralIsSpendShipping() && !$quote->isVirtual()) {
            if (!$this->taxConfig->discountTax($quote->getStore()) &&  !$this->taxConfig->getShippingTaxClass()) {

                return $this->shippingService->getShippingAmountExclTax($quote->getShippingAddress());
            }

            return $this->shippingService->getShippingAmount();
        }

        return 0;
    }

    /**
     * @param Address $shippingAddress
     * @return float
     */
    public function getBaseRewardsShippingPrice($shippingAddress)
    {
        if ($this->config->getGeneralIsSpendShipping()) {

            if ($this->config->getGeneralIsIncludeTaxSpending()) {
                return $shippingAddress->getBaseShippingInclTax();
            } else {
                if ($this->taxConfig->shippingPriceIncludesTax()) {
                    return $shippingAddress->getBaseShippingInclTax() - $shippingAddress->getBaseShippingTaxAmount();
                } else {
                    return $shippingAddress->getBaseShippingAmount();
                }
            }
        }

        return 0;
    }
}
