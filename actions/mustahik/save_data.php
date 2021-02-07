<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$name = isset($_POST['name']) ? $_POST['name'] : '';
		$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
		$address = isset($_POST['address']) ? $_POST['address'] : '';
		
		if ($id) {
			$_SESSION['message'] = 'Mustahik has been updated';

			$query = "
				UPDATE 
					mustahik 
				SET 
					name = '$name', 
					phone_number = '$phone_number',
					address = '$address'
				WHERE 
					id = '$id'; 
			";
		}else {			
			$query = "INSERT INTO mustahik (
				name, 
				phone_number,
				address
			) VALUES(
				'$name', 
				'$phone_number',
				'$address'
			);";
		}

		if ($conn->query($query) === False) {
            $_SESSION['message'] = $conn->error;
        }
        Header('Location: ../../index.php?page=mustahik');
    }
?>