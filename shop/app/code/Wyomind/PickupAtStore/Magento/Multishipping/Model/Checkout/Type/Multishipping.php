<?php

namespace Wyomind\PickupAtStore\Magento\Multishipping\Model\Checkout\Type;

use Magento\Quote\Model\Quote\Address;

class Multishipping extends \Magento\Multishipping\Model\Checkout\Type\Multishipping
{

    private $storeAddressesCache = [];

    /**
     * @param int $quoteItemId
     * @param array $data
     * @return \Magento\Multishipping\Model\Checkout\Type\Multishipping
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _addShippingItem($quoteItemId, $data)
    {
        $qty = isset($data['qty']) ? (int)$data['qty'] : 1;
        $addressId = isset($data['address']) ? $data['address'] : false;

        if (stripos((string) $addressId, "pickup_") !== false) {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $posModel = $objectManager->get('Wyomind\PointOfSale\Model\PointOfsale');
            $regionModelFactory = $objectManager->get('Magento\Directory\Model\RegionFactory');
            $carrier = $objectManager->get('Wyomind\PickupAtStore\Model\Carrier\PickupAtStore');

            $placeId = (int)str_replace("pickup_", "", (string) $addressId);

            if (isset($this->storeAddressesCache[$placeId])) {
                /** @var Address $quoteAddress */
                $quoteAddress = $this->storeAddressesCache[$placeId];
                $quoteAddressItem = $quoteAddress->getItemByQuoteItemId($quoteItemId);
                if ($quoteAddressItem) {
                    $quoteAddressItem->setQty((int)($quoteAddressItem->getQty() + $qty));
                } else {
                    $quoteItem = $this->getQuote()->getItemById($quoteItemId);
                    $quoteItem->setMultishippingQty((int)$qty);
                    $quoteItem->setQty($quoteItem->getMultishippingQty());
                    $quoteAddress->addItem($quoteItem, $qty);
                }
                return $this;
            }



            /** @var \Wyomind\PointOfSale\Model\PointOfsale $store */
            $store = $posModel->load($placeId);
            if ($store) {
                $quoteItem = $this->getQuote()->getItemById($quoteItemId);

                $quoteItem->setMultishippingQty((int)$quoteItem->getMultishippingQty() + $qty);
                $quoteItem->setQty($quoteItem->getMultishippingQty());


                /** @var Address $quoteAddress */
                $quoteAddress = $this->_addressFactory->create();
                $quoteAddress->setQuoteId($this->getQuote()->getId());

                $region = $regionModelFactory->create()->loadByCode($store->getState(), $store->getCountryCode());
                $addressData = [
                    "shipping_method" => "pickupatstore_pickupatstore_" . $store->getId(),
                    "prefix" => "",
                    "firstname" => $carrier->getConfigData('title'),
                    "middlename" => "",
                    "lastname" => $store->getName(),
                    "suffix" => "",
                    "company" => "",
                    "street" => $store->getAddressLine1() . ($store->getAddressLine2() ? "\n" . $store->getAddressLine2() : ''),
                    "city" => $store->getCity(),
                    "region" => $region->getDefaultName(),
                    "region_id" => $region->getRegionId() ?: "0",
                    "postcode" => $store->getPostalCode(),
                    "country_id" => $store->getCountryCode(),
                    "telephone" => $store->getMainPhone() ?: "0000000000",
                    "fax" => "",
                    "email" => $store->getEmail() ?: "no@contact.com",
                    "save_in_address_book" => (int)false,
                    "same_as_billing" => (int)false
                ];

                $quoteAddress->setData($addressData);

                $this->getQuote()->addShippingAddress($quoteAddress);
                $quoteAddressItem = $quoteAddress->getItemByQuoteItemId($quoteItemId);
                if ($quoteAddressItem) {
                    $quoteAddressItem->setQty((int)($quoteAddressItem->getQty() + $qty));
                } else {
                    $quoteItem->setMultishippingQty((int)$qty);
                    $quoteItem->setQty($quoteItem->getMultishippingQty());
                    $quoteAddress->addItem($quoteItem, $qty);
                }

                $quoteAddress->setCollectShippingRates((bool)$this->getCollectRatesFlag());

                $this->storeAddressesCache[$store->getPlaceId()] = $quoteAddress;
            }
        } else {
            return parent::_addShippingItem($quoteItemId, $data);
        }
    }
}
