<?php

namespace Wyomind\PickupAtStore\Plugin\Checkout\Model;

use Magento\Checkout\Api\Data\TotalsInformationInterface;
use Magento\Directory\Model\Region;
use Magento\Quote\Api\CartRepositoryInterface;
use Wyomind\Framework\Helper\ModuleFactory;
use Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory;
class TotalsInformationManagement
{
    public $cartRepository = null;
    /**
     * @var null|CollectionFactory
     */
    protected $posCollectionFactory = null;
    public $regionModel = null;
    /**
     * @var ModuleFactory
     */
    protected $_framework;
    public function __construct(
        \Wyomind\PickupAtStore\Helper\Delegate $wyomind,
        /** @delegation off */
        CollectionFactory $posCollectionFactory,
        /** @delegation off */
        ModuleFactory $framework
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        $this->posCollectionFactory = $posCollectionFactory;
        $this->_framework = $framework;
    }
    public function aroundCalculate($subject, $proceed, $cartId, TotalsInformationInterface $addressInformation)
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        // $quote = $this->cartRepository->get($cartId);
        $carrierCode = $addressInformation->getShippingMethodCode();
        if (stripos((string) $carrierCode, "pickupatstore") !== false) {
            $storeId = str_replace("pickupatstore_", "", (string) $carrierCode);
            $store = $this->posCollectionFactory->create()->getPlace($storeId)->getFirstItem();
            $region = $this->regionModel->loadByCode($store->getState(), $store->getCountryCode());
            $shippingData = ["customer_address_id" => "", "prefix" => "", "firstname" => $this->_framework->create()->getStoreConfig('carriers/pickupatstore/title'), "middlename" => "", "lastname" => $store->getName(), "suffix" => "", "company" => "", "street" => $store->getAddressLine1() . ($store->getAddressLine2() ? "
" . $store->getAddressLine2() : ''), "city" => $store->getCity(), "region" => $region->getDefaultName(), "region_id" => $region->getRegionId(), "postcode" => $store->getPostalCode(), "country_id" => $store->getCountryCode(), "telephone" => $store->getMainPhone() ?: "0000000000", "fax" => "", "email" => $store->getEmail() ?: "no@contact.com", "save_in_address_book" => false];
            $addressInformation->getAddress()->addData($shippingData);
        }
        return $proceed($cartId, $addressInformation);
    }
}