<?php
namespace Postpay\Payment\Block\Widget\Product;

/**
 * Interceptor class for @see \Postpay\Payment\Block\Widget\Product
 */
class Interceptor extends \Postpay\Payment\Block\Widget\Product implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Postpay\Payment\Gateway\Config\Config $config, \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency, \Magento\Framework\Locale\Resolver $localResolver, array $data = [])
    {
        $this->___init();
        parent::__construct($context, $config, $priceCurrency, $localResolver, $data);
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
