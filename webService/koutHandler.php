<?php

	require '../main/koutService.php';

	if(isset($_POST['method']) === true && empty($_POST['method']) === false){

		$mainChat = new Kout();
		$method = trim($_POST['method']);  //Get the method sent by ajax

		/**
		 * If the method sent by the user is "getMessages" then call the fetch function 
		 */
		if($method === 'getMessages' && isset($_SESSION['username'])){
			$messages = $mainChat->fetchConversationMessages();

			if(empty($messages) === true){
				echo "There are no messages in this conversation currently";
			}
			else{
				foreach ($messages as $message) {
					?>
					<div class="message">
						<p><b><i><?php echo $message['username']; ?>: </i></b><?php echo $message['message']; ?></p>
					</div>
				<?php
				}
			}
		}

		/**
		 * insert the message sent by the user
		 */
		else if($method === 'insertMessage' && isset($_POST['message']) === true){
			$message = trim($_POST['message']);

			if (empty($message) === false) {
				$mainChat->insertMessage($_SESSION['user_id'], $message);
			}
		}

		/**
		 * Authentication
		 */
		else if ($method === 'signIn' && isset($_POST['username']) === true) {
			$user = $mainChat->signIn($_POST['username']);
		}
	}

?>