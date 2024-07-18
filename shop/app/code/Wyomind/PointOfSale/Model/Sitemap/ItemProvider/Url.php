<?php

/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wyomind\PointOfSale\Model\Sitemap\ItemProvider;

use Magento\Sitemap\Model\ItemProvider\ConfigReaderInterface;
use Magento\Sitemap\Model\SitemapItemInterfaceFactory;
use Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory;
use Wyomind\PointOfSale\Model\Sitemap\ItemProvider\UrlConfigReader;
class Url implements \Magento\Sitemap\Model\ItemProvider\ItemProviderInterface
{
    /**
     * Cms page factory
     *
     * @var PageFactory
     */
    private $posFactory;
    /**
     * Sitemap item factory
     *
     * @var SitemapItemInterfaceFactory
     */
    private $itemFactory;
    public $configReader;
    public function __construct(
        \Wyomind\PointOfSale\Helper\Delegate $wyomind,
        /** @delegation off */
        CollectionFactory $posCollectionFactory,
        /** @delegation off */
        SitemapItemInterfaceFactory $itemFactory
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        $this->posFactory = $posCollectionFactory;
        $this->itemFactory = $itemFactory;
    }
    /**
     * {@inheritdoc}
     */
    public function getItems($storeId)
    {
        $items = [];
        $collection = $this->posFactory->create();
        foreach ($collection as $item) {
            if ($item->getStorePageEnabled()) {
                $url = $item->getStorePageUrlKey();
                $items[] = $this->itemFactory->create(['url' => "/" . $url . ".html", 'updatedAt' => $item->getUpdatedAt(), 'images' => $item->getImages(), 'priority' => $this->configReader->getPriority($storeId), 'changeFrequency' => $this->configReader->getChangeFrequency($storeId)]);
            }
        }
        return $items;
    }
}