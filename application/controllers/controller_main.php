<?php

namespace application\controllers;

use application\core\Controller;
use application\exceptions\Exception_Model;
use application\models\Model_Main;
use application\core\Error;
use application\core\Settings;

use application\core\types\Type_Header;

class Controller_Main extends Controller
{
    private $product_card_template;
    protected $header_buttons;
    private $model;

    function __construct()
    {
	    parent::__construct();
        $this->model = new Model_Main();
        $this->product_card_template =  Settings::getTemplate('products');
        $this->header_buttons = [
                                    ['id' => 'add', 'name' => 'ADD', 'action' => 'onclick="location.href=\'/add-product\'"'], 
                                    ['id' => 'delete-product-btn', 'name' => 'DELETE', 'action' => 'onclick="delete_product()"']
                                ]; 
    }

    function action_index()
    {

        
        $products = ''; // Array of the product types with all needed data
       
        if (!empty($_POST)) {
           //echo "POST<br>";
            //var_dump($_POST);
            $answ = 'SUCCESS';
            foreach ($_POST as $index => $id ) {
                if (!$this->model->deleteProductById($id)) {
                    $answ = "FAIL";
                    break;
                }
        
            }
            echo $answ; 
            return ;
            //print_r($_POST);
            //return 'a ' . 'b ' . 'c';
        }//else {

            try {
                $_products = $this->model->getData();
            } catch (Exception_Model $err) {
                Error::setError($err->getMessage());
            } catch (\Exception $err) {
                Error::setError($err->getMessage());
            }

            foreach ($_products as $product) {
                $products .= $this->getProductCard($product);
            }
   // }

       //echo $products . "<br>";

        $this->setData(['products' => $products]);
       
       // Error::setError(['products' => $this->page->data]);
        $this->setPageTitle('Product List');
        $this->setHeader(new Type_Header('Product List', 'show'));
        $this->getHeader()->setButtons($this->header_buttons);
        $this->setScript($this->getClassName());
        $this->setStyle($this->getClassName());
        $this->setView('main_view');
        //    echo "<pre>";
        //        print_r($_POST);
        //    echo "</pre>";
   
        $this->getViews()->render($this->getPage());
    }

    

    private function prepareUnits($str) 
    {    
        $units = ['(MB)' => ' MB', '(KG)' => 'KG']; 

        return $units[$str];
    }

    private function getProductCard($product)
    {
        $card = $this->product_card_template;
      
        $card = str_replace("%ID%", $product->getId(), $card);
        $card = str_replace("%SKU%", $product->getSku(), $card);
        $card = str_replace("%NAME%", $product->getName(), $card);
        $card = str_replace("%PRICE%", $product->getPrice(), $card);

        $card = str_replace("%ATTR%", $product->getType()->getAttributes(), $card);
        $card = str_replace("%VALUE%", $product->getAttributeValue() , $card);
        $card = str_replace("%UNITS%", $this->prepareUnits($product->getFields()->getUnits()[0]), $card);

        return $card;
    }
}