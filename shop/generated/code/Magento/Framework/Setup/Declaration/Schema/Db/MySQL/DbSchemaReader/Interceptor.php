<?php
namespace Magento\Framework\Setup\Declaration\Schema\Db\MySQL\DbSchemaReader;

/**
 * Interceptor class for @see \Magento\Framework\Setup\Declaration\Schema\Db\MySQL\DbSchemaReader
 */
class Interceptor extends \Magento\Framework\Setup\Declaration\Schema\Db\MySQL\DbSchemaReader implements \Magento\Framework\Interception\InterceptorInterface
{
    use \Magento\Framework\Interception\Interceptor;

    public function __construct(\Magento\Framework\App\ResourceConnection $resourceConnection, \Magento\Framework\Setup\Declaration\Schema\Db\DefinitionAggregator $definitionAggregator)
    {
        $this->___init();
        parent::__construct($resourceConnection, $definitionAggregator);
    }

    /**
     * {@inheritdoc}
     */
    public function readTables($resource)
    {
        $pluginInfo = $this->pluginList->getNext($this->subjectType, 'readTables');
        return $pluginInfo ? $this->___callPlugins('readTables', func_get_args(), $pluginInfo) : parent::readTables($resource);
    }
}
