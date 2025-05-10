<?php
    include "includes/db.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
</head>
<body>
    <div class="header">
        <h1> Prices </h1>
        <button class="delete-button" id="deleteBtn">Delete </button>
            <!-- Error/Success Message-->
            <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
                <div class="success-message">Utente/i eliminati con successo.</div>
            <?php elseif (isset($_GET['error'])): ?>
                <div class="error-message">Error</div>
            <?php endif; ?>
    </div>
    <div class="container">
        <form id="deleteForm" action="delete_users.php" method="POST">
            <table id="usersTable">
                <thead>
                    <tr>
                        <!-- La colonna checkbox sarà aggiunta dinamicamente -->
                        <th>Codice Borsa</th>
                        <th>Descrizione</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    try {
                        $stmt = $conn->query("SELECT * FROM Borse");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                <tr data-user-id='{$row['ID']}'>
                                    <td>{$row['CodiceBorsa']}</td>
                                    <td>{$row['Descrizione']}</td>
                                    <td>" . number_format($row['Prezzo'], 2, ',', '.') . "€</td>
                                </tr>"
                            ;
                        }
                    } catch (PDOException $e) {
                        die("Errore nel recupero degli utenti: " . $e->getMessage());
                    }
                ?>
                </tbody>
            </table>
        </form>
        <!-- Pulsante per aggiungere una nuova nota -->
        <div class="btn">
            <button class="floating-button" onclick="location.href='pages/addBorsa.php'">+</button>
        </div>
    </div>


    <!-- Script Delete Btn (checkbox visual & double click to delete)-->
    <script src="js/DeleteBtn.js"></script>
</body>
</html>
