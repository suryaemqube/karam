<?php

namespace Custommodule\Instaconnect\Model;

use Magento\Framework\Model\AbstractModel;

class Item extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Custommodule\Instaconnect\Model\ResourceModel\Item::class);
    }
}