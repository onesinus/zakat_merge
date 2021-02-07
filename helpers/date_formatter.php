<?php
    function formatDate($date, $format) {
        $date = date_create($date);        
        return date_format($date,$format);
    }
?>