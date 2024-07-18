<?php

/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PointOfSale\Controller\Index;

use Magento\Store\Model\StoreManager;
use Wyomind\Framework\Helper\Module;

/**
 * Magento Version controller
 */
class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;
    /**
     * @var Module
     */
    protected $framework;
    /**
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param StoreManager $storeManager
     * @param Module $framework
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        StoreManager $storeManager,
        Module $framework
    ) {
    
        parent::__construct($context);

        $this->_resultPageFactory = $resultPageFactory;
        $this->framework = $framework;
        $this->storeManager = $storeManager;
    }

    /**
     * Load the page defined in view/frontend/layout/samplenewpage_index_index.xml
     *
     * @return \Magento\Framework\View\Result\Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();

        $layoutUpdate = $this->framework->getStoreConfig("pointofsale/settings/layout_update/storelocator", $this->storeManager->getStore()->getId());

        if (!empty($layoutUpdate)) {
            $resultPage->getLayout()->getUpdate()->addUpdate($layoutUpdate);
        }
        $resultPage->getConfig()->getTitle()->set(__('Store locator'));

        return $resultPage;
    }
}
