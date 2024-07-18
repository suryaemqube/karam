<?php
namespace Mirasvit\RewardsCatalog\Controller\Notification\GetProductNotification;

/**
 * Interceptor class for @see \Mirasvit\RewardsCatalog\Controller\Notification\GetProductNotification
 */
class Interceptor extends \Mirasvit\RewardsCatalog\Controller\Notification\GetProductNotification implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Catalog\Model\ProductRepository $productRepository, \Magento\Framework\Registry $registry, \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($productRepository, $registry, $resultJsonFactory, $context);
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
