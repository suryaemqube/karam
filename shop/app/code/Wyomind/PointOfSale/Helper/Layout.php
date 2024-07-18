<?php

/**
 * Created by PhpStorm.
 * User: Paul
 * Date: 11/10/2021
 * Time: 14:57
 */
namespace Wyomind\PointOfSale\Helper;

use Magento\Framework\App\Area;
use Magento\Framework\View\Design\Theme\FlyweightFactory;
use Magento\Framework\View\DesignInterface;
use Magento\Framework\View\Model\Layout\MergeFactory as LayoutProcessorFactory;
/**
 * Class Layout
 * @package Wyomind\PointOfSale\Helper
 */
class Layout
{
    /**
     * @var LayoutProcessorFactory
     */
    protected $layoutProcessorFactory;
    protected $layoutProcessor;
    /**
     * @var FlyweightFactory
     */
    protected $themeFactory;
    public $design;
    public function __construct(
        \Wyomind\PointOfSale\Helper\Delegate $wyomind,
        /** @delegation off */
        LayoutProcessorFactory $layoutProcessorFactory,
        /** @delegation off */
        FlyweightFactory $themeFactory
    )
    {
        $wyomind->constructor($this, $wyomind, __CLASS__);
        $this->layoutProcessorFactory = $layoutProcessorFactory;
        $this->themeFactory = $themeFactory;
    }
    /**
     * @return mixed
     */
    private function getLayoutProcessor()
    {
        if (!$this->layoutProcessor) {
            $this->layoutProcessor = $this->layoutProcessorFactory->create(['theme' => $this->themeFactory->create($this->design->getConfigurationDesignTheme(Area::AREA_FRONTEND))]);
            $this->themeFactory = null;
            $this->design = null;
        }
        return $this->layoutProcessor;
    }
    /**
     * @return mixed
     */
    public function getHandles($namespace)
    {
        $handles = $this->getLayoutProcessor()->getAvailableHandles();
        $handles = array_filter(array_map(function (string $handle) use($namespace) : ?string {
            preg_match('/^pointofsale\\_' . $namespace . '\\_([a-z0-9]+)$/i', $handle, $selectable);
            if (!empty($selectable[1])) {
                return $selectable[1];
            }
            return null;
        }, $handles));
        asort($handles);
        return $handles;
    }
}