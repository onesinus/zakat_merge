<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

		$query = "DELETE FROM mustahik WHERE id = '$id';";		

		if ($conn->query($query) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Mustahik has been deleted';

			Header('Location: ../../index.php?page=mustahik');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>