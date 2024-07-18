<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Wyomind\PointOfSale\Model\ResourceModel\PointOfSale;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Wyomind\PointOfSale\Model\ResourceModel\Attributes\CollectionFactory;
/**
 * Point of sale collection
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public $storeManager;
    /**
     * @var CollectionFactory
     */
    public $attributeCollectionFactory;
    public function __construct(
        \Wyomind\PointOfSale\Helper\Delegate $wyomind,
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        /** @delegation off */
        CollectionFactory $attributeCollectionFactory,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->attributeCollectionFactory = $attributeCollectionFactory;
    }
    /**
     * Define resource model
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Wyomind\\PointOfSale\\Model\\PointOfSale', 'Wyomind\\PointOfSale\\Model\\ResourceModel\\PointOfSale');
    }
    /**
     * @param $id
     * @return $this
     */
    public function getPlace($id)
    {
        $this->getSelect()->where("place_id=" . $id . "")->limit(1);
        return $this;
    }
    public function addCustomAttributes()
    {
        $pointofsaleAttributesValues = $this->getTable("pointofsale_attributes_values");
        $coll = $this->attributeCollectionFactory->create();
        foreach ($coll as $att) {
            $this->getSelect()->joinLeft(["pav" . $att->getId() => $pointofsaleAttributesValues], "pav" . $att->getId() . ".pointofsale_id = main_table.place_id and pav" . $att->getId() . ".attribute_id=" . $att->getId(), [$att->getCode() => "pav" . $att->getId() . ".value"]);
        }
    }
    /**
     * @param $storeId
     * @param $whereGroupId
     * @return $this
     */
    public function getPlacesByStoreId($storeId, $whereGroupId)
    {
        $where = null;
        if ($whereGroupId !== null) {
            $where = " AND FIND_IN_SET(" . $whereGroupId . ",main_table.customer_group)";
        }
        $this->getSelect()->where("FIND_IN_SET(" . $storeId . ",main_table.store_id) " . $where)->order('position ASC');
        return $this;
    }
    /**
     * @param $storeId
     * @return $this
     */
    public function getCountries($storeId)
    {
        $this->getSelect()->where("FIND_IN_SET(" . $storeId . ",main_table.store_id) ")->group('main_table.country_code');
        return $this;
    }
    /**
     * @return $this
     */
    public function getLastInsertedId()
    {
        $this->getSelect()->order('place_id DESC')->limit(1);
        return $this;
    }
    /**
     * @param $urlKey
     * @return \Magento\Framework\DataObject|null
     */
    public function getByUrlKey($urlKey)
    {
        $collection = $this->addFieldToFilter("store_page_url_key", ['eq' => $urlKey])->addFieldToFilter("store_page_enabled", ['eq' => 1]);
        if (count($collection)) {
            return $this->getFirstItem();
        } else {
            return null;
        }
    }
    function getByUrlKeyAndCurrentStore($urlKey)
    {
        $collection = $this->addFieldToFilter("store_page_url_key", ['eq' => $urlKey])->addFieldToFilter("store_page_enabled", ['eq' => 1]);
        if (count($collection)) {
            $place = $this->getFirstItem();
            $storeIds = $place->getStoreId();
            if ($storeIds) {
                $storeIds = explode(',', $storeIds);
            }
            $place->setData('visible', true);
            if (!in_array($this->storeManager->getStore()->getId(), $storeIds)) {
                $place->setData('visible', false);
            }
            return $place;
        } else {
            return null;
        }
    }
}