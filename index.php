<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <form action="action/upload_handler.php" method="POST" enctype="multipart/form-data" id="upload-form">
        
        <h3>Upload File</h3>
        <input type="file" name="file" id="file" accept=".jpg, .png, .pdf, .docx">
        <input type="submit" value="Upload">
        <div id="upload-message"></div>

        <a href="action/logout.php">Logout</a>
    </form>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="assets/scripts.js"></script>

</body>

</html> 