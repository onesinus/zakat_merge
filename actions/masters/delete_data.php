<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$query = "DELETE FROM masters WHERE id = '$id';";		

		if ($conn->query($query) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Master has been deleted';

			Header('Location: ../../index.php?page=masters');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>