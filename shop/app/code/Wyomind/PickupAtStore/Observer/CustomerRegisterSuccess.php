<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 05/10/2020
 * Time: 15:00
 */
namespace Wyomind\PickupAtStore\Observer;

use Magento\Customer\Model\CustomerFactory;
use Magento\Framework\Event\Observer;
use Wyomind\PickupAtStore\Helper\Cookie;
use Wyomind\PointOfSale\Model\PointOfSale;
use Wyomind\PointOfSale\Model\PointOfSaleFactory;
class CustomerRegisterSuccess implements \Magento\Framework\Event\ObserverInterface
{
    public $cookieHelper;
    /**
     * @var PointOfSaleFactory
     */
    protected $posModelFactory;
    /**
     * @var CustomerFactory
     */
    protected $customerFactory;
    public function __construct(
        \Wyomind\PickupAtStore\Helper\Delegate $wyomind,
        /** @delegation off */
        PointOfSaleFactory $posModelFactory,
        /** @delegation off */
        CustomerFactory $customerFactory
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        $this->posModelFactory = $posModelFactory;
        $this->customerFactory = $customerFactory;
    }
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $preferredStore = $_COOKIE["preferred_store"] ?? "[]";
        if ($preferredStore) {
            $preferredStore = json_decode((string) $preferredStore, true);
            $storeId = $preferredStore['id'] ?? -1;
            /** @var PointOfSale $posModel */
            $posModel = $this->posModelFactory->create();
            $store = $posModel->getPlace($storeId)->getFirstItem();
            if ($store->getId()) {
                $customerModel = $this->customerFactory->create();
                $customer = $customerModel->load($customer->getId());
                $customer->setPreferredStore($storeId);
                $customer->save();
                $this->cookieHelper->setCookie("preferred_store", json_encode($preferredStore));
            } else {
                $this->cookieHelper->setCookie("preferred_store", "");
            }
        } else {
            $this->cookieHelper->setCookie("preferred_store", "");
        }
    }
}