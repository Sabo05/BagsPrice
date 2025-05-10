<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Link CSS -->
    <link rel="stylesheet" href="../css/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign-Up </title>
</head>
<body>

    <div class="container">
        <form action="addPrice.php" method="post">
            <label for=""> Codice Borsa </label>
            <input type="text" placeholder="CodiceBorsa..." name="cb" required>
            
            <label for=""> Descrizione </label>
            <input type="text" placeholder="Descrizione..." name="descrizione" required>
            
            <label for=""> Prezzo </label>
            <input type="number"  step="0.1" placeholder="Price..." name="price" required>

            <button type="submit"> Submit </button>
        </form>
    </div>

</body>
</html>