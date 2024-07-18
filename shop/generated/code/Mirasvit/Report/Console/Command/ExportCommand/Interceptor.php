<?php
namespace Mirasvit\Report\Console\Command\ExportCommand;

/**
 * Interceptor class for @see \Mirasvit\Report\Console\Command\ExportCommand
 */
class Interceptor extends \Mirasvit\Report\Console\Command\ExportCommand implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\StateFactory $appStateFactory, \Mirasvit\Report\Repository\ReportRepository $repository, \Mirasvit\ReportApi\Api\RequestBuilderInterface $requestBuilder, \Magento\Framework\Filesystem $filesystem, \Mirasvit\Report\Model\Export\ConvertToCsv $convertToCsv, \Mirasvit\Report\Model\Export\ConvertToXml $convertToXml, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->___init();
        parent::__construct($appStateFactory, $repository, $requestBuilder, $filesystem, $convertToCsv, $convertToXml, $scopeConfig);
    }

    /**
     * {@inheritdoc}
     */
    public function run(\Symfony\Component\Console\Input\InputInterface $input, \Symfony\Component\Console\Output\OutputInterface $output)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'run');
        return $pluginInfo ? $this->___callPlugins('run', func_get_args(), $pluginInfo) : parent::run($input, $output);
    }
}
