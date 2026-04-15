<?php
session_start();

// 1. Restriction: Only logged-in users can see this (Requirement: Authorization)
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: login.php");
    exit();
}

// 2. Connect to the database (Requirement: Database Connection)
require 'db.php';   
// 3. Fetch all images from the database (Requirement: Data Retrieval)
$stmt = $pdo->query("SELECT * FROM images");
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">   
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Image Gallery</title>
    </head>
    <body class="container py-5">
        <h1 class="mb-4">Image Gallery</h1>
        <div class="row">
            <?php foreach ($images as $image): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo htmlspecialchars($image['url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($image['title']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($image['title']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($image['description']); ?></p>     
                            `<!-- 4. Display images in a grid layout (Requirement: Display) -->
                            <a href="delete.php?id=<?php echo $image['id']; ?>" class=" 
btn btn-danger">Delete</a> 
                        </div>


                    </div>
                </div>  
            <?php endforeach; ?>
        </div>
    </body> 
</html>
