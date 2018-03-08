<?php
	session_start();
	require (__DIR__ . '/../config/chat.php');

class Kout{

	function __construct() {
		global $pdo;
		$this -> pdo = $pdo;
	}

		/**
	 	 * fetch for messages in database
	 	 */
	public function fetchConversationMessages(){
		// Select all data from database in an ascending order
	    $result = $this -> pdo -> query('SELECT chatMessage.message,
	    										user.username,
	    										user.ID

	    								 FROM 	   chatMessage
	    								 JOIN 	   user
	    								 ON   	   chatMessage.message_user = user.ID
	    								 ORDER BY  chatMessage.message_date
	    								 ASC
	    								 ');
	    return $result->fetchAll();
	}

		/**
		 * Insert the message sent by the user in the database
		 */

	public function insertMessage($user_id, $message){
		$current_time = date('Y-m-d H:i:s');

		$sql_query = "INSERT INTO chatMessage(message, message_date, message_user) 
							 VALUES(:message, :message_date, :message_user)";

		$stat = $this -> pdo -> prepare($sql_query);

		$stat->bindParam('message', $message);
		$stat->bindParam('message_date', $current_time);
		$stat->bindParam('message_user', $user_id);

		$stat->execute();
	}

		/**
		 * Get user but the unique username
		 */
	public function getUser($username){

		$sql_query = "SELECT ID, username FROM user WHERE username LIKE :username";

		$stat = $this -> pdo -> prepare($sql_query);

		$stat->bindParam('username', $username);

		$stat->execute();
		$result = $stat->fetchAll();
		return $result;
	}

		/**
		 * Check if the user already exist, if not
		 * add it to user table in database
		 */
	public function signIn($username){
		$user = $this->getUser($username);
		
		if(empty($user) === true){

			$sql_query = "INSERT INTO user(username)
								 VALUES(:username)";

			$stm = $this->pdo->prepare($sql_query);
			$stm->bindParam('username', $username);
			$stm->execute();

			$user = $this->getUser($username);
		}
			$i = 0;
			foreach ($user as $value) {
				if ($i == 0) {
					$_SESSION['user_id'] = $value['ID'];
					$_SESSION['username'] = stripslashes(htmlspecialchars($value['username']));
					echo json_encode($value);
					break;
				}
				$i++;
			}
	}
}
?>