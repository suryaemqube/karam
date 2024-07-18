<?php

namespace WpTablesExclude\TablesExclude\Plugin;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\Declaration\Schema\Db\DefinitionAggregator;
use Magento\Framework\Setup\Declaration\Schema\Db\MySQL\DbSchemaReader;

class DbSchemaReaderPlugin
{

    const WP_PREFIX = 'wp_';

    /**
     * @var ResourceConnection
     */
    private $resourceConnection;

    /**
     * @var DefinitionAggregator
     */
    private $definitionAggregator;

    /**
     * Constructor.
     *
     * @param ResourceConnection   $resourceConnection
     * @param DefinitionAggregator $definitionAggregator
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        DefinitionAggregator $definitionAggregator
    ) {
        $this->resourceConnection   = $resourceConnection;
        $this->definitionAggregator = $definitionAggregator;
    }


    /**
     * @param DbSchemaReader $subject
     * @param callable $proceed 
     * @param string $resource Argument from the original method call.
     *
     * @return array
     */
    public function aroundReadTables(
        DbSchemaReader $subject,
        callable $proceed,
        $resource
    ) {
        $adapter = $this->resourceConnection->getConnection($resource);
        $dbName  = $this->resourceConnection->getSchemaName($resource);
        $stmt    = $adapter->select()
                           ->from(
                               ['information_schema.TABLES'],
                               ['TABLE_NAME']
                           )
                           ->where('TABLE_SCHEMA = ?', $dbName)
                           ->where('TABLE_TYPE = ?', DbSchemaReader::MYSQL_TABLE_TYPE)
                           ->where('TABLE_NAME NOT LIKE "'.self::WP_PREFIX.'%"');

        return $adapter->fetchCol($stmt);
    }
}