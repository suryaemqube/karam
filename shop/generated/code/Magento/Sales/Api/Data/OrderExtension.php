<?php
namespace Magento\Sales\Api\Data;

/**
 * Extension class for @see \Magento\Sales\Api\Data\OrderInterface
 */
class OrderExtension extends \Magento\Framework\Api\AbstractSimpleObject implements OrderExtensionInterface
{
    /**
     * @return \Magento\Sales\Api\Data\ShippingAssignmentInterface[]|null
     */
    public function getShippingAssignments()
    {
        return $this->_get('shipping_assignments');
    }

    /**
     * @param \Magento\Sales\Api\Data\ShippingAssignmentInterface[] $shippingAssignments
     * @return $this
     */
    public function setShippingAssignments($shippingAssignments)
    {
        $this->setData('shipping_assignments', $shippingAssignments);
        return $this;
    }

    /**
     * @return \Magento\Payment\Api\Data\PaymentAdditionalInfoInterface[]|null
     */
    public function getPaymentAdditionalInfo()
    {
        return $this->_get('payment_additional_info');
    }

    /**
     * @param \Magento\Payment\Api\Data\PaymentAdditionalInfoInterface[] $paymentAdditionalInfo
     * @return $this
     */
    public function setPaymentAdditionalInfo($paymentAdditionalInfo)
    {
        $this->setData('payment_additional_info', $paymentAdditionalInfo);
        return $this;
    }

    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage()
    {
        return $this->_get('gift_message');
    }

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage)
    {
        $this->setData('gift_message', $giftMessage);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPickupLocationCode()
    {
        return $this->_get('pickup_location_code');
    }

    /**
     * @param string $pickupLocationCode
     * @return $this
     */
    public function setPickupLocationCode($pickupLocationCode)
    {
        $this->setData('pickup_location_code', $pickupLocationCode);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getNotificationSent()
    {
        return $this->_get('notification_sent');
    }

    /**
     * @param int $notificationSent
     * @return $this
     */
    public function setNotificationSent($notificationSent)
    {
        $this->setData('notification_sent', $notificationSent);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSendNotification()
    {
        return $this->_get('send_notification');
    }

    /**
     * @param int $sendNotification
     * @return $this
     */
    public function setSendNotification($sendNotification)
    {
        $this->setData('send_notification', $sendNotification);
        return $this;
    }

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[]|null
     */
    public function getAppliedTaxes()
    {
        return $this->_get('applied_taxes');
    }

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[] $appliedTaxes
     * @return $this
     */
    public function setAppliedTaxes($appliedTaxes)
    {
        $this->setData('applied_taxes', $appliedTaxes);
        return $this;
    }

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[]|null
     */
    public function getItemAppliedTaxes()
    {
        return $this->_get('item_applied_taxes');
    }

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[] $itemAppliedTaxes
     * @return $this
     */
    public function setItemAppliedTaxes($itemAppliedTaxes)
    {
        $this->setData('item_applied_taxes', $itemAppliedTaxes);
        return $this;
    }

    /**
     * @return boolean|null
     */
    public function getConvertingFromQuote()
    {
        return $this->_get('converting_from_quote');
    }

    /**
     * @param boolean $convertingFromQuote
     * @return $this
     */
    public function setConvertingFromQuote($convertingFromQuote)
    {
        $this->setData('converting_from_quote', $convertingFromQuote);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getRewardsBaseDiscount()
    {
        return $this->_get('rewards_base_discount');
    }

    /**
     * @param float $rewardsBaseDiscount
     * @return $this
     */
    public function setRewardsBaseDiscount($rewardsBaseDiscount)
    {
        $this->setData('rewards_base_discount', $rewardsBaseDiscount);
        return $this;
    }

    /**
     * @return float|null
     */
    public function getRewardsDiscount()
    {
        return $this->_get('rewards_discount');
    }

    /**
     * @param float $rewardsDiscount
     * @return $this
     */
    public function setRewardsDiscount($rewardsDiscount)
    {
        $this->setData('rewards_discount', $rewardsDiscount);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRewardsSpend()
    {
        return $this->_get('rewards_spend');
    }

    /**
     * @param int $rewardsSpend
     * @return $this
     */
    public function setRewardsSpend($rewardsSpend)
    {
        $this->setData('rewards_spend', $rewardsSpend);
        return $this;
    }

    /**
     * @return int|null
     */
    public function getRewardsEarn()
    {
        return $this->_get('rewards_earn');
    }

    /**
     * @param int $rewardsEarn
     * @return $this
     */
    public function setRewardsEarn($rewardsEarn)
    {
        $this->setData('rewards_earn', $rewardsEarn);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodType()
    {
        return $this->_get('payment_method_type');
    }

    /**
     * @param string $paymentMethodType
     * @return $this
     */
    public function setPaymentMethodType($paymentMethodType)
    {
        $this->setData('payment_method_type', $paymentMethodType);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPaymentMethodCardData()
    {
        return $this->_get('payment_method_card_data');
    }

    /**
     * @param string $paymentMethodCardData
     * @return $this
     */
    public function setPaymentMethodCardData($paymentMethodCardData)
    {
        $this->setData('payment_method_card_data', $paymentMethodCardData);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getW3w()
    {
        return $this->_get('w3w');
    }

    /**
     * @param string $w3w
     * @return $this
     */
    public function setW3w($w3w)
    {
        $this->setData('w3w', $w3w);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getW3wCoordinates()
    {
        return $this->_get('w3w_coordinates');
    }

    /**
     * @param string $w3wCoordinates
     * @return $this
     */
    public function setW3wCoordinates($w3wCoordinates)
    {
        $this->setData('w3w_coordinates', $w3wCoordinates);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getW3wNearest()
    {
        return $this->_get('w3w_nearest');
    }

    /**
     * @param string $w3wNearest
     * @return $this
     */
    public function setW3wNearest($w3wNearest)
    {
        $this->setData('w3w_nearest', $w3wNearest);
        return $this;
    }
}
