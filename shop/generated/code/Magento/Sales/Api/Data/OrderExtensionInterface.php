<?php
namespace Magento\Sales\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Sales\Api\Data\OrderInterface
 */
interface OrderExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return \Magento\Sales\Api\Data\ShippingAssignmentInterface[]|null
     */
    public function getShippingAssignments();

    /**
     * @param \Magento\Sales\Api\Data\ShippingAssignmentInterface[] $shippingAssignments
     * @return $this
     */
    public function setShippingAssignments($shippingAssignments);

    /**
     * @return \Magento\Payment\Api\Data\PaymentAdditionalInfoInterface[]|null
     */
    public function getPaymentAdditionalInfo();

    /**
     * @param \Magento\Payment\Api\Data\PaymentAdditionalInfoInterface[] $paymentAdditionalInfo
     * @return $this
     */
    public function setPaymentAdditionalInfo($paymentAdditionalInfo);

    /**
     * @return \Magento\GiftMessage\Api\Data\MessageInterface|null
     */
    public function getGiftMessage();

    /**
     * @param \Magento\GiftMessage\Api\Data\MessageInterface $giftMessage
     * @return $this
     */
    public function setGiftMessage(\Magento\GiftMessage\Api\Data\MessageInterface $giftMessage);

    /**
     * @return string|null
     */
    public function getPickupLocationCode();

    /**
     * @param string $pickupLocationCode
     * @return $this
     */
    public function setPickupLocationCode($pickupLocationCode);

    /**
     * @return int|null
     */
    public function getNotificationSent();

    /**
     * @param int $notificationSent
     * @return $this
     */
    public function setNotificationSent($notificationSent);

    /**
     * @return int|null
     */
    public function getSendNotification();

    /**
     * @param int $sendNotification
     * @return $this
     */
    public function setSendNotification($sendNotification);

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[]|null
     */
    public function getAppliedTaxes();

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsAppliedTaxInterface[] $appliedTaxes
     * @return $this
     */
    public function setAppliedTaxes($appliedTaxes);

    /**
     * @return \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[]|null
     */
    public function getItemAppliedTaxes();

    /**
     * @param \Magento\Tax\Api\Data\OrderTaxDetailsItemInterface[] $itemAppliedTaxes
     * @return $this
     */
    public function setItemAppliedTaxes($itemAppliedTaxes);

    /**
     * @return boolean|null
     */
    public function getConvertingFromQuote();

    /**
     * @param boolean $convertingFromQuote
     * @return $this
     */
    public function setConvertingFromQuote($convertingFromQuote);

    /**
     * @return float|null
     */
    public function getRewardsBaseDiscount();

    /**
     * @param float $rewardsBaseDiscount
     * @return $this
     */
    public function setRewardsBaseDiscount($rewardsBaseDiscount);

    /**
     * @return float|null
     */
    public function getRewardsDiscount();

    /**
     * @param float $rewardsDiscount
     * @return $this
     */
    public function setRewardsDiscount($rewardsDiscount);

    /**
     * @return int|null
     */
    public function getRewardsSpend();

    /**
     * @param int $rewardsSpend
     * @return $this
     */
    public function setRewardsSpend($rewardsSpend);

    /**
     * @return int|null
     */
    public function getRewardsEarn();

    /**
     * @param int $rewardsEarn
     * @return $this
     */
    public function setRewardsEarn($rewardsEarn);

    /**
     * @return string|null
     */
    public function getPaymentMethodType();

    /**
     * @param string $paymentMethodType
     * @return $this
     */
    public function setPaymentMethodType($paymentMethodType);

    /**
     * @return string|null
     */
    public function getPaymentMethodCardData();

    /**
     * @param string $paymentMethodCardData
     * @return $this
     */
    public function setPaymentMethodCardData($paymentMethodCardData);

    /**
     * @return string|null
     */
    public function getW3w();

    /**
     * @param string $w3w
     * @return $this
     */
    public function setW3w($w3w);

    /**
     * @return string|null
     */
    public function getW3wCoordinates();

    /**
     * @param string $w3wCoordinates
     * @return $this
     */
    public function setW3wCoordinates($w3wCoordinates);

    /**
     * @return string|null
     */
    public function getW3wNearest();

    /**
     * @param string $w3wNearest
     * @return $this
     */
    public function setW3wNearest($w3wNearest);
}
