<?php
try {
    // get the q parameter from URL
    $s = $_REQUEST["s"];
    $rows = "";
    $db = new mysqli("localhost", "root", "", "classicmodels");
    if ($db) {
        $sql = "SELECT t.checkNumber, t.amount, DATE_FORMAT(t.paymentDate, '%d.%m.%Y') FROM payments t WHERE t.customerNumber = $s";
        // if ($s) {
        //     $sql .= " AND date(t.TXN_DATE) = date('" . $s . "')";
        // }
		
        $result = $db->query($sql) or die("Doslo je do problema prilikom izvrsavanja upita...");
        $n = mysqli_num_rows($result);
        if ($n > 0) {
            while ($myrow = mysqli_fetch_row($result)) {
                $rows .= "<div id=\"" . $myrow[0] . "\">" . $myrow[2] . " - $" . $myrow[1] . "</div>";

            }
        } else {
            echo "<b>Nema podataka<b>";
        }
    } else {
        echo "<b>Nije proslo spajanje<b>";
    }
    echo $rows;
} catch (Exception $e) {
    echo print_r($e, TRUE);
}
?>