<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$caricaCartella = "Uploaded/";

if (!file_exists($caricaCartella)) {
    mkdir($caricaCartella, 0777, true);
}

$filesCaricati = [];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];

    if ($file["error"] === UPLOAD_ERR_OK) {
        $nomeProvvisorio = tempnam($caricaCartella, 'uploaded_');
        $nuovoNome = $nomeProvvisorio . ".pdf";

        $filesCaricati[] = $nuovoNome;
        move_uploaded_file($file["tmp_name"], $nuovoNome);
    }
}

if (isset($_POST["delete"])) {
    $nomeFileDaCancellare= $_POST["delete"];
    if (file_exists($nomeFileDaCancellare)) {
        unlink($nomeFileDaCancellare);
    }
}

$filesCaricati = glob($caricaCartella . "*.pdf");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Eliminazione dei File</title>
</head>

<h3>File Caricati:</h3>

<?php foreach ($filesCaricati as $fileCaricato): ?>
    <p>
        <?php echo basename($fileCaricato); ?>
    <form method="post">
        <input type="hidden" name="delete" value="<?php echo $fileCaricato; ?>">
        <button type="submit">Elimina</button>
    </form>
    </p>
<?php endforeach; ?>

</body>

</html>