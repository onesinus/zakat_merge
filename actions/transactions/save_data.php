<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
        }

		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$type = isset($_POST['data'][0]) ? $_POST['data'][0] : '';
		$total = isset($_POST['data'][1]) ? $_POST['data'][1] : '';

		$status = "Open";
		
		$user = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : null;
		$user_id = $user["id"];
		
		if ($id) {
			$_SESSION['message'] = 'Transaction has been updated';

			$query = "SELECT 1";
		}else {
			$_SESSION['message'] = 'Transaction has been added';
			
			$query = "INSERT INTO transactions (
				type, 
				total,
				status,
				created_by
			) VALUES(
				'$type', 
				'$total', 
				'$status', 
				'$user_id'
			);";

			$query2 = "
				INSERT INTO transaction_details (
					transaction_id,
					note,
					balance,
					remaining_balance,
					amount,
					total_unit,
					type
				) VALUES
			";

			foreach ($_POST['detail'] as $key => $value) {
				// if(!empty($value[0])) {
					$description = isset($value[0]) ? $value[0] : '';
					$balance = isset($value[1]) ? (int)$value[1] : 0;
					$remaining_balance = isset($value[2]) ? (int)$value[2] : 0;
					$amount = isset($value[3]) ? (int)$value[3] : 0;
					$total_unit = isset($value[4]) ? (int)$value[4] : 0;
					$type = isset($value[5]) ? $value[5] : 'Uang';

					$query2 .= "(
						(SELECT MAX(id) FROM transactions),
						'$description',
						$balance,
						$remaining_balance,
						$amount,
						$total_unit,
						'$type'
					)";		

					if ($key+1 !== count($_POST['detail'])) {
						$query2 .= ",";
					}
				// }
			}
		}

		if ($conn->query($query) === TRUE && $conn->query($query2) === TRUE) {
			echo "ok";
		}else {
			echo "Error: " . $conn->error;
		}
    }
?>