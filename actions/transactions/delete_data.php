<?php
	require "../../configurations/connect.php";

	if (isset($_GET)) {
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
		$idDetails = isset($_GET['idDetails']) ? $_GET['idDetails'] : 0;

		$query = "UPDATE transactions SET is_deleted = 1 WHERE id = '$id';";

		$remBalanceBefore = "SELECT remaining_balance FROM transaction_details WHERE id = '$idDetails';";
		$remBalanceBefore = $conn->query($remBalanceBefore);
		$remBalanceBefore = $remBalanceBefore->fetch_assoc();

		$remBalanceAfter = floatval ($remBalanceBefore['remaining_balance']) + floatval ($amount);

		$queryTransDetails = "UPDATE transaction_details SET `remaining_balance` = $remBalanceAfter, `amount` = 0, is_deleted = 1 WHERE id = '$idDetails';";
		
		if ($conn->query($query) === TRUE && $conn->query($queryTransDetails) === TRUE) {
			session_start();
			$_SESSION['message'] = 'Transaction has been deleted';

			Header('Location: ../../index.php?page=transactions');		
		}else {
			echo "Error: " . $conn->error;
		}
	}
		
	$conn->close();
?>