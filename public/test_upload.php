<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h1>Test d'upload</h1>";
    
    if (isset($_FILES['test_file']) && $_FILES['test_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['test_file'];
        
        echo "<div style='background: #d4edda; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
        echo "<h3>✅ Upload réussi !</h3>";
        echo "<p><strong>Nom du fichier:</strong> " . $file['name'] . "</p>";
        echo "<p><strong>Taille:</strong> " . number_format($file['size'] / 1024 / 1024, 2) . " MB</p>";
        echo "<p><strong>Type:</strong> " . $file['type'] . "</p>";
        echo "</div>";
        
        // Supprimer le fichier temporaire
        unlink($file['tmp_name']);
        
    } elseif (isset($_FILES['test_file'])) {
        echo "<div style='background: #f8d7da; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
        echo "<h3>❌ Erreur d'upload</h3>";
        
        switch ($_FILES['test_file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                echo "<p>Le fichier dépasse la limite upload_max_filesize</p>";
                break;
            case UPLOAD_ERR_FORM_SIZE:
                echo "<p>Le fichier dépasse la limite post_max_size</p>";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "<p>Le fichier n'a été que partiellement uploadé</p>";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "<p>Aucun fichier n'a été uploadé</p>";
                break;
            default:
                echo "<p>Erreur inconnue: " . $_FILES['test_file']['error'] . "</p>";
        }
        echo "</div>";
    }
    
    echo "<p><a href='test_config.php'>← Retour au test de configuration</a></p>";
} else {
    header('Location: test_config.php');
}
?> 