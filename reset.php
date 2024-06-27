<?php
/*
UPDATE Customers
SET PostalCode = 00000
WHERE Country = 'Mexico';
*/



$db = new PDO(
   "mysql:host=127.0.0.1;dbname=ewigeli2_BIBLETEST;charset=utf8mb4",
   "ewigeli2_ks",
   "Xl0dE(;l3A8;"
);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_GET["reset"])) {

   if($_GET["reset"] == 1){
      //echo"1";
      //die();
      $sql =
      "UPDATE Toggles SET status = '0'";
      $db->exec( $sql );
      header("redirect: index.php");
   }
}
/*   $sql =
      "INSERT INTO Toggles (name, category)
   VALUES ('" .
      $_POST["name"] .
      "', '" .
      $_POST["category_text"] .
      "')";

   if ($db->query($sql) === true) {
      // echo "New record created successfully";
   } else {
      //echo "Error: " . $sql . "<br>" . $db->error;
   }
}
$select = $db->prepare(
   "SELECT category as arrkey, id, status, date_format(updated, '%H:%i') as updated, name, category FROM `Toggles`;"
);
$select->execute();*/

?>
