<?php
include 'dbsettings.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST["add"])) {
    $sql =
        "INSERT INTO Dienste (naam, tyd)
   VALUES ('" .
        $_POST["naam"] .
        "', '" .
        $_POST["tyd"] .
        "')";

    if ($db->query($sql) === true) {
        // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
if (isset($_POST["update"])) {
    $sql =
        "UPDATE Dienste SET naam = '" . $_POST["naam"] . "' WHERE " . $_POST["diensId"];

    if ($db->query($sql) === true) {
        // echo "New record update successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
$select = $db->prepare(
    "SELECT * FROM `Dienste`;"
);
$select->execute();
$toggles = $select->fetchAll(PDO::FETCH_ASSOC);
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
                <h1 class="display-6 fw-bold">Bestuur Dienste</h1>

            </div>
        </div>
    </header>
    <section class="pt-6">
        <div class="container">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Voeg 'n diens By</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="dienste.php">
                                        <label for="naam">Diens Naam:</label>
                                        <input type="text" name="naam"><br><br>
                                        <label for="tyd">Diens Tyd:</label>
                                        <input type="text" name="tyd"><br><br>

                                        <input type="submit" name="add" value="Voeg By">
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Verander Diens Naam</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="dienste.php">
                                        <select name="diensId" id="diensId">
                                            <option>Kies 'n diens</option>
                                            <?php
                                            foreach ($toggles as $category) {

                                                ?>
                                                <option value="<?php echo $category['diensId']; ?>">
                                                    <?php echo $category['naam']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select><br><br>
                                        <label for="naam">Nuwe Naam:</label>
                                        <input type="text" name="naam"><br><br>
                                        <input type="submit" name="update" value="Voeg By">
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Verwyder Diens</br></br>Volg Binnerkort</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <!--<form method="POST" action="dienste.php">
                                        <label for="naam">Diens Naam:</label>
                                        <input type="text" name="naam"><br><br>
                                        <label for="tyd">Diens Tyd:</label>
                                        <input type="text" name="tyd"><br><br>

                                        <input type="submit" name="update" value="Voeg By">
                                    </form>-->
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
<label for="category_text">Kategorie naam:</label>
                  <input type="text" name="category_text" id="category_text" style="display: none;">
                  <select name="category" id="category" onchange="GetSelectedTextValue(this)">
                     <option>Kies 'n afdeling</option>
                     <option value="Nuut">*Nuwe afdeling*</option>
                     ?php
                     foreach ($toggles as $category) {
                        ?>
                        <option value="?php echo $category[0]['category']; ?>">
                           ?php echo $category[0]['category']; ?>
                        </option>
                        ?php
                     }
                     ?>
                  </select><br><br>
-->
</body>

</html>