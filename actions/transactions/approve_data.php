<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
        $query = "UPDATE transactions SET `status` = 'Closed', `approved_date` = now() WHERE id = '$id';";

		if ($conn->query($query) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Transaction has been approved';

			Header('Location: ../../index.php?page=transactions');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>