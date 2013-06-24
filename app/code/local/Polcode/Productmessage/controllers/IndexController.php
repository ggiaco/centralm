<?php
/**
 * 
 */

class Polcode_Productmessage_IndexController extends Mage_Core_Controller_Front_Action{
	
	const DEVELOPER_MODE = FALSE;

	const MAIL_DEVELOPER = 'gerardogiacoman@gmail.com';
	const MAIL_DEVELOPER2 = 'gerardo@centralmayoreo.com';
	const MAIL_DEVELOPER3 = 'gerardogiacoman@gmail.com';
	const MAIL_DEVELOPER4 = 'lopez.allan@gmail.com';


	//const MAIL_ADMIN = 'contacto@centralmayoreo.com';
	//const MAIL_ADMIN = 'gerardo@centralmayoreo.com';
	//const MAIL_ADMIN = 'lopez.allan@gmail.com';
	const MAIL_ADMIN = 'solicitudescentralmayoreo@gmail.com';
	
	const MAIL_NOREPLY_FROM = 'contacto@centralmayoreo.com';
	const MAIL_CONTACT_FROM = 'contacto@centralmayoreo.com';

	const MAIL_FROM_NAME = 'Equipo CentralMayoreo';

	private $formData = array();

	private $_product;

	public function indexAction(){
		$this->sendMailAction();
	}

	public function sendmailAction(){
		//get Form data:
		if (isset($_POST['contact_name'])){
			$this->formData['contact_name'] = htmlspecialchars($_POST['contact_name']);
		}
		if (isset($_POST['user_email'])){
			$this->formData['user_email'] = htmlspecialchars($_POST['user_email']);
		}
		if (isset($_POST['telephone'])){
			$this->formData['phone'] = htmlspecialchars($_POST['telephone']);
		}
		if (isset($_POST['rfq_message'])){
			$this->formData['body'] = htmlspecialchars($_POST['rfq_message']);
		}
		if (isset($_POST['category_name'])){
			$this->formData['category_name'] = htmlspecialchars($_POST['category_name']);
		}
		if (isset($_POST['subcategory_name'])){
			$this->formData['subcategory_name'] = htmlspecialchars($_POST['subcategory_name']);
		}
		if (isset($_POST['product_id'])){
			$this->formData['product_id'] = intval(htmlspecialchars($_POST['product_id']));
			$this->_product = Mage::getModel('catalog/product')->load($this->formData['product_id']);
			$this->formData['product_mail'] = $this->_product->getEmail();
			$this->formData['product_name'] = $this->_product->getName();
		}

		if ($this->_product->getId()){

			$model = Mage::getModel('productmessage/productmessage');
			$model->setName($this->formData['contact_name']);
			$model->setEmail($this->formData['user_email']);
			$model->setPhone($this->formData['phone']);
			$model->setProductId($this->formData['product_id']);
			$model->setProductName($this->_product->getName());
			$model->setMessage($this->formData['body']);
			if (isset($this->formData['category_name'])){
				$model->setCategoryName($this->formData['category_name']);
			}
			if (isset($this->formData['subcategory_name'])){
				$model->setSubcategoryName($this->formData['subcategory_name']);
			}
			$model->save();

			$this->sendMailToAdmin();
			$this->sendMailToCustomer();
			$this->sendMailToProduct();
			echo 'Su petición ha sido enviada';
			echo '<!-- Google Code for Cotizaci&oacute;n Conversion Page -->
				<script type="text/javascript">
				/* <![CDATA[ */
				var google_conversion_id = 985173252;
				var google_conversion_language = "en";
				var google_conversion_format = "3";
				var google_conversion_color = "ffffff";
				var google_conversion_label = "kNqCCMzV-wUQhJri1QM";
				var google_conversion_value = 1;
				/* ]]> */
				</script>
				<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">;
				</script>
				<noscript>
				<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/985173252/?value=1&amp;label…;
				</div>
				</noscript>';
		}
	}

	private function sendMailToAdmin(){
		$templateId = 'productmessage_admin_template';
		$template = Mage::getModel('core/email_template')->loadDefault($templateId);

		$templateVariables = $this->formData;

		$template->setSenderName(self::MAIL_FROM_NAME);
		$template->setSenderEmail(self::MAIL_NOREPLY_FROM);
		$template->setTemplateSubject('Cotización en CentralMayoreo');

		try {
			if (self::DEVELOPER_MODE)
			{
				$template->send(self::MAIL_DEVELOPER,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER2,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER3,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER4,'Admin',$templateVariables);
			}
			else
				$template->send(self::MAIL_ADMIN,'Admin',$templateVariables);
		}
		catch (Exception $e) {
			Mage::log('No se puede enviar.' , null , 'mail.log');
		}
	}

	private function sendMailToCustomer(){
		$templateId = 'productmessage_customer_template';
		$template = Mage::getModel('core/email_template')->loadDefault($templateId);

		$templateVariables = $this->formData;

		$template->setSenderName(self::MAIL_FROM_NAME);
		$template->setSenderEmail(self::MAIL_CONTACT_FROM);
		$template->setTemplateSubject('Gracias por solicitar tu cotización:');

		try {
			if (self::DEVELOPER_MODE)
			{
				$template->send(self::MAIL_DEVELOPER,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER2,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER3,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER4,'Admin',$templateVariables);
			}
			else
				$template->send($this->formData['user_email'],$this->formData['name'],$templateVariables);
		}
		catch (Exception $e) {
			Mage::log('No se puede enviar.' , null , 'mail.log');
		}
	}

	private function sendMailToProduct(){
		$templateId = 'productmessage_product_template';
		$template = Mage::getModel('core/email_template')->loadDefault($templateId);

		$templateVariables = $this->formData;

		$template->setSenderName(self::MAIL_FROM_NAME);
		//$template->setSenderEmail(self::MAIL_CONTACT_FROM);
		$template->setSenderEmail(self::$this->formData['user_email']);
		$template->setTemplateSubject('Solicitud de Cotización:');

		try {
			if (self::DEVELOPER_MODE){
				$template->send(self::MAIL_DEVELOPER,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER2,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER3,'Admin',$templateVariables);
				$template->send(self::MAIL_DEVELOPER4,'Admin',$templateVariables);
			}
			else
				$template->send($this->formData['product_mail'],'',$templateVariables);
		}
		catch (Exception $e) {
			Mage::log('No se puede enviar.' , null , 'mail.log');
		}
	}
}