<?php
try {
    // get the q parameter from URL
    $s = $_REQUEST["s"];
    $rows = "";
    $db = new mysqli("localhost", "root", "", "classicmodels");
    if ($db) {

        $sql = "SELECT c.customerNumber, c.contactLastName, c.contactFirstName, c.phone, c.addressLine1 FROM customers c WHERE 1=1";
        if ($s) {
            $sql .= " AND (c.contactFirstName LIKE '%" . $s . "%' OR c.contactLastName LIKE '%" . $s . "%')";
        }
		
        $result = $db->query($sql) or die("Doslo je do problema prilikom izvrsavanja upita...");
        $n = mysqli_num_rows($result);
        if ($n > 0) {
            while ($myrow = mysqli_fetch_row($result)) {
                $rows .= "<div id=\"" . $myrow[0] . "\">" . $myrow[1] . " " . $myrow[2] . ", " . $myrow[3] . ", " . $myrow[4] . " <a href='http://localhost/zadatak3/payments1.html?s=" . $myrow[0] . "'>Payments</a></div>";

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