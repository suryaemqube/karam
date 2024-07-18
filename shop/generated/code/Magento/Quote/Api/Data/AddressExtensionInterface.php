<?php
namespace Magento\Quote\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Quote\Api\Data\AddressInterface
 */
interface AddressExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
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
     * @return \Magento\SalesRule\Api\Data\RuleDiscountInterface[]|null
     */
    public function getDiscounts();

    /**
     * @param \Magento\SalesRule\Api\Data\RuleDiscountInterface[] $discounts
     * @return $this
     */
    public function setDiscounts($discounts);

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
