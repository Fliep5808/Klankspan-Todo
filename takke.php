<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'dbsettings.php';
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (isset($_POST["add"])) {
    $sql =
        "INSERT INTO Takke (naam, oopsluit_tyd) VALUES ('" . $_POST["naam"] . "', '" . $_POST["tyd"] . "')";

    if ($db->query($sql) === true) {
        // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
if (isset($_POST["add_Diens"])) {
    $sql =
        "INSERT INTO Dienste (naam, tyd) VALUES ('" . $_POST["naam"] . "', '" . $_POST["tyd"] . "')";

    if ($db->query($sql) === true) {
        // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
if (isset($_POST["update"])) {
    $sql =
        "UPDATE Takke SET naam = '" . $_POST["naam"] . "' WHERE " . $_POST["takId"];

    if ($db->query($sql) === true) {
        // echo "New record update successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
if (isset($_POST["koppel"])) {
    $sql =
        "INSERT INTO TakDienstye (diensId, takId) VALUES ('" . $_POST["diensId"] . "', '" . $_POST["takId"] . "')";

    if ($db->query($sql) === true) {
        // echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $db->error;
    }
}
$select = $db->prepare(
    "SELECT * FROM `Takke`;"
);
$select->execute();
$takkes = $select->fetchAll(PDO::FETCH_ASSOC);

$select1 = $db->prepare(
    "SELECT * FROM `Dienste`;"
);
$select1->execute();
$dienste = $select1->fetchAll(PDO::FETCH_ASSOC);

$select2 = $db->prepare(
    "SELECT T.naam as 'TakNaam', D.naam as 'DiensNaam', D.tyd as 'DiensTyd'
    FROM Takke AS T
        , TakDienstye AS TD
        , Dienste AS D;"
);
$select2->execute();
$TakDienstye = $select2->fetchAll(PDO::FETCH_ASSOC);
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
                <h1 class="display-6 fw-bold">Bestuur Takke</h1>

            </div>
        </div>
    </header>
    <!-- Display-->
    <section class="pt-6">
        <div class="container">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Takke</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <ul>
                                        <?php
                                        foreach ($takkes as $category) {

                                            ?>
                                            <?php echo "<li>" . $category['naam'] . "</li>"; ?>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Tak Dienstye</h2>
                            <fieldset>

                                <div class="custom-control custom-switch m-2">
                                    <ul>
                                        <?php
                                        foreach ($TakDienstye as $diensTyd) {

                                            ?>
                                            <?php echo "<li>" . $diensTyd['TakNaam'] . " - " . $diensTyd['DiensNaam'] . "</li>"; ?>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Dienstye</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <ul>
                                        <?php
                                        foreach ($dienste as $diens) {

                                            ?>
                                            <?php echo "<li>" . $diens['naam'] . "</li>"; ?>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Add/Edit/Delete-->
    <section class="pt-6">
        <div class="container">
            <!-- Page Features-->
            <div class="row gx-lg-5">
                <!-- Voeg 'n Tak By-->
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Voeg 'n Tak By</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="takke.php">
                                        <label for="naam">Tak Naam:</label>
                                        <input type="text" name="naam"><br><br>
                                        <label for="tyd">Oopsluit Tyd:</label>
                                        <input type="text" name="tyd"><br><br>
                                        <input type="submit" name="add" value="Voeg By">
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>               
                 <!-- Voeg 'n Dienstyd By-->
                 <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Voeg 'n Diens By</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="takke.php">
                                        <label for="naam">Diens Naam:</label>
                                        <input type="text" name="naam"><br><br>
                                        <label for="tyd">Diens Tyd:</label>
                                        <input type="text" name="tyd"><br><br>
                                        <input type="submit" name="add_Diens" value="Voeg By">
                                    </form>
                                </div>
                        </div>
                    </div>
                </div> 
                <!-- Koppel'n Dienstyd aan 'n Tak-->
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Tak Dienstye</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="takke.php">
                                        <select name="takId" id="takId">
                                            <option>Kies 'n tak</option>
                                            <?php
                                            foreach ($takkes as $category) {

                                                ?>
                                                <option value="<?php echo $category['takId']; ?>">
                                                    <?php echo $category['naam']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select><br><br>
                                        <select name="diensId" id="diensId">
                                            <option>Kies 'n diens</option>
                                            <?php
                                            foreach ($dienste as $category) {

                                                ?>
                                                <option value="<?php echo $category['diensId']; ?>">
                                                    <?php echo $category['naam']; ?>
                                                </option>
                                                <?php
                                            }
                                            ?>
                                        </select><br><br>
                                        <input type="submit" name="koppel" value="Koppel">
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- Verander'n Tak Naam-->
                <div class="col-sm-6 col-lg-6 col-xl-4 mb-5">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center p-2 p-lg-5 pt-0 pt-lg-0">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-4 mt-n4"><i
                                    class="bi bi-collection"></i></div>
                            <h2 class="fs-3 fw-bold">Verander Tak Naam</h2>
                            <fieldset>
                                <div class="custom-control custom-switch m-2">
                                    <form method="POST" action="takke.php">
                                        <select name="takId" id="takId">
                                            <option>Kies 'n tak</option>
                                            <?php
                                            foreach ($takkes as $category) {

                                                ?>
                                                <option value="<?php echo $category['takId']; ?>">
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
            </div>
        </div>
    </section>

</body>

</html>