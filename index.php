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
    <!-- Barra di ricerca -->
    <div class="navbar">
        <form method="GET" action="">
            <input type="text" name="search" class="search-bar" placeholder="Cerca..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </form>
    </div>

    <div class="header">
        <h1> Prices </h1>
        <button class="delete-button" id="deleteBtn">Delete </button>

        <!-- Messaggi -->
        <?php if (!empty($_SESSION['success_message'])): ?>
            <div class="message success-message">
                <?= htmlspecialchars($_SESSION['success_message']) ?>
                <span class="close-message" onclick="this.parentElement.remove()">×</span>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php elseif (!empty($_SESSION['error_message'])): ?>
            <div class="message error-message">
                <?= htmlspecialchars($_SESSION['error_message']) ?>
                <span class="close-message" onclick="this.parentElement.remove()">×</span>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
    </div>

    <div class="container">
        <form id="deleteForm" action="pages/delete_users.php" method="POST">
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>Codice Borsa</th>
                        <th>Descrizione</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    try {
                        $search = $_GET['search'] ?? '';

                        if (!empty($search)) {
                            $stmt = $conn->prepare("
                                SELECT * FROM Borse 
                                WHERE LOWER(CodiceBorsa) LIKE LOWER(:search1)
                                    OR LOWER(Descrizione) LIKE LOWER(:search2)
                            ");
                            $searchParam = '%' . $search . '%';
                            $stmt->execute(['search1' => $searchParam, 'search2' => $searchParam]);
                        } else {
                            $stmt = $conn->query("SELECT * FROM Borse");
                        }

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "
                                <tr data-user-id='{$row['ID']}'>
                                    <td>{$row['CodiceBorsa']}</td>
                                    <td>{$row['Descrizione']}</td>
                                    <td>" . number_format($row['Prezzo'], 2, ',', '.') . "€</td>
                                </tr>";
                        }
                    } catch (PDOException $e) {
                        echo "<tr><td colspan='3'>Errore: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
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

    <!-- Script per il tasto elimina -->
    <script src="js/DeleteBtn.js"></script>
</body>
</html>
