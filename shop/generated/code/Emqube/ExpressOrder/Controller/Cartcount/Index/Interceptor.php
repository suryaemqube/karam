<?php
namespace Emqube\ExpressOrder\Controller\Cartcount\Index;

/**
 * Interceptor class for @see \Emqube\ExpressOrder\Controller\Cartcount\Index
 */
class Interceptor extends \Emqube\ExpressOrder\Controller\Cartcount\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Checkout\Helper\Cart $cartHelper, \Magento\Framework\App\Action\Context $context, \Magento\Framework\Message\ManagerInterface $messageManager, \Magento\Framework\Controller\ResultFactory $resultFactory)
    {
        $this->___init();
        parent::__construct($cartHelper, $context, $messageManager, $resultFactory);
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
