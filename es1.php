<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$contenutoInvertito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputFrase = $_POST["frase"];

    $fraseInvertita = strrev($inputFrase) . "\n";

    $filePath = "frase_invertita.txt";

    if (!file_exists($filePath)) {
        $file = fopen($filePath, "w");
        fclose($file);
    }

    file_put_contents($filePath, $fraseInvertita, FILE_APPEND);

    $contenutoInvertito = file_get_contents($filePath);

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inverti Stringa</title>
</head>

<body>
    <h2>Invertire una stringa</h2>
    <form method="post">
        <label for="frase">Inserisci una frase: <br></label>
        <input type="text" name="frase" required>
        <br>
        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($contenutoInvertito)): ?>
        <h4>Il contenuto invertito del file è:</h4>
        <p>
            <?php echo $contenutoInvertito; ?>
        </p>
    <?php endif; ?>

</body>

</html>