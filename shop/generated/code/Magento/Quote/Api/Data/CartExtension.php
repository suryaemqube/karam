<?php
namespace Magento\Quote\Api\Data;

/**
 * Extension class for @see \Magento\Quote\Api\Data\CartInterface
 */
class CartExtension extends \Magento\Framework\Api\AbstractSimpleObject implements CartExtensionInterface
{
    /**
     * @return \Magento\Quote\Api\Data\ShippingAssignmentInterface[]|null
     */
    public function getShippingAssignments()
    {
        return $this->_get('shipping_assignments');
    }

    /**
     * @param \Magento\Quote\Api\Data\ShippingAssignmentInterface[] $shippingAssignments
     * @return $this
     */
    public function setShippingAssignments($shippingAssignments)
    {
        $this->setData('shipping_assignments', $shippingAssignments);
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
