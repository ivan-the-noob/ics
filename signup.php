<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="features/admin/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
        <div class="card shadow-sm" style="max-width: 400px; margin: auto; margin-top: 50px;">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Sign Up</h3>
                <form method="POST" action="features/admin/function/php/signup_process.php">
                    <div class="mb-3">
                        <label for="school" class="form-label">School:</label>
                        <input type="text" id="school" name="school_name" class="form-control" placeholder="Enter school name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="submit" class="btn btn-info text-white">Sign Up</button>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <p>Already have an Account?</p>
                        <a href="index.php" class="text-center ms-1">
                            <p class="mb-0">Login</p>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
</html>