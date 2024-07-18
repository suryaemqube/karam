<?php
namespace Magento\Checkout\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
interface ShippingInformationExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
    /**
     * @return string|null
     */
    public function getPickupStore();

    /**
     * @param string $pickupStore
     * @return $this
     */
    public function setPickupStore($pickupStore);

    /**
     * @return string|null
     */
    public function getPickupDate();

    /**
     * @param string $pickupDate
     * @return $this
     */
    public function setPickupDate($pickupDate);

    /**
     * @return string|null
     */
    public function getPickupStoreVal();

    /**
     * @param string $pickupStoreVal
     * @return $this
     */
    public function setPickupStoreVal($pickupStoreVal);

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
