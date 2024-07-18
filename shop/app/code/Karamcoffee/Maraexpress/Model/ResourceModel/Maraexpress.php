<?php
namespace Karamcoffee\Maraexpress\Model\ResourceModel;

/**
 * News Resource Model
 */
class Maraexpress extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('karamcoffee_maraexpress', 'id');
    }
}
