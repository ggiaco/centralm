<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Product View block
 *
 * @category Mage
 * @package  Mage_Catalog
 * @module   Catalog
 * @author   Magento Core Team <core@magentocommerce.com>
 */
class Mage_Catalog_Block_Product_View extends Mage_Catalog_Block_Product_Abstract
{
    /**
     * Default MAP renderer type
     *
     * @var string
     */
    protected $_mapRenderer = 'msrp_item';

    /**
     * Add meta information from product to head block
     *
     * @return Mage_Catalog_Block_Product_View
     */
    protected function _prepareLayout()
    {
        $this->getLayout()->createBlock('catalog/breadcrumbs');
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $product = $this->getProduct();
            $title = $product->getMetaTitle();
            if ($title) {
                $headBlock->setTitle($title);
            }
            $keyword = $product->getMetaKeyword();
            $currentCategory = Mage::registry('current_category');
            if ($keyword) {
                $headBlock->setKeywords($keyword);
            } elseif($currentCategory) {
                $headBlock->setKeywords($product->getName());
            }
            $description = $product->getMetaDescription();
            if ($description) {
                $headBlock->setDescription( ($description) );
            } else {
                $headBlock->setDescription(Mage::helper('core/string')->substr($product->getDescription(), 0, 255));
            }
            if ($this->helper('catalog/product')->canUseCanonicalTag()) {
                $params = array('_ignore_category'=>true);
                $headBlock->addLinkRel('canonical', $product->getUrlModel()->getUrl($product, $params));
            }
        }

        return parent::_prepareLayout();
    }
  function formSubmit($postdata){
    //echo "<pre>";print_r($postdata);die;
               	$name=$postdata['contact_name'];
				$email=$postdata['user_email'];
				$phone=$postdata['telephone'];
				$body=$postdata['rfq_message'];
				$product_name=$postdata['product_name'];
			    $product_mail=$postdata['product_mail'];
				
	/*..........................................Send Product Notification Mail to Admin....................................................................*/
		        $emailto="contacto@centralmayoreo.com";
			    $subject="Se cotizó un producto en CentralMayoreo";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$message  = "<table cellpadding='5' cellspacing='5'>";
				$message .=  "<tr><td colspan='2'>Estimado usuario,
				<p>".$name." ha pedido la siguiente cotización:</p>

				</td></tr>";
				$message .=  "<tr><td colspan='2'>&nbsp;</td></tr>";
				$message .=  "<tr><td colspan='2'>==============================================</td></tr>";
				$message .=  "<tr><td><b>Nombre de producto:</b></td><td>".$product_name."</td></tr>";
				$message .=  "<tr><td><b>Nombre de contacto:</b></td><td>".$name."</td></tr>";
				$message .=  "<tr><td><b>Email:</b></td><td>".$email."</td></tr>";
				$message .=  "<tr><td><b>Tel:</b></td><td>".$phone."</td></tr>";
				$message .=  "<tr><td><b>Mensaje:</b></td><td>".$body."</td></tr>";
				$message .=  "<tr><td colspan='2'>&nbsp;</td></tr>";
				$message .=  "<tr><td colspan='2'>==============================================</td></tr>";					  

				$message .=  "</table>";
				$mail = Mage::getModel('core/email');
				$mail->setToName($name);
				$mail->setToEmail($emailto);
				$mail->setBody($message);
				$mail->setSubject('Cotización en CentralMayoreo: ');
				$mail->setFromEmail('no-reply@centralmayoreo.com');
				$mail->setFromName("cliente");
				$mail->setType('html');// You can use Html or text as Mail format

				try {
				$mail->send();
	
		 // Mage::getSingleton('core/session')->addSuccess('Su petición ha sido enviada');		
				}
				catch (Exception $e) {
			
				//Mage::getSingleton('core/session')->addError('No se puede enviar.');

				
				}

				
				
	/*..........................................Send Product Notification Mail to Customer.....................................................................*/
		      //$to=$email;
			    $emailto=$email;
			    $subject="Product Request";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$message  = "Gracias por preferir CentralMayoreo.  Hemos enviado su solicitud al proveedor del producto.  Esperamos reciban una pronta respuesta, y sigan encontrando nuestro portal útil.<p/>
                           Muchas gracias:<p/>
                           - Equipo CentralMayoreo";
		        $mail = Mage::getModel('core/email');
				$mail->setToName($name);
				$mail->setToEmail($emailto);
				$mail->setBody($message);
				$mail->setSubject('Gracias por solicitar tu cotización:');
				$mail->setFromEmail('contacto@centralmayoreo.com');
				$mail->setFromName("cliente");
				$mail->setType('html');// You can use Html or text as Mail format
             try {
				$mail->send();
	
		           //Mage::getSingleton('core/session')->addSuccess('Su petición ha sido enviada');		
				}
				catch (Exception $e) {
			
				//Mage::getSingleton('core/session')->addError('No se puede enviar.');

				}
				
		/*..........................................Send Product Notification Mail to Email Id assocaited with product,If Any................................................................
                      if($product_mail!="") {	...*/
					  
			    //$to=$product_mail;
				//$emailto=$product_mail;
				$emailto="allancentralmayoreo@gmail.com";
			    $subject="Product Request";
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$message  = "<table cellpadding='5' cellspacing='5'>";
				$message .=  "<tr><td colspan='2'>Estimado usuario,
				<p>".$name." ha pedido la siguiente cotización:</p>

				</td></tr>";
				$message .=  "<tr><td colspan='2'>&nbsp;</td></tr>";
				$message .=  "<tr><td colspan='2'>==============================================</td></tr>";
				$message .=  "<tr><td><b>Nombre de producto:</b></td><td>".$product_name."</td></tr>";
				$message .=  "<tr><td><b>Nombre de contacto:</b></td><td>".$name."</td></tr>";
				$message .=  "<tr><td><b>Email:</b></td><td>".$email."</td></tr>";
				$message .=  "<tr><td><b>Tel:</b></td><td>".$phone."</td></tr>";
				$message .=  "<tr><td><b>Mensaje:</b></td><td>".$body."</td></tr>";
				$message .=  "<tr><td colspan='2'>&nbsp;</td></tr>";
				$message .=  "<tr><td colspan='2'>==============================================</td></tr>";					  

				$message .=  "</table>";
				$mail = Mage::getModel('core/email');
				$mail->setToName($name);
				$mail->setToEmail($emailto);
				$mail->setBody($message);
				$mail->setSubject('Solicitud de Cotización: -');
				$mail->setFromEmail($email);
				$mail->setFromName("cliente");
				$mail->setType('html');// You can use Html or text as Mail format



				try {
				$mail->send();
	
		  Mage::getSingleton('core/session')->addSuccess('Su petición ha sido enviada');		
				}
				catch (Exception $e) {
			
				Mage::getSingleton('core/session')->addError('No se puede enviar.');

				
				}
 /** } */

	 }
    /**
     * Retrieve current product model
     *
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        if (!Mage::registry('product') && $this->getProductId()) {
            $product = Mage::getModel('catalog/product')->load($this->getProductId());
            Mage::register('product', $product);
        }
        return Mage::registry('product');
    }

    /**
     * Check if product can be emailed to friend
     *
     * @return bool
     */
    public function canEmailToFriend()
    {
        $sendToFriendModel = Mage::registry('send_to_friend_model');
        return $sendToFriendModel && $sendToFriendModel->canEmailToFriend();
    }

    /**
     * Retrieve url for direct adding product to cart
     *
     * @param Mage_Catalog_Model_Product $product
     * @param array $additional
     * @return string
     */
    public function getAddToCartUrl($product, $additional = array())
    {
        if ($this->hasCustomAddToCartUrl()) {
            return $this->getCustomAddToCartUrl();
        }

        if ($this->getRequest()->getParam('wishlist_next')){
            $additional['wishlist_next'] = 1;
        }

        $addUrlKey = Mage_Core_Controller_Front_Action::PARAM_NAME_URL_ENCODED;
        $addUrlValue = Mage::getUrl('*/*/*', array('_use_rewrite' => true, '_current' => true));
        $additional[$addUrlKey] = Mage::helper('core')->urlEncode($addUrlValue);

        return $this->helper('checkout/cart')->getAddUrl($product, $additional);
    }

    /**
     * Get JSON encoded configuration array which can be used for JS dynamic
     * price calculation depending on product options
     *
     * @return string
     */
    public function getJsonConfig()
    {
        $config = array();
        if (!$this->hasOptions()) {
            return Mage::helper('core')->jsonEncode($config);
        }

        $_request = Mage::getSingleton('tax/calculation')->getRateRequest(false, false, false);
        /* @var $product Mage_Catalog_Model_Product */
        $product = $this->getProduct();
        $_request->setProductClassId($product->getTaxClassId());
        $defaultTax = Mage::getSingleton('tax/calculation')->getRate($_request);

        $_request = Mage::getSingleton('tax/calculation')->getRateRequest();
        $_request->setProductClassId($product->getTaxClassId());
        $currentTax = Mage::getSingleton('tax/calculation')->getRate($_request);

        $_regularPrice = $product->getPrice();
        $_finalPrice = $product->getFinalPrice();
        $_priceInclTax = Mage::helper('tax')->getPrice($product, $_finalPrice, true);
        $_priceExclTax = Mage::helper('tax')->getPrice($product, $_finalPrice);
        $_tierPrices = array();
        $_tierPricesInclTax = array();
        foreach ($product->getTierPrice() as $tierPrice) {
            $_tierPrices[] = Mage::helper('core')->currency($tierPrice['website_price'], false, false);
            $_tierPricesInclTax[] = Mage::helper('core')->currency(
                Mage::helper('tax')->getPrice($product, (int)$tierPrice['website_price'], true),
                false, false);
        }
        $config = array(
            'productId'           => $product->getId(),
            'priceFormat'         => Mage::app()->getLocale()->getJsPriceFormat(),
            'includeTax'          => Mage::helper('tax')->priceIncludesTax() ? 'true' : 'false',
            'showIncludeTax'      => Mage::helper('tax')->displayPriceIncludingTax(),
            'showBothPrices'      => Mage::helper('tax')->displayBothPrices(),
            'productPrice'        => Mage::helper('core')->currency($_finalPrice, false, false),
            'productOldPrice'     => Mage::helper('core')->currency($_regularPrice, false, false),
            'priceInclTax'        => Mage::helper('core')->currency($_priceInclTax, false, false),
            'priceExclTax'        => Mage::helper('core')->currency($_priceExclTax, false, false),
            /**
             * @var skipCalculate
             * @deprecated after 1.5.1.0
             */
            'skipCalculate'       => ($_priceExclTax != $_priceInclTax ? 0 : 1),
            'defaultTax'          => $defaultTax,
            'currentTax'          => $currentTax,
            'idSuffix'            => '_clone',
            'oldPlusDisposition'  => 0,
            'plusDisposition'     => 0,
            'plusDispositionTax'  => 0,
            'oldMinusDisposition' => 0,
            'minusDisposition'    => 0,
            'tierPrices'          => $_tierPrices,
            'tierPricesInclTax'   => $_tierPricesInclTax,
        );

        $responseObject = new Varien_Object();
        Mage::dispatchEvent('catalog_product_view_config', array('response_object'=>$responseObject));
        if (is_array($responseObject->getAdditionalOptions())) {
            foreach ($responseObject->getAdditionalOptions() as $option=>$value) {
                $config[$option] = $value;
            }
        }

        return Mage::helper('core')->jsonEncode($config);
    }

    /**
     * Return true if product has options
     *
     * @return bool
     */
    public function hasOptions()
    {
        if ($this->getProduct()->getTypeInstance(true)->hasOptions($this->getProduct())) {
            return true;
        }
        return false;
    }

    /**
     * Check if product has required options
     *
     * @return bool
     */
    public function hasRequiredOptions()
    {
        return $this->getProduct()->getTypeInstance(true)->hasRequiredOptions($this->getProduct());
    }

    /**
     * Define if setting of product options must be shown instantly.
     * Used in case when options are usually hidden and shown only when user
     * presses some button or link. In editing mode we better show these options
     * instantly.
     *
     * @return bool
     */
    public function isStartCustomization()
    {
        return $this->getProduct()->getConfigureMode() || Mage::app()->getRequest()->getParam('startcustomization');
    }

    /**
     * Get default qty - either as preconfigured, or as 1.
     * Also restricts it by minimal qty.
     *
     * @param null|Mage_Catalog_Model_Product $product
     * @return int|float
     */
    public function getProductDefaultQty($product = null)
    {
        if (!$product) {
            $product = $this->getProduct();
        }

        $qty = $this->getMinimalQty($product);
        $config = $product->getPreconfiguredValues();
        $configQty = $config->getQty();
        if ($configQty > $qty) {
            $qty = $configQty;
        }

        return $qty;
    }
}
