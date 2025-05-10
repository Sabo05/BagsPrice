<?php
    include "../includes/db.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete_ids'])) {
        $ids = $_POST['delete_ids'];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        try {
            $stmt = $conn->prepare("DELETE FROM borse WHERE ID IN ($placeholders)");
            $stmt->execute($ids);
            header("Location: borse.php?deleted=1"); // Cambia "borse.php" con il nome corretto della pagina se diverso
            exit;
        } catch (PDOException $e) {
            die("Errore durante l'eliminazione delle borse: " . $e->getMessage());
        }
    } else {
        header("Location: ../index.php");
        exit;
    }
?>
