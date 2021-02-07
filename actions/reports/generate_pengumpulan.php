<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
        $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
        $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';

        $query = "
            SELECT * FROM muzakki
            WHERE status = 'Closed'
        ";

        if($from_date && $to_date) {
            $query .= "AND created_date >= '$from_date 00:00:00' AND created_date <= '$to_date 23:59:59'";
        }

        if($type != 'All') {
            $query .= " AND type = '$type'";
        }

        if ($data = $conn->query($query)) {
            $arr_datas = array();
            while ($row = $data->fetch_assoc()) {
                array_push($arr_datas, $row);
            }
			echo json_encode($arr_datas);
		}else {
			echo json_encode([]);
		}
    }

    $conn->close();
?>