<?php
namespace Magento\Checkout\Api\Data;

/**
 * Extension class for @see \Magento\Checkout\Api\Data\ShippingInformationInterface
 */
class ShippingInformationExtension extends \Magento\Framework\Api\AbstractSimpleObject implements ShippingInformationExtensionInterface
{
    /**
     * @return string|null
     */
    public function getPickupStore()
    {
        return $this->_get('pickup_store');
    }

    /**
     * @param string $pickupStore
     * @return $this
     */
    public function setPickupStore($pickupStore)
    {
        $this->setData('pickup_store', $pickupStore);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPickupDate()
    {
        return $this->_get('pickup_date');
    }

    /**
     * @param string $pickupDate
     * @return $this
     */
    public function setPickupDate($pickupDate)
    {
        $this->setData('pickup_date', $pickupDate);
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPickupStoreVal()
    {
        return $this->_get('pickup_store_val');
    }

    /**
     * @param string $pickupStoreVal
     * @return $this
     */
    public function setPickupStoreVal($pickupStoreVal)
    {
        $this->setData('pickup_store_val', $pickupStoreVal);
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
