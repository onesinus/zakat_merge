<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		$id = isset($_POST['id']) ? $_POST['id'] : 0;
		$name = isset($_POST['data'][0]) ? $_POST['data'][0] : 0;
		$phone_number = isset($_POST['data'][1]) ? $_POST['data'][1] : '';
		$type = isset($_POST['data'][2]) ? $_POST['data'][2] : '';
		$receive_type = isset($_POST['data'][3]) ? $_POST['data'][3] : '';
		$receive_date = isset($_POST['data'][4]) ? $_POST['data'][4] : '';
		$master_id = isset($_POST['data'][5]) ? $_POST['data'][5] : 0;
		$description = isset($_POST['data'][6]) ? $_POST['data'][6] : '';
		$qty = isset($_POST['data'][7]) ? $_POST['data'][7] : 0;
		$total = isset($_POST['data'][8]) ? $_POST['data'][8] : 0;
		$grand_total = isset($_POST['data'][9]) ? $_POST['data'][9] : 0;
		$is_validated = isset($_POST['data'][10]) ? $_POST['data'][10] : "No";

		$status = $receive_type === "Cash/Jemput" ?  "Pickup" : "Open";
		if ($is_validated == "Yes") {
			$status = "Closed";
		}
		
		$user = isset($_SESSION['user_logged_in']) ? $_SESSION['user_logged_in'] : null;
		$user_id = isset($user["id"]) ? $user["id"] : 0;
		
		if ($id) {
			$_SESSION['message'] = 'Muzakki has been validated';

			$query = "UPDATE muzakki SET
					name = '$name', 
					phone_number = '$phone_number', 
					type = '$type',
					receive_type = '$receive_type',
					receive_date = '$receive_date',
					master_id = $master_id,
					description = '$description',
					qty = $qty,
					total = $total,
					grand_total = $grand_total,
					status = '$status',
					updated_by = '$user_id',
					updated_date = NOW(),
					is_validated = 'Yes'
				WHERE
					id = '$id'
			";
		}else {
			$_SESSION['message'] = 'Muzakki has been added';
			
			$query = "INSERT INTO muzakki (
				name, 
				phone_number, 
				type,
				receive_type,
				receive_date,
				master_id,
				description,
				qty,
				total,
				grand_total,
				status,
				created_by
			) VALUES(
				'$name', 
				'$phone_number', 
				'$type', 
				'$receive_type', 
				'$receive_date', 
				$master_id,
				'$description',
				$qty,
				$total,
				$grand_total,
				'$status', 
				'$user_id'
			);";
		}

		if ($conn->query($query) === TRUE) {
			echo $user_id != 0 ? "ok" : "ok_without_user";
		}else {
			echo "Error: " . $conn->error;
		}
    }
?>