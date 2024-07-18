<?php
namespace Emqube\ExpressOrder\Controller\Price\Index;

/**
 * Interceptor class for @see \Emqube\ExpressOrder\Controller\Price\Index
 */
class Interceptor extends \Emqube\ExpressOrder\Controller\Price\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Catalog\Model\ProductRepository $productRepository, \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableProTypeModel, \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory, \Magento\Catalog\Model\Product $product)
    {
        $this->___init();
        parent::__construct($context, $productRepository, $configurableProTypeModel, $productCollectionFactory, $product);
    }

    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'execute');
        return $pluginInfo ? $this->___callPlugins('execute', func_get_args(), $pluginInfo) : parent::execute();
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'dispatch');
        return $pluginInfo ? $this->___callPlugins('dispatch', func_get_args(), $pluginInfo) : parent::dispatch($request);
    }
}
