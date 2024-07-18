<?php
namespace Magento\Customer\Api\Data;

/**
 * ExtensionInterface class for @see \Magento\Customer\Api\Data\AddressInterface
 */
interface AddressExtensionInterface extends \Magento\Framework\Api\ExtensionAttributesInterface
{
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
