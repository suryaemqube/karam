<?php
/**
 * News Resource Collection
 */
namespace Karamcoffee\Maraexpress\Model\ResourceModel\Maraexpress;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Karamcoffee\Maraexpress\Model\Maraexpress', 'Karamcoffee\Maraexpress\Model\ResourceModel\Maraexpress');
    }
}
