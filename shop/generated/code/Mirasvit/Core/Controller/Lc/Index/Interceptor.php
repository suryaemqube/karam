<?php
namespace Mirasvit\Core\Controller\Lc\Index;

/**
 * Interceptor class for @see \Mirasvit\Core\Controller\Lc\Index
 */
class Interceptor extends \Mirasvit\Core\Controller\Lc\Index implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\Core\Service\PackageService $packageService, \Mirasvit\Core\Model\LicenseFactory $licenseFactory, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($packageService, $licenseFactory, $context);
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
