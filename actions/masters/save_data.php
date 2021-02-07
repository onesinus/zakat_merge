<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$code = isset($_POST['code']) ? $_POST['code'] : '';
		$description = isset($_POST['description']) ? $_POST['description'] : '';
		
		if ($id) {
			$_SESSION['message'] = 'Master has been updated';

			$query = "UPDATE masters SET code = '$code', description = '$description' WHERE id = '$id'; ";
		}else {			
			$query = "INSERT INTO masters (
				code, 
				description
			) VALUES(
				'$code', 
				'$description'
			);";
		}

		if ($conn->query($query) === False) {
            $_SESSION['message'] = $conn->error;
        }
        Header('Location: ../../index.php?page=masters');
    }
?>