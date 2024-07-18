<?php

namespace Emqube\Singlesign\Observer;

use Magento\Framework\Event\ObserverInterface;


class Customelogout implements ObserverInterface
{
 public function __construct(){}

  public function execute(\Magento\Framework\Event\Observer $observer)
  {    
   
    if(!empty($_COOKIE)){
        foreach($_COOKIE as $name => $value) {
            $array=array(); 
            // Find the cookie with prefix starting with "wordpress_logged_in_"
            if(substr($name, 0, strlen('wordpress_logged_in_')) == 'wordpress_logged_in_') {
           
               
                setcookie($name, "", -1, '/');
                unset($_COOKIE[$name]);
                $array=explode('_',$name);
                if(isset($array[3])){
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/"); 
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/wp-admin"); 
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/wp-content/plugins"); 
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']); 
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']);  
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']);  
                }
                
            }else{
                $array=explode('_',$name);
                if(isset($array[3])){
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/"); 
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/wp-admin"); 
                    setcookie('wordpress_sec_'.$array[3].'',"", 1, "/wp-content/plugins"); 
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']); 
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']);  
                    unset($_COOKIE['wordpress_sec_'.$array[3].'']);  
                }
                
            } 
 
        }
    }
    return;
  } 

}