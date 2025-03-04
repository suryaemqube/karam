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


namespace Mirasvit\Rewards\Api;

/**
 * Interface for rewards quote calculation
 * @api
 */
interface RewardsInterface
{
    /**
     * @param mixed $shippingCarrier //we need mixed type here
     * @param mixed $shippingMethod  //we need mixed type here
     * @param mixed $paymentMethod   //we need mixed type here
     *
     * @return \Mirasvit\Rewards\Api\Data\RewardsInterface
     */
    public function update($shippingCarrier = '', $shippingMethod = '', $paymentMethod = '');

    /**
     * @param int $cartId
     * @param int $pointAmount
     *
     * @return boolean
     */
    public function apply($cartId, $pointAmount);

    /**
     * @param int $customerId
     *
     * @return int
     */
    public function getBalance($customerId);

    /**
     * @return \Mirasvit\Rewards\Api\Data\BalanceInterface[]
     */
    public function getBalances();
}
