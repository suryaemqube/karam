<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wyomind\PointOfSale\Model\Sitemap\ItemProvider;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
class UrlConfigReader implements \Magento\Sitemap\Model\ItemProvider\ConfigReaderInterface
{
    /**#@+
     * Xpath config settings
     */
    const XML_PATH_CHANGE_FREQUENCY = 'sitemap/page/changefreq';
    const XML_PATH_PRIORITY = 'sitemap/page/priority';
    public $scopeConfig;
    public function __construct(\Wyomind\PointOfSale\Helper\Delegate $wyomind)
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
    }
    /**
     * {@inheritdoc}
     */
    public function getPriority($storeId)
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_PRIORITY, ScopeInterface::SCOPE_STORE, $storeId);
    }
    /**
     * {@inheritdoc}
     */
    public function getChangeFrequency($storeId)
    {
        return (string) $this->scopeConfig->getValue(self::XML_PATH_CHANGE_FREQUENCY, ScopeInterface::SCOPE_STORE, $storeId);
    }
}