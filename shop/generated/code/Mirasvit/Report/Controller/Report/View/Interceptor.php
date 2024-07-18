<?php
namespace Mirasvit\Report\Controller\Report\View;

/**
 * Interceptor class for @see \Mirasvit\Report\Controller\Report\View
 */
class Interceptor extends \Mirasvit\Report\Controller\Report\View implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\View\Result\LayoutFactory $resultLayoutFactory, \Mirasvit\Report\Repository\ReportRepository $repository, \Magento\Framework\App\Response\Http\FileFactory $fileFactory, \Mirasvit\Report\Model\Export\ConvertToXml $convertToXml, \Mirasvit\Report\Model\Export\ConvertToCsv $convertToCsv, \Mirasvit\ReportApi\Api\RequestBuilderInterface $requestBuilder, \Mirasvit\Report\Service\ResponseJsonService $responseJsonService, \Magento\Framework\Registry $registry, \Magento\Framework\App\Action\Context $context)
    {
        $this->___init();
        parent::__construct($resultLayoutFactory, $repository, $fileFactory, $convertToXml, $convertToCsv, $requestBuilder, $responseJsonService, $registry, $context);
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
