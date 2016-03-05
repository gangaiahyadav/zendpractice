<?php

class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
	public function FlashMessenger()
	{
		$flashMessenger = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger');
		if($flashMessenger->setNamespace('success')->hasMessages()): ?>
        		<div class="message success" >
                	<?php foreach($flashMessenger->getMesseges() as $msg): echo $msg; endforeach; ?>                
                </div>
       <?php
		endif;
		if($flashMessenger->setNamespace('failed')->hasMessages()):
		?>
        	<div class="message error">
            	<?php foreach($flashMessenger->getMessages() as $msg): echo $msg; endforeach; ?>
            </div>
        <?php 		
		endif;			
	}
}
?>

