<?php
/**
 * Mirasvit
 *
 * This source file is subject to the Mirasvit Software License, which is available at https://mirasvit.com/license/.
 * Do not edit or add to this file if you wish to upgrade the to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please refer to http://www.magentocommerce.com for more information.
 *
 * @category  Mirasvit
 * @package   mirasvit/module-rewards
 * @version   3.2.4
 * @copyright Copyright (C) 2024 Mirasvit (https://mirasvit.com/)
 */



namespace Mirasvit\Rewards\Model\ResourceModel\Earning\Rule;

/**
 * @method \Mirasvit\Rewards\Model\Earning\Rule getFirstItem()
 * @method \Mirasvit\Rewards\Model\Earning\Rule getLastItem()
 * @method \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\Collection addFieldToFilter
 * @method \Mirasvit\Rewards\Model\ResourceModel\Earning\Rule\Collection setOrder
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\TimezoneInterface
     */
    private $date;

    protected $_idFieldName = 'earning_rule_id'; //use in massaction

    /**
     * @var \Magento\Framework\Data\Collection\EntityFactoryInterface
     */
    protected $entityFactory;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var \Magento\Framework\Data\Collection\Db\FetchStrategyInterface
     */
    protected $fetchStrategy;

    /**
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\DB\Adapter\AdapterInterface
     */
    protected $connection;

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected $resource;

    /**
     * @param \Magento\Framework\Stdlib\DateTime\TimezoneInterface         $date
     * @param \Magento\Framework\Data\Collection\EntityFactoryInterface    $entityFactory
     * @param \Psr\Log\LoggerInterface                                     $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface                    $eventManager
     * @param \Magento\Store\Model\StoreManagerInterface                   $storeManager
     * @param \Magento\Framework\DB\Adapter\AdapterInterface               $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb         $resource
     */
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $date,
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->date          = $date;
        $this->entityFactory = $entityFactory;
        $this->logger        = $logger;
        $this->fetchStrategy = $fetchStrategy;
        $this->eventManager  = $eventManager;
        $this->storeManager  = $storeManager;
        $this->connection    = $connection;
        $this->resource      = $resource;

        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Mirasvit\Rewards\Model\Earning\Rule', 'Mirasvit\Rewards\Model\ResourceModel\Earning\Rule');
    }

    /**
     * @param bool|false $emptyOption
     * @return array
     */
    public function toOptionArray($emptyOption = false)
    {
        $arr = [];
        if ($emptyOption) {
            $arr[0] = ['value' => 0, 'label' => __('-- Please Select --')];
        }
        /** @var \Mirasvit\Rewards\Model\Earning\Rule $item */
        foreach ($this as $item) {
            $arr[] = ['value' => $item->getId(), 'label' => $item->getName()];
        }

        return $arr;
    }

    /**
     * @param bool|false $emptyOption
     * @return array
     */
    public function getOptionArray($emptyOption = false)
    {
        $arr = [];
        if ($emptyOption) {
            $arr[0] = __('-- Please Select --');
        }
        /** @var \Mirasvit\Rewards\Model\Earning\Rule $item */
        foreach ($this as $item) {
            $arr[$item->getId()] = $item->getName();
        }

        return $arr;
    }

    /**
     * @param int $websiteId
     * @return $this
     */
    public function addWebsiteFilter($websiteId)
    {
        $this->getSelect()
            ->where("EXISTS (SELECT * FROM `{$this->getTable('mst_rewards_earning_rule_website')}`
                AS `earning_rule_website_table`
                WHERE main_table.earning_rule_id = earning_rule_website_table.earning_rule_id
                AND earning_rule_website_table.website_id in (?))", [-1, $websiteId]);

        return $this;
    }

    /**
     * @return $this
     */
    public function addWebsiteColumn()
    {
        $this->getSelect()
            ->columns(
                ['website_ids' => new \Zend_Db_Expr(
                    "(SELECT GROUP_CONCAT(website_id) FROM `{$this->getTable('mst_rewards_earning_rule_website')}`
                    AS `earning_rule_website_table`
                    WHERE main_table.earning_rule_id = earning_rule_website_table.earning_rule_id)")]
            );

        return $this;
    }

    /**
     * @param int $customerGroupId
     * @return $this
     */
    public function addCustomerGroupFilter($customerGroupId)
    {
        $this->getSelect()
            ->where("EXISTS (SELECT * FROM `{$this->getTable('mst_rewards_earning_rule_customer_group')}`
                AS `earning_rule_customer_group_table`
                WHERE main_table.earning_rule_id = earning_rule_customer_group_table.earning_rule_id
                AND earning_rule_customer_group_table.customer_group_id in (?))", ['all', $customerGroupId]);

        return $this;
    }

    /**
     * @return $this
     */
    public function addCustomerGroupColumn()
    {
        $this->getSelect()
            ->columns(
                ['customer_group_ids' => new \Zend_Db_Expr(
                    "(SELECT GROUP_CONCAT(customer_group_id) FROM `{$this->getTable('mst_rewards_earning_rule_customer_group')}`
                    AS `earning_rule_customer_group_table`
                    WHERE main_table.earning_rule_id = earning_rule_customer_group_table.earning_rule_id)")]
            );

        return $this;
    }

    /**
     * @return void
     */
    protected function initFields()
    {
        $this->getSelect();
    }

    /**
     * @return void
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->initFields();
    }

    /**
     * @var int
     */
    protected $storeId;

    /**
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;

        return $this;
    }

    /**
     * @return void
     */
    public function _afterLoad()
    {
        if ($this->storeId) {
            foreach ($this as $item) {
                $item->setStoreId($this->storeId);
            }
        }
    }

    /************************/

    /**
     * @return $this
     */
    public function addIsActiveFilter()
    {
        $this->addFieldToFilter('is_active', true);

        return $this;
    }

    /**
     * @return $this
     */
    public function addCurrentFilter()
    {
        $this->addIsActiveFilter();
        $now = $this->date->date()->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);
        $this->getSelect()
            ->where(
                "(main_table.active_from <= '$now' OR isnull(main_table.active_from)) AND " .
                " ('$now' <= CONCAT(main_table.active_to, ' 23:59:59') OR isnull(main_table.active_to))");

        return $this;
    }

    /**
     * @return $this
     */
    public function addShowOnProductPageFilter()
    {
        $this->addFieldToFilter('is_show_on_product_page', true);

        return $this;
    }

    /**
     * @return $this
     */
    public function addProductPageFilter()
    {
        $this->addIsActiveFilter();
        $now = $this->date->date()->format(\Magento\Framework\Stdlib\DateTime::DATETIME_PHP_FORMAT);
        $this->getSelect()
            ->where(
                "(main_table.type = '" . \Mirasvit\Rewards\Model\Earning\Rule::TYPE_CART . "' " .
                "AND main_table.is_show_on_product_page = 1)"
            );
        return $this;
    }

    /**
     * @return $this
     */
    public function addEarnPointsColumn()
    {
        $nameExpr = new \Zend_Db_Expr('IF (' .
            'main_table.monetary_step > 0, ' .
            'CONCAT("earn ", main_table.earn_points, " points for each $", main_table.monetary_step), ' .
            'CONCAT(main_table.earn_points, " points")' .
            ') as earn_points_str'
        );
        $this->getSelect()->columns($nameExpr);

        return $this;
    }
}
