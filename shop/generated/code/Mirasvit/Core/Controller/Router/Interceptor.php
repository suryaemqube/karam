<?php
namespace Mirasvit\Core\Controller\Router;

/**
 * Interceptor class for @see \Mirasvit\Core\Controller\Router
 */
class Interceptor extends \Mirasvit\Core\Controller\Router implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ActionFactory $actionFactory, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Framework\App\ResponseInterface $response, \Mirasvit\Core\Api\UrlRewriteHelperInterface $urlRewrite)
    {
        $this->___init();
        parent::__construct($actionFactory, $eventManager, $response, $urlRewrite);
    }

    /**
     * {@inheritdoc}
     */
    public function match(\Magento\Framework\App\RequestInterface $request)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'match');
        return $pluginInfo ? $this->___callPlugins('match', func_get_args(), $pluginInfo) : parent::match($request);
    }
}
