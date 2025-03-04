<?php
namespace Magento\Swatches\Block\Product\Renderer\Listing\Configurable;

/**
 * Interceptor class for @see \Magento\Swatches\Block\Product\Renderer\Listing\Configurable
 */
class Interceptor extends \Magento\Swatches\Block\Product\Renderer\Listing\Configurable implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Framework\Stdlib\ArrayUtils $arrayUtils, \Magento\Framework\Json\EncoderInterface $jsonEncoder, \Magento\ConfigurableProduct\Helper\Data $helper, \Magento\Catalog\Helper\Product $catalogProduct, \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\ConfigurableProduct\Model\ConfigurableAttributeData $configurableAttributeData, \Magento\Swatches\Helper\Data $swatchHelper, \Magento\Swatches\Helper\Media $swatchMediaHelper, array $data = [], ?\Magento\Swatches\Model\SwatchAttributesProvider $swatchAttributesProvider = null, ?\Magento\Framework\Locale\Format $localeFormat = null, ?\Magento\ConfigurableProduct\Model\Product\Type\Configurable\Variations\Prices $variationPrices = null, ?\Magento\Catalog\Model\Layer\Resolver $layerResolver = null)
    {
        $this->___init();
        parent::__construct($context, $arrayUtils, $jsonEncoder, $helper, $catalogProduct, $currentCustomer, $priceCurrency, $configurableAttributeData, $swatchHelper, $swatchMediaHelper, $data, $swatchAttributesProvider, $localeFormat, $variationPrices, $layerResolver);
    }

    /**
     * {@inheritdoc}
     */
    public function getJsonConfig()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getJsonConfig');
        return $pluginInfo ? $this->___callPlugins('getJsonConfig', func_get_args(), $pluginInfo) : parent::getJsonConfig();
    }

    /**
     * {@inheritdoc}
     */
    public function getPricesJson()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getPricesJson');
        return $pluginInfo ? $this->___callPlugins('getPricesJson', func_get_args(), $pluginInfo) : parent::getPricesJson();
    }

    /**
     * {@inheritdoc}
     */
    public function getImage($product, $imageId, $attributes = [])
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'getImage');
        return $pluginInfo ? $this->___callPlugins('getImage', func_get_args(), $pluginInfo) : parent::getImage($product, $imageId, $attributes);
    }
}
