<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PickupAtStore\Controller\Update;

use Magento\Backend\Model\Session\Quote;
use Magento\Checkout\Model\Session;
use Magento\Directory\Model\Region;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Json\Helper\Data;
use Magento\Quote\Api\CartRepositoryInterface;
use Wyomind\Framework\Helper\Module;
use Wyomind\PickupAtStore\Helper\Config;
use Wyomind\PickupAtStore\Helper\Data as HelperData;
use Wyomind\PickupAtStore\Logger\Logger;
use Wyomind\PickupAtStore\Model\Carrier\PickupAtStore;
use Wyomind\PointOfSale\Helper\DataFactory;
use Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory;

/**
 * Controller to update the shipping date and hour
 */
class Shippingmethod extends \Magento\Framework\App\Action\Action
{
    protected $_jsonHelper = null;
    protected $_quoteRepository = null;
    protected $_checkoutSession = null;
    protected $_backendQuote = null;
    protected $_framework = null;
    protected $_posCollectionFactory = null;
    protected $_posHelperFactory = null;
    protected $_configHelper = null;
    protected $_pasHelper = null;
    protected $_region = null;
    protected $_logger = null;
    /**
     * @var PickupAtStore
     */
    protected $carrier;

    /**
     * Class constructor
     * @param Context $context
     * @param Data $jsonHelper
     * @param CartRepositoryInterface $quoteRepository
     * @param Session $checkoutSession
     * @param Quote $backendQuote
     * @param Module $framework
     * @param CollectionFactory $posCollectionFactory
     * @param DataFactory $posHelperFactory
     * @param Config $configHelper
     * @param HelperData $pasHelper
     * @param Region $region
     * @param Logger $logger
     */
    public function __construct(
        Context $context,
        Data $jsonHelper,
        CartRepositoryInterface $quoteRepository,
        Session $checkoutSession,
        Quote $backendQuote,
        Module $framework,
        CollectionFactory $posCollectionFactory,
        DataFactory $posHelperFactory,
        Config $configHelper,
        HelperData $pasHelper,
        Region $region,
        Logger $logger
    ) {
    
        $this->_jsonHelper = $jsonHelper;
        $this->_quoteRepository = $quoteRepository;
        $this->_checkoutSession = $checkoutSession;
        $this->_backendQuote = $backendQuote;
        $this->_framework = $framework;
        $this->_posCollectionFactory = $posCollectionFactory;
        $this->_posHelperFactory = $posHelperFactory;
        $this->_configHelper = $configHelper;
        $this->_pasHelper = $pasHelper;
        $this->_region = $region;
        $this->_logger = $logger;
        parent::__construct($context);
    }

    /**
     * Update the pickup date time in the quote if needed
     * @throws InputException
     */
    public function execute()
    {
        try {
            if ($this->_framework->isAdmin()) {
                $quote = $this->_backendQuote->getQuote();
            } else {
                $quote = $this->_quoteRepository->get($this->_checkoutSession->getQuoteId());
            }

            $params = $this->getRequest()->getParams('data');
            if (isset($params['data'])) {
                $data = $params['data'];
            } else {
                $data = [];
            }

            if (isset($data['store'])) {
                if (isset($data['date'])) {
                    $datetime = $data['date'];
                    if (isset($data['time']) && $data['time'] != '0') {
                        $datetime .= " " . $data['time'];
                    } else {
                        $datetime .= " 00:00";
                    }
                    $quote->setPickupDatetime($datetime);
                }
                $quote->setPickupStore($data['store']);
//                try {
//                    $this->_quoteRepository->save($quote);
//                } catch (\Exception $e) {
//                    throw new \Magento\Framework\Exception\InputException(__('Unable to save shipping information. Please check input data.'));
//                }
            } elseif (!empty($data)) {
                $addresses = [];
                foreach ($data as $input) {
                    $addresses[$input['name']] = $input['value'];
                }

                $origin = "shipping";
                if (isset($addresses["shipping_same_as_billing"]) && $addresses["shipping_same_as_billing"] == "on") {
                    $origin = "billing";
                }


                $shippingData = [
                    "prefix" => $addresses["order[" . $origin . "_address][prefix]"],
                    "firstname" => $addresses["order[" . $origin . "_address][firstname]"],
                    "middlename" => $addresses["order[" . $origin . "_address][middlename]"],
                    "lastname" => $addresses["order[" . $origin . "_address][lastname]"],
                    "suffix" => $addresses["order[" . $origin . "_address][suffix]"],
                    "company" => $addresses["order[" . $origin . "_address][company]"],
                    "street" => $addresses["order[" . $origin . "_address][street][0]"] . " " . $addresses["order[" . $origin . "_address][street][1]"],
                    "city" => $addresses["order[" . $origin . "_address][city]"],
                    "region" => $addresses["order[" . $origin . "_address][region]"],
                    "region_id" => $addresses["order[" . $origin . "_address][region_id]"],
                    "postcode" => $addresses["order[" . $origin . "_address][postcode]"],
                    "country_id" => $addresses["order[" . $origin . "_address][country_id]"],
                    "telephone" => $addresses["order[" . $origin . "_address][telephone]"],
                    "fax" => $addresses["order[" . $origin . "_address][fax]"],
                    "vat_id" => $addresses["order[" . $origin . "_address][vat_id]"],
                    "save_in_address_book" => $addresses["order[" . $origin . "_address][save_in_address_book]"] == 1,
                ];


                $quote->getShippingAddress()->addData($shippingData)->save();
                $shippingAddress = $quote->getShippingAddress();
                $shippingAddress->setCollectShippingRates(true);
                $shippingAddress->save();
                $quote->getShippingAddress()->collectShippingRates();
                $quote->setPickupDatetime(null);
                $quote->setPickupStore(null);
                $quote->save();
            } else {
                $quote->setPickupDatetime(null);
                $quote->setPickupStore(null);
                $quote->save();
            }

            if ($quote->getPickupStore()) {
                $storeId = $quote->getPickupStore();
                $store = $this->_posCollectionFactory->create()->getPlace($storeId)->getFirstItem();

                $storeDetails = $store->getName() . ' ';
                $storeDetails .= " [ ";
                $o = 0;
                if ($store->getAddressLine1()) {
                    $storeDetails .= $store->getAddressLine1();
                    $o++;
                }
                if ($store->getAddressLine2()) {
                    if ($o) {
                        $storeDetails .= ", ";
                    }
                    $storeDetails .= $store->getAddressLine2();
                    $o++;
                }
                if ($store->getCity()) {
                    if ($o) {
                        $storeDetails .= ", ";
                    }
                    $storeDetails .= $store->getCity();
                    $o++;
                }
                if ($store->getState()) {
                    if ($o) {
                        $storeDetails .= ", ";
                    }
                    $storeDetails .= $store->getState();
                    $o++;
                }
                if ($store->getPostalCode()) {
                    if ($o) {
                        $storeDetails .= ", ";
                    }
                    $storeDetails .= $store->getPostalCode() . " ";
                }
                $storeDetails .= " ]";
                $storeDetails .= "\n";

                $storeDetails .= str_replace("<br>", "\n", (string) $this->_posHelperFactory->create()->getHours($store->getHours()));

                if ($quote->getPickupDatetime()) {
                    $date = $this->_pasHelper->formatDate($quote->getPickupDatetime());
                    if ($this->_configHelper->getTime() && $date != "") {
                        $storeDetails .= "\n" . __('Your pickup time: ') . $this->_pasHelper->formatDatetime($quote->getPickupDatetime()) . "\n\n";
                    } elseif ($this->_configHelper->getDate() && $date != "") {
                        $storeDetails .= "\n" . __('Your pickup date: ') . $date . "\n\n";
                    }
                }

                $quote->setShippingDescription($storeDetails)->save();

                $region = $this->_region->loadByCode($store->getState(), $store->getCountryCode());
                $shippingData = [
                    "shipping_method" => "pickupatstore_pickupatstore_" . $store->getId(),
                    "prefix" => "",
                    "firstname" => $this->_framework->getStoreConfig('carriers/pickupatstore/title'),
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
                    "save_in_address_book" => false
                ];

                $quote->setShippingMethod("pickupatstore_pickupatstore_" . $store->getPlaceId())->save();
                $quote->getShippingAddress()->addData($shippingData)->save();
                $shippingAddress = $quote->getShippingAddress();
                $shippingAddress->setCollectShippingRates(true);
                $shippingAddress->save();
                $quote->getShippingAddress()->collectShippingRates();
            }
            $this->getResponse()->representJson($this->_jsonHelper->jsonEncode(["error" => false, "message" => "Pickup datetime saved"]));
        } catch (\Exception $exception) {
            $this->getResponse()->representJson($this->_jsonHelper->jsonEncode(["error" => true, "message" => $exception->getMessage()]));
        }
    }
}
