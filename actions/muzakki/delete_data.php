<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$query = "UPDATE muzakki SET is_deleted = 1 WHERE id = '$id';";
		

		if ($conn->query($query) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Muzakki has been deleted';

			Header('Location: ../../index.php?page=muzakki');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>