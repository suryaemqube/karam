<?php
namespace Mirasvit\Report\Controller\Adminhtml\Api\Request;

/**
 * Interceptor class for @see \Mirasvit\Report\Controller\Adminhtml\Api\Request
 */
class Interceptor extends \Mirasvit\Report\Controller\Adminhtml\Api\Request implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Mirasvit\ReportApi\Api\RequestBuilderInterface $requestBuilder, \Mirasvit\Report\Api\Repository\ReportRepositoryInterface $reportRepository, \Magento\Framework\Serialize\Serializer\Json $serializer, \Magento\Backend\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($requestBuilder, $reportRepository, $serializer, $context);
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
