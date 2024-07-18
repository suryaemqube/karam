<?php
namespace Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection;

/**
 * Interceptor class for @see \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection
 */
class Interceptor extends \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Wyomind\PointOfSale\Helper\Delegate $wyomind, \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Wyomind\PointOfSale\Model\ResourceModel\Attributes\CollectionFactory $attributeCollectionFactory, ?\Magento\Framework\DB\Adapter\AdapterInterface $connection = null, ?\Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null)
    {
        $this->___init();
        parent::__construct($wyomind, $entityFactory, $logger, $fetchStrategy, $eventManager, $attributeCollectionFactory, $connection, $resource);
    }

    /**
     * {@inheritdoc}
     */
    public function getCurPage($displacement = 0)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getCurPage');
        return $pluginInfo ? $this->___callPlugins('getCurPage', func_get_args(), $pluginInfo) : parent::getCurPage($displacement);
    }
}
