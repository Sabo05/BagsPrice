<?php
    include "../includes/db.php";
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            // Recupero e sanitizzazione dei dati
            $codice_borsa = trim($_POST['cb']);
            $descrizione = trim($_POST['descrizione']);
            $prezzo = floatval($_POST['price']);

            // Verifica se il CodiceBorsa esiste già
            $stmt = $conn->prepare("SELECT COUNT(*) FROM Borse WHERE CodiceBorsa = :codice_borsa");
            $stmt->bindParam(':codice_borsa', $codice_borsa);
            $stmt->execute();

            if ($stmt->fetchColumn() > 0) {
                $_SESSION['message'] = "Codice Borsa già esistente!";
                header("Location: ../index.php");
                exit();
            }

            // Inserimento nel database
            $stmt = $conn->prepare("INSERT INTO Borse (CodiceBorsa, Descrizione, Prezzo)
                                    VALUES (:codice_borsa, :descrizione, :prezzo)");

            $stmt->bindParam(':codice_borsa', $codice_borsa);
            $stmt->bindParam(':descrizione', $descrizione);
            $stmt->bindParam(':prezzo', $prezzo);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $_SESSION['message'] = "Borsa inserita con successo!";
            } else {
                $_SESSION['message'] = "Errore durante l'inserimento.";
            }

        } catch (PDOException $e) {
            $_SESSION['message'] = "Errore: " . $e->getMessage();
        }
    }

    header("Location: ../index.php");
    exit();
?>
