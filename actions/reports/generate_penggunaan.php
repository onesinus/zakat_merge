<?php
	require "../../configurations/connect.php";

	if (isset($_POST)) {
        $from_date = isset($_POST['from_date']) ? $_POST['from_date'] : '';
        $to_date = isset($_POST['to_date']) ? $_POST['to_date'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        $query = "
        SELECT 
        t.id, 
        t.type,
        td.type as type_detail,
        td.note, 
        td.amount,
        td.total_unit, 
        t.status, 
        t.created_date 
    FROM transactions t
    INNER JOIN transaction_details td
    ON t.id = td.transaction_id
    WHERE 
        td.note != ''
        AND
        td.type = 'Uang'
";

        if($from_date && $to_date) {
            $query .= "AND t.created_date >= '$from_date 00:00:00' AND t.created_date <= '$to_date 23:59:59'";
        }

        if($status != 'All') {
            $query .= " AND t.status = '$status'";
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