<?php
namespace Emqube\ExpressOrder\Controller\Variations\Index;

/**
 * Interceptor class for @see \Emqube\ExpressOrder\Controller\Variations\Index
 */
class Interceptor extends \Emqube\ExpressOrder\Controller\Variations\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\Action\Context $context, \Magento\Catalog\Model\ProductRepository $productRepository, \Magento\ConfigurableProduct\Model\Product\Type\Configurable $configurableProTypeModel, \Magento\Catalog\Model\Product $product)
    {
        $this->___init();
        parent::__construct($context, $productRepository, $configurableProTypeModel, $product);
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
