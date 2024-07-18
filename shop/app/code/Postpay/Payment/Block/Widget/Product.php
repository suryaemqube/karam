<?php
/**
 * Copyright © Postpay. All rights reserved.
 * See LICENSE for license details.
 */
namespace Postpay\Payment\Block\Widget;

use Magento\Catalog\Block\Product\AbstractProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Locale\Resolver;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Postpay\Payment\Gateway\Config\Config;
use Postpay\Payment\Model\Adapter\ApiAdapter;

/**
 * Product widget block.
 */
class Product extends AbstractProduct
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var PriceCurrencyInterface
     */
    private $priceCurrency;
    /**
     * @var Resolver
     */
    private $localResolver;

    /**
     * Constructor.
     *
     * @param Context $context
     * @param Config $config
     * @param PriceCurrencyInterface $priceCurrency
     * @param Resolver $LocalResolver
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        PriceCurrencyInterface $priceCurrency,
        Resolver $localResolver,
        array $data = []
    ) {
        parent::__construct($context, $data);

        $this->config = $config;
        $this->priceCurrency = $priceCurrency;
        $this->localResolver = $localResolver;
    }

    /**
     * Get Ui parameters.
     *
     * @return array
     */
    public function getUiParams()
    {
        return $this->config->getUiParams();
    }

    /**
     * Get currency code.
     *
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->priceCurrency->getCurrency()->getCurrencyCode();
    }

    /**
     * Get product final price.
     *
     * @return int
     */
    public function getFinalPrice()
    {
        return ApiAdapter::decimal($this->getProduct()->getFinalPrice());
    }

    /**
     * @inheritdoc
     */
    public function _toHtml()
    {
        if ($this->config->isActive() && $this->config->isAvailable()) {
            return parent::_toHtml();
        }
        return '';
    }
    public function getCurrentLocale(){
        $currentLocaleCode= $this->localResolver->getLocale();
        $languageCode = strstr($currentLocaleCode, '_',true);
        if(!$languageCode){
            return 'en';
        }
        return $languageCode;
    }
}
