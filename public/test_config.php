<!DOCTYPE html>
<html>
<head>
    <title>Configuration PHP - Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .config-item { margin: 10px 0; padding: 10px; background: #f5f5f5; border-radius: 5px; }
        .value { font-weight: bold; color: #333; }
        .good { color: green; }
        .bad { color: red; }
    </style>
</head>
<body>
    <h1>Configuration PHP - Test Upload</h1>
    
    <div class="config-item">
        <strong>upload_max_filesize:</strong> 
        <span class="value <?php echo (ini_get('upload_max_filesize') >= '50M') ? 'good' : 'bad'; ?>">
            <?php echo ini_get('upload_max_filesize'); ?>
        </span>
    </div>
    
    <div class="config-item">
        <strong>post_max_size:</strong> 
        <span class="value <?php echo (ini_get('post_max_size') >= '50M') ? 'good' : 'bad'; ?>">
            <?php echo ini_get('post_max_size'); ?>
        </span>
    </div>
    
    <div class="config-item">
        <strong>max_execution_time:</strong> 
        <span class="value"><?php echo ini_get('max_execution_time'); ?></span>
    </div>
    
    <div class="config-item">
        <strong>memory_limit:</strong> 
        <span class="value"><?php echo ini_get('memory_limit'); ?></span>
    </div>
    
    <div class="config-item">
        <strong>max_input_time:</strong> 
        <span class="value"><?php echo ini_get('max_input_time'); ?></span>
    </div>
    
    <div class="config-item">
        <strong>file_uploads:</strong> 
        <span class="value <?php echo (ini_get('file_uploads')) ? 'good' : 'bad'; ?>">
            <?php echo (ini_get('file_uploads')) ? 'ON' : 'OFF'; ?>
        </span>
    </div>
    
    <hr>
    <h2>Test d'upload simple</h2>
    <form action="test_upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="test_file" accept="video/*">
        <input type="submit" value="Tester l'upload">
    </form>
</body>
</html> 