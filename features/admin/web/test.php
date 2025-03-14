<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Church Gallery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .gallery img {
            width: 100%;
            object-fit: cover;
            border-radius: 5px;
            height: 100%;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <h5>Church Gallery</h5>
    <div class="row gallery">
        <!-- Large image on the left -->
        <div class="col-md-6">
            <img src="image.png" class="img-fluid" alt="Large Gallery Image">
        </div>

        <!-- Right side (2 rows of 2 images) -->
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    <img src="image.png" class="img-fluid" alt="Small Gallery Image">
                </div>
                <div class="col-md-6">
                    <img src="image.png" class="img-fluid" alt="Small Gallery Image">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8">
                    <img src="image.png" class="img-fluid" alt="Small Gallery Image">
                </div>
                <div class="col-md-4">
                    <img src="image.png" class="img-fluid" alt="Small Gallery Image">
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
