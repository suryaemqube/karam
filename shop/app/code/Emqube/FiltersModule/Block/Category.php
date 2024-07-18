<?php

namespace Emqube\FiltersModule\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Catalog\Model\CategoryFactory;
use Magento\Framework\Registry;

class Category extends Template
{
 
    protected $categoryFactory;
    protected $registry;
    protected $category;
    protected $category_id_coffee = array(41,42,43,44,45,46);
    protected $category_id_coffee_machines = array(47,51,52,53,54,55,56);

    public function __construct(
        Context $context,
        CategoryFactory $categoryFactory,
        Registry $registry,
        array $data = []
    )
    {
        $this->categoryFactory = $categoryFactory;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }
    public function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getCurrentProduct()
    {
        return $this->registry->registry('current_product');
    }
 
    public function getCategory($categoryId)
    {
        $this->category = $this->categoryFactory->create();
        $this->category->load($categoryId);
        return $this->category;
    }
    
    public function getChildCategory($categoryId)
    {
        $subCats='';
        //if($categoryId!='' || $categoryId!='2'){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $subCategory = $objectManager->create('Magento\Catalog\Model\Category')->load($categoryId); 
            $subCats = $subCategory->getChildrenCategories();
    
        //}
        return $subCats;
    }

    public function getParentCategory($categoryId)
    {
        $subCategory='';
        //if($categoryId!='' || $categoryId!='2'){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $subCategory = $objectManager->create('Magento\Catalog\Model\Category')->load($categoryId); 
        //}
        return $subCategory;
    }
    public function GetTitle($id='')
    { 
        $title='';
        if ($id!='') {
                if (in_array($id,$this->category_id_coffee)) {
                    $title='Coffee';
                }else if(in_array($id,$this->category_id_coffee_machines)){
                    $title='Coffee Equipment';
                }
        }
        return $title;
    }
    
    
}

