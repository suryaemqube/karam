<?php
namespace Wyomind\Framework\Helper\Module;

/**
 * Proxy class for @see \Wyomind\Framework\Helper\Module
 */
class Proxy extends \Wyomind\Framework\Helper\Module implements \Magento\Framework\ObjectManager\NoninterceptableInterface
{
    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Proxied instance name
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Proxied instance
     *
     * @var \Wyomind\Framework\Helper\Module
     */
    protected $_subject = null;

    /**
     * Instance shareability flag
     *
     * @var bool
     */
    protected $_isShared = null;

    /**
     * Proxy constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @param bool $shared
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManager, $instanceName = '\\Wyomind\\Framework\\Helper\\Module', $shared = true)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
        $this->_isShared = $shared;
    }

    /**
     * @return array
     */
    public function __sleep()
    {
        return ['_subject', '_isShared', '_instanceName'];
    }

    /**
     * Retrieve ObjectManager from global scope
     */
    public function __wakeup()
    {
        $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * Clone proxied instance
     */
    public function __clone()
    {
        $this->_subject = clone $this->_getSubject();
    }

    /**
     * Get proxied instance
     *
     * @return \Wyomind\Framework\Helper\Module
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = true === $this->_isShared
                ? $this->_objectManager->get($this->_instanceName)
                : $this->_objectManager->create($this->_instanceName);
        }
        return $this->_subject;
    }

    /**
     * {@inheritdoc}
     */
    public function moduleIsEnabled($moduleName)
    {
        return $this->_getSubject()->moduleIsEnabled($moduleName);
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleList()
    {
        return $this->_getSubject()->getModuleList();
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleListAll($sort = false)
    {
        return $this->_getSubject()->getModuleListAll($sort);
    }

    /**
     * {@inheritdoc}
     */
    public function updateAvailableExtensions()
    {
        return $this->_getSubject()->updateAvailableExtensions();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllExtensions()
    {
        return $this->_getSubject()->getAllExtensions();
    }

    /**
     * {@inheritdoc}
     */
    public function updateConfigPubFolderEnabled(?\Symfony\Component\Console\Output\OutputInterface $output = null)
    {
        return $this->_getSubject()->updateConfigPubFolderEnabled($output);
    }

    /**
     * {@inheritdoc}
     */
    public function isPubFolderInUse()
    {
        return $this->_getSubject()->isPubFolderInUse();
    }

    /**
     * {@inheritdoc}
     */
    public function executeCurl($url)
    {
        return $this->_getSubject()->executeCurl($url);
    }

    /**
     * {@inheritdoc}
     */
    public function constructor($xc52, $xc69, $x689 = false)
    {
        return $this->_getSubject()->constructor($xc52, $xc69, $x689);
    }

    /**
     * {@inheritdoc}
     */
    public function getLogger()
    {
        return $this->_getSubject()->getLogger();
    }

    /**
     * {@inheritdoc}
     */
    public function getFilePath($xcbc, $xccd = '/etc/module.xml')
    {
        return $this->_getSubject()->getFilePath($xcbc, $xccd);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrefix($xd0a)
    {
        return $this->_getSubject()->getPrefix($xd0a);
    }

    /**
     * {@inheritdoc}
     */
    public function sprintfArray($xd21, $xd23)
    {
        return $this->_getSubject()->sprintfArray($xd21, $xd23);
    }

    /**
     * {@inheritdoc}
     */
    public function getFrameworkVersion()
    {
        return $this->_getSubject()->getFrameworkVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreConfig($xd3c, $xd3f = null)
    {
        return $this->_getSubject()->getStoreConfig($xd3c, $xd3f);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreConfig($xd5e, $xd5f, $xd65 = 0, $xd66 = true)
    {
        return $this->_getSubject()->setStoreConfig($xd5e, $xd5f, $xd65, $xd66);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultConfig($xd71)
    {
        return $this->_getSubject()->getDefaultConfig($xd71);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreConfigUncrypted($xd78)
    {
        return $this->_getSubject()->getStoreConfigUncrypted($xd78);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreConfigCrypted($xd86, $xd88, $xd8a = 0, $xd8b = true)
    {
        return $this->_getSubject()->setStoreConfigCrypted($xd86, $xd88, $xd8a, $xd8b);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultConfig($xd96, $xd98, $xd9d = true)
    {
        return $this->_getSubject()->setDefaultConfig($xd96, $xd98, $xd9d);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultConfigUncrypted($xda6)
    {
        return $this->_getSubject()->getDefaultConfigUncrypted($xda6);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultConfigCrypted($xdb0, $xdb4, $xdb7 = true)
    {
        return $this->_getSubject()->setDefaultConfigCrypted($xdb0, $xdb4, $xdb7);
    }

    /**
     * {@inheritdoc}
     */
    public function camelize($xdc9)
    {
        return $this->_getSubject()->camelize($xdc9);
    }

    /**
     * {@inheritdoc}
     */
    public function cleanCache($xdd0 = ['config'])
    {
        return $this->_getSubject()->cleanCache($xdd0);
    }

    /**
     * {@inheritdoc}
     */
    public function isAdmin()
    {
        return $this->_getSubject()->isAdmin();
    }

    /**
     * {@inheritdoc}
     */
    public function isCli()
    {
        return $this->_getSubject()->isCli();
    }

    /**
     * {@inheritdoc}
     */
    public function getMagentoVersion()
    {
        return $this->_getSubject()->getMagentoVersion();
    }

    /**
     * {@inheritdoc}
     */
    public function getModuleVersion($xe10)
    {
        return $this->_getSubject()->getModuleVersion($xe10);
    }

    /**
     * {@inheritdoc}
     */
    public function checkActivation($xf94, $xf96 = false)
    {
        return $this->_getSubject()->checkActivation($xf94, $xf96);
    }

    /**
     * {@inheritdoc}
     */
    public function getWarnings()
    {
        return $this->_getSubject()->getWarnings();
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->_getSubject()->getValues();
    }

    /**
     * {@inheritdoc}
     */
    public function isModuleOutputEnabled($moduleName = null)
    {
        return $this->_getSubject()->isModuleOutputEnabled($moduleName);
    }
}
