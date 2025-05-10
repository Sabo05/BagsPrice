<?php
    include "../includes/db.php";
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['delete_ids'])) {
        $ids = $_POST['delete_ids'];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        try {
            $stmt = $conn->prepare("DELETE FROM borse WHERE ID IN ($placeholders)");
            $stmt->execute($ids);
            $_SESSION['success_message'] = "Borsa/e eliminati con successo.";
            header("Location: ../index.php");
            exit;
        } catch (PDOException $e) {
            // Salva l'errore in sessione
            $_SESSION['error_message'] = "Errore durante l'eliminazione delle borse.";
            header("Location: ../index.php");
            exit;
        }
    } else {
        // In caso non ci siano ID da eliminare, puoi decidere di mostrare comunque un errore
        $_SESSION['error_message'] = "Nessun elemento selezionato per l'eliminazione.";
        header("Location: ../index.php");
        exit;
    }
?>
