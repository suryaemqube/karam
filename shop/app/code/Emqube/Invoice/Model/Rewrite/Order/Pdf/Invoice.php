<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Emqube\Invoice\Model\Rewrite\Order\Pdf;

use Magento\Sales\Model\Order\Pdf\Invoice as CoreInvoice;

class Invoice extends CoreInvoice
{
  
    protected function _drawHeader(\Zend_Pdf_Page $page)
    {
        /* Add table head */
        $this->_setFontRegular($page, 10);
        $page->setFillColor(new \Zend_Pdf_Color_Rgb(0.93, 0.92, 0.92));
        $page->setLineColor(new \Zend_Pdf_Color_GrayScale(0.5));
        $page->setLineWidth(0.5);
        $page->drawRectangle(25, $this->y, 570, $this->y - 15);
        $this->y -= 10;
        $page->setFillColor(new \Zend_Pdf_Color_Rgb(0, 0, 0));

        //columns headers        

        $lines[0][] = ['text' => __('Products'), 'feed' => 30];

        // $lines[0][] = ['text' => __('SKU'), 'feed' => 290, 'align' => 'right'];

        //$lines[0][] = ['text' => __('Qty'), 'feed' => 435, 'align' => 'right'];
        $lines[0][] = ['text' => __('Qty'), 'feed' => 160, 'align' => 'right'];
        
        $lines[0][] = ['text' => __('Price'), 'feed' => 230, 'align' => 'right'];
        // custom column DISCOUNT
        $lines[0][] = ['text' => __('Discount %'), 'feed' => 295, 'align' => 'right'];
        $lines[0][] = ['text' => __('Discount Amt'), 'feed' => 360, 'align' => 'right'];

        $lines[0][] = ['text' => __('Net Amt'), 'feed' => 420, 'align' => 'right'];

        $lines[0][] = ['text' => __('VAT (5%)'), 'feed' => 470, 'align' => 'right'];

        //$lines[0][] = ['text' => __('Price'), 'feed' => 250, 'align' => 'right'];
       // $lines[0][] = ['text' => __('Net Amount'), 'feed' => 250, 'align' => 'right'];
        // $lines[0][] = ['text' => __('Tax'), 'feed' => 495, 'align' => 'right'];


        $lines[0][] = ['text' => __('Gross Amt'), 'feed' => 540, 'align' => 'right'];

        $lineBlock = ['lines' => $lines, 'height' => 5];

        $this->drawLineBlocks($page, [$lineBlock], ['table_header' => true]);
        $page->setFillColor(new \Zend_Pdf_Color_GrayScale(0));
        $this->y -= 20;
    }

    protected function _setFontRegular($object, $size = 4)
    {
        $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA); // or FONT_TIMES for serif
        $object->setFont($font, $size);
        return $font;
    }

    protected function _setFontBold($object, $size = 4)
    {
        $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA_BOLD); // or FONT_TIMES_BOLD for serif
        $object->setFont($font, $size);
        return $font;
    }

    protected function _setFontItalic($object, $size = 4)
    {
        $font = \Zend_Pdf_Font::fontWithName(\Zend_Pdf_Font::FONT_HELVETICA_ITALIC); // or FONT_TIMES_ITALIC for serif
        $object->setFont($font, $size);
        return $font;
    }

}
