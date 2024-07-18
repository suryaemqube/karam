<?php
/**
 * Copyright © 2019 Wyomind. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace Wyomind\PointOfSale\Controller;

/**
 * Class Router
 * @package Wyomind\PointOfSale\Controller
 */
class Router implements \Magento\Framework\App\RouterInterface
{


    /**
     * @var \Magento\Framework\App\ActionFactory
     */
    protected $actionFactory;

    /**
     * @var \Magento\Framework\App\ResponseInterface
     */
    protected $_response;

    /**
     * @var \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\Collection
     */
    protected $_posCollectionFactory;

    /**
     * Router constructor.
     * @param \Magento\Framework\App\ActionFactory $actionFactory
     * @param \Magento\Framework\App\ResponseInterface $response
     */
    public function __construct(
        \Magento\Framework\App\ActionFactory $actionFactory,
        \Magento\Framework\App\ResponseInterface $response,
        \Wyomind\PointOfSale\Model\ResourceModel\PointOfSale\CollectionFactory $posCollectionFactory
    ) {
    
        $this->actionFactory = $actionFactory;
        $this->_response = $response;
        $this->_posCollectionFactory = $posCollectionFactory;
    }

    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ActionInterface
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $identifier = str_replace(".html", "", trim($request->getPathInfo(), '/'));

        $pos = $this->_posCollectionFactory->create()->getByUrlKeyAndCurrentStore($identifier);

        if ($pos) {
            if (!$pos->getData('visible')) {
                $request->setModuleName('pointofsale')
                    ->setControllerName('index')
                    ->setActionName('index');

                return $this->actionFactory->create(
                    'Magento\Framework\App\Action\Forward',
                    ['request' => $request]
                );
            }

            // if store found
            $request->setModuleName('pointofsale')
                ->setControllerName('store')
                ->setActionName('index')
                ->setParam('storeId', $pos->getPlaceId());
            return $this->actionFactory->create(
                'Magento\Framework\App\Action\Forward',
                ['request' => $request]
            );
        } else {
            return false;
        }
    }
}
