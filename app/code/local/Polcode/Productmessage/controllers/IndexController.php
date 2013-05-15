<?php


class Polcode_Productmessage_IndexController extends Mage_Core_Controller_Front_Action{
	
	//const MAIL_ADMIN = 'contacto@centralmayoreo.com';
	const MAIL_ADMIN = 'jakub.korupczynski@polcode.pl';

	const MAIL_NOREPLY_FROM = 'no-reply@centralmayoreo.com';
	const MAIL_CONTACT_FROM = 'contacto@centralmayoreo.com';

	const MAIL_FROM_NAME = 'cliente';

	$formData = array();

	public function indexAction(){
		//get Form data:
		$this->formData['name'] = htmlspecialchars($_POST['contact_name']);
		$this->formData['email'] = htmlspecialchars($_POST['user_email']);
		$this->formData['phone'] = htmlspecialchars($_POST['telephone']);
		$this->formData['body'] = htmlspecialchars($_POST['rfq_message']);
		$this->formData['product_name'] = htmlspecialchars($_POST['product_name']);
		$this->formData['product_mail'] = htmlspecialchars($_POST['product_mail']);
	}

	private function sendMailToAdmin(){
 	   $templateId = Mage::getStoreConfig('productmessage_admin_template');
 	   $template = Mage::getModel('core/email_template')->loadDefault($templateId);

 	   $templateVariables = $this->formData;

 	   $processedTemplate = $template->getProcessedTemplate($templateVariables);

 	   $template->setSenderName(MAIL_FROM_NAME);
 	   $template->setSenderEmail(MAIL_FROM);

 	   $template->send(MAIL_ADMIN,'Admin',$templateVariables);



 	   //$subject="Se cotizó un producto en CentralMayoreo";
	   //$headers  = 'MIME-Version: 1.0' . "\r\n";
	//$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	/*			
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
				*/
	}

	private function sendMailToCustomer(){
		$templateId = Mage::getStoreConfig('productmessage_customer_template');
		$template = Mage::getModel('core/email_template')->loadDefault($templateId);

		$templateVariables = $this->formData;

		$processedTemplate = $template->getProcessedTemplate($templateVariables);

		$template->setSenderName(MAIL_FROM_NAME);
		$template->setSenderEmail(MAIL_CONTACT_FROM);

		$template->send($this->formData['email'],$this->formData['name'],$templateVariables);

		$emailto=$email;
		//$mail->setSubject('Gracias por solicitar tu cotización:');
	}

	private function sendMailToProduct(){
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
}