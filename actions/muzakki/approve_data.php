<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;

        $query = "UPDATE muzakki SET status = 'Closed' WHERE id = '$id';";

		if ($conn->query($query) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Muzakki has been approved';

			Header('Location: ../../index.php?page=muzakki');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>