<?php
include 'dbsettings.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST["submit"])) {
   $sql =
      "INSERT INTO Toggles (naam, kategorie)
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
   "SELECT kategorie as arrkey, id, status, date_format(updated, '%H:%i') as updated, naam, kategorie FROM `Toggles`;"
);
$select->execute();
$toggles = $select->fetchAll(PDO::FETCH_GROUP | PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <meta name="description" content="" />
   <meta name="author" content="" />
   <title>Klankspan - Checklist</title>
   <!-- Favicon-->
   <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
   <!-- Bootstrap icons-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
   <!-- Core theme CSS (includes Bootstrap)-->
   <link href="btstrap/css/styles.css" rel="stylesheet" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
   <script src="btstrap/js/scripts.js"></script>

   <style>
   </style>
</head>

<body>
<?php include 'nav.php'; ?>
   <!-- Header-->
   <header class="py-5">
      <div class="container px-lg-5">
         <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
            <div class="m-4 m-lg-5">
               <h1 class="display-5 fw-bold">Voeg nuwe items by:</h1>
               <form method="POST" action="add.php">
                  <label for="naam">Item naam:</label>
                  <input type="text" name="name"><br><br>
                  <label for="category_text">Kategorie naam:</label>
                  <input type="text" name="category_text" id="category_text" style="display: none;">
                  <select name="category" id="category" onchange="GetSelectedTextValue(this)">
                     <option>Kies 'n afdeling</option>
                     <option value="Nuut">*Nuwe afdeling*</option>
                     <?php
                     foreach ($toggles as $category) {
                        ?>
                        <option value="<?php echo $category[0]['kategorie']; ?>">
                           <?php echo $category[0]['kategorie']; ?>
                        </option>
                        <?php
                     }
                     ?>
                  </select><br><br>
                  <input type="submit" name="submit" value="Voeg By">
               </form>
            </div>
         </div>
      </div>
   </header>
   <section class="pt-6">
      <form method="post" id="toggleForm">
         <div class="container">
            <!-- Page Features-->
            <div class="row gx-lg-5">
               <?php
               foreach ($toggles as $category) {
                  ?>
                  <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                     <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                           <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                 class="bi bi-collection"></i></div>
                           <h2 class="fs-3 fw-bold">
                              <?php echo $category[0]['kategorie']; ?>
                           </h2>
                           <fieldset>
                              <?php
                              foreach ($category as $toggle) {
                                 ?>
                                 <div class="custom-control custom-switch m-2">
                                    <a href="del.php"><?php echo $toggle['naam']; ?></a>
                                 </div>
                                 <?php
                              }
                              ?>
                        </div>
                     </div>
                  </div>
                  <?php
               }
               ?>
            </div>
         </div>
      </form>
   </section>
</body>
</html>