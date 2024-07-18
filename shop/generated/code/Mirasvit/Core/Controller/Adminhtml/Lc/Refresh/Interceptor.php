<?php
namespace Mirasvit\Core\Controller\Adminhtml\Lc\Refresh;

/**
 * Interceptor class for @see \Mirasvit\Core\Controller\Adminhtml\Lc\Refresh
 */
class Interceptor extends \Mirasvit\Core\Controller\Adminhtml\Lc\Refresh implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Core\Model\LicenseFactory $licenseFactory, \Magento\Framework\Module\FullModuleList $fullModuleList, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($licenseFactory, $fullModuleList, $context);
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
