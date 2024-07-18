<?php
namespace Emqube\Invoice\Model\Rewrite\Order\Pdf\Items\Invoice;

use Magento\Sales\Model\Order\Pdf\Items\Invoice\DefaultInvoice as CoreDefaultInvoice;

class DefaultInvoice extends CoreDefaultInvoice
{
    
    public function draw()
    {
        $order = $this->getOrder();
        $item = $this->getItem();
        $pdf = $this->getPdf();
        $page = $this->getPage();
        $lines = [];
        
        $sconto='';
        $dis_percent = '';
        $get_conbine_amountpercent='';
        $net_amount='';
        $check_amount = '0%';
        // draw Product name
        $lines[0] = [
            [
                // phpcs:ignore Magento2.Functions.DiscouragedFunction
                'text' => $this->string->split(html_entity_decode($item->getName()), 20, true, true),
                'feed' => 30
            ]
        ];
        $sku = "SKU:-".$this->getSku($item);
        $lines[][] = [
            'text' => $this->string->split($sku, 40, true, true),
            'feed' => 30,
        ];

         // draw custom column DISCOUNT

         //  discount percentage - starts
          $vat_percent = 1 +(5/100);
          $prices = $this->getItemPricesForDisplay();
          $qty = $item->getQty();
          $original_price_v1 = $item->getOrderItem()->getOriginalPrice();
          $original_without_vat = round(($original_price_v1 / $vat_percent),2);
          $price = $item->getPrice();
          // foreach ($prices as $priceData) {
          //   $discounded_price_v1 = $priceData['price'];
          //   if($qty > 0){
          //     $discounded_price_v2 = $qty * $discounded_price_v1;
          //   }
          // }
          
          if($qty > 0){
            $original_price_v2 = $qty * $original_without_vat;
            $price_v1 = $qty * $price;
          }
          
          
          $disc_price = ($original_price_v2) - ($price_v1);
          // $disc_price_final = ($disc_price) - ($item->getTaxAmount());
          if($disc_price < 0){
            $disc_price  = 0;
          }
          // $disc_percent = 100 * ($disc_price_final) / ($item->getOrderItem()->getOriginalPrice());
          $disc_percent = ceil(($disc_price / $original_price_v2)*100);
          // $dis_percent = $order->getDiscountPercent();
          // $get_conbine_amountpercent = $order->formatPriceTxt($sconto)."(".$dis_percent.")";
          $lines[0][] = [
              // 'text' => $sconto ? $order->formatPriceTxt($sconto) : "AED 0.00", 
              'text' => $disc_percent + 0 ."%",
              // 'text' => $disc_price_final,
              'feed' => 295,
              'align' => 'right'
          ];
          // discount percentage ends
            
            // $sconto = $item->getData('discount_amount');
            // $dis_percent = $order->getDiscountPercent();
            // $get_conbine_amountpercent = $order->formatPriceTxt($sconto)."(".$dis_percent.")";
            $sconto = $item->getData('discount_amount');
            // $disc_price = ($item->getOrderItem()->getOriginalPrice()) - ($item->getPrice());
            $disc_price = ($original_price_v2) - ($price_v1);
            // $disc_price_final = ($disc_price) - ($item->getTaxAmount());
            // $dis_percent = $order->getDiscountPercent();
            // $get_conbine_amountpercent = $order->formatPriceTxt($sconto)."(".$dis_percent.")";
            if($disc_price < 0){
              $disc_price  = 0;
            }
            $disc_price = ceil($disc_price);
            $lines[0][] = [
              // 'text' => $sconto ? $order->formatPriceTxt($sconto) : "AED 0.00", 
              'text' => $order->formatPriceTxt($disc_price),
              'feed' => 360,
              'align' => 'right'
            ];

            $sconto_net = $item->getData('discount_amount');

            //$price_orignal =$item->getPrice();
            //$price_orignal= $this->taxHelper->getTaxPrice($item, $item->getFinalPrice(), true);
            //$price_orignal =$item->getPrice();
            $quantity_price=1;
            $prices_show=0;
            $prices_show = $this->getItemPricesForDisplay();
            if (!empty($prices_show)) {
                $price_orignal =$prices_show[0]['price'];
                $price_orignal=str_replace("AED"," ", $price_orignal);
                $quantity_price = $item->getQty() * 1;
                $price_orignal=str_replace(",","", $price_orignal);
                $price_orignal = ((float)$price_orignal) * $quantity_price;
            
            }else{
                $price_orignal=$item->getPrice();
            }

            if($sconto_net > 0){
              
              // $net_amount = $price_orignal - $sconto_net;
            }else{
                // $net_amount=$price_orignal;
            }
            // $dis_percent = $order->getDiscountPercent();
            // $get_conbine_amountpercent = $order->formatPriceTxt($sconto)."(".$dis_percent.")";
            // $net_amount=$price_orignal;
            $net_amount =  $original_price_v2 - $disc_price;
            $net_amount = round($net_amount,2);
            $lines[0][] = [
                'text' => $order->formatPriceTxt($net_amount), 
                'feed' => 420,
                'align' => 'right'
            ];
            
        // draw SKU
        // $lines[0][] = [
        //     // phpcs:ignore Magento2.Functions.DiscouragedFunction
        //     'text' => $this->string->split(html_entity_decode($this->getSku($item)), 17),
        //     'feed' => 290,
        //     'align' => 'right',
        // ];

        // draw QTY
         //$lines[0][] = ['text' => $item->getQty() * 1, 'feed' => 435, 'align' => 'right'];
         $lines[0][] = ['text' => $item->getQty() * 1, 'feed' => 160, 'align' => 'right'];
         //net amount 
        // $lines[0][] = ['text' =>'1120', 'feed' => 250, 'align' => 'right'];
        // draw item Prices
        $i = 0;
        $prices = $this->getItemPricesForDisplay();
        //$feedPrice = 360;
        $feedPrice = 240;
        $origi_price = $item->getOrderItem()->getOriginalPrice();
        $net_amt_v1 = $item->getPrice();
        $final_vat_amount = $item->getTaxAmount();
        $gross_amt =  $net_amount + $final_vat_amount;
        $original_without_vat = $origi_price / $vat_percent;
        
        //$feedSubtotal = $feedPrice + 170; in
        $feedSubtotal = $feedPrice + 300;
        foreach ($prices as $priceData) {
            if (isset($priceData['label'])) {
                // draw Price label
                $lines[$i][] = ['text' => $priceData['label'], 'feed' => $feedPrice, 'align' => 'right'];
                // draw Subtotal label
                $lines[$i][] = ['text' => $priceData['label'], 'feed' => $feedSubtotal, 'align' => 'right'];
                $i++;
            }
            // draw Price
            $lines[$i][] = [
                // 'text' => $priceData['price'],
                'text' => $order->formatPriceTxt($original_without_vat),
                'feed' => $feedPrice,
                'font' => 'bold',
                'align' => 'right',
            ];
            // draw Subtotal
            $lines[$i][] = [
                // 'text' => $priceData['subtotal'],
                'text' => $order->formatPriceTxt($gross_amt),
                'feed' => $feedSubtotal,
                'font' => 'bold',
                'align' => 'right',
            ];
            $i++;
        }

        //draw Tax
        
        if($item->getTaxAmount() > 0){
            $check_amount = $item->getOrderItem()->getTaxPercent();
            $check_amount = $check_amount + 0 ."%";
            
        }else{
            $check_amount = '0%';
        }
    
        //$final_vat_amount = $item->getPrice() + $item->getTaxAmount();
        $final_vat_amount = $item->getTaxAmount();
        $lines[0][] = [
            'text' => $order->formatPriceTxt($final_vat_amount),
            'feed' => 470,
            'font' => 'bold',
            'align' => 'right',
        ];

         //draw discount
        //  if($item->getDiscountAmount())
        //  {
        //          $lines[0][] = array(
        //              'text'  => $order->formatPriceTxt($item->getDiscountAmount()),
        //              'feed'  => 495
        //          );
        //  }else{
        //      $lines[0][] = array(
        //          'text'  => 'shreyas',
        //          'feed'  => 495
        //      );
        //  }

        //custom options
        $options = $this->getItemOptions();
        if ($options) {
            foreach ($options as $option) {
                // draw options label
                $lines[][] = [
                    'text' => $this->string->split($this->filterManager->stripTags($option['label']), 41, true, true),
                    'font' => 'italic',
                    'feed' => 35,
                ];

                // Checking whether option value is not null
                if ($option['value'] !== null) {
                    if (isset($option['print_value'])) {
                        $printValue = $option['print_value'];
                    } else {
                        $printValue = $this->filterManager->stripTags($option['value']);
                    }
                    $values = explode(', ', $printValue);
                    foreach ($values as $value) {
                        $lines[][] = ['text' => $this->string->split($value, 30, true, true), 'feed' => 40];
                    }
                }
            }
        }

        $lineBlock = ['lines' => $lines, 'height' => 20];

        $page = $pdf->drawLineBlocks($page, [$lineBlock], ['table_header' => true]);
        $this->setPage($page);
    }
}
