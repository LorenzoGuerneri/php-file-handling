<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputTesto = $_POST["testo"];
    $criptaTesto= hash('sha256', $inputTesto);

    $percorsoCartella = "Files";
    $percorsoFile = $percorsoCartella . "/" . $criptaTesto. ".txt";
    $copiaPercorsoFile = $percorsoCartella . "/" . $criptaTesto. "-copia.txt";

    if (!file_exists($percorsoCartella)) {
        mkdir($percorsoCartella, 0777, true);
    }

    if (!file_exists($percorsoFile)) {
        touch($percorsoFile);
    }

    copy($percorsoFile, $copiaPercorsoFile);

    unlink($percorsoFile);

    $file = fopen($copiaPercorsoFile, "w");
    fwrite($file, $criptaTesto);
    fclose($file);

    $contenutoCriptato= file_get_contents( $copiaPercorsoFile);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Cripta Testo</title>
</head>

<body>
    <h2>Criptare un testo</h2>
    <form method="post">
        <label for="testo">Testo da criptare:</label><br>
        <textarea name="testo" rows="4" cols="50" required></textarea><br>
        <button type="submit">Submit</button>
    </form>

    <?php if (isset($contenutoCriptato)): ?>
        <h4>Contenuto criptato:</h4>
        <p>
            <?php echo $contenutoCriptato; ?>
        </p>
    <?php endif; ?>

</body>

</html>