<?php
namespace Magento\Customer\Api\Data;

/**
 * Extension class for @see \Magento\Customer\Api\Data\AddressInterface
 */
class AddressExtension extends \Magento\Framework\Api\AbstractSimpleObject implements AddressExtensionInterface
{
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
