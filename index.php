<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="features/admin/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card shadow-sm" style="max-width: 400px; margin: auto; margin-top: 50px;">
                <div class="card-body">

                    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                        <div class="div-message btn btn-success">Sign Up Successful!</div>
                    <?php endif; ?>

                    <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                        <div class="alert alert-danger">Incorrect credentials.</div>
                    <?php endif; ?>

                    <h3 class="card-title text-center mb-4">Login</h3>

                    <form method="POST" action="features/admin/function/php/login_process.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-info text-white">Login</button>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <p class="me-1">Don't have an Account?</p>
                            <a href="signup.php">Sign Up</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function () {
        const messageDiv = document.querySelector('.div-message');
        if (messageDiv) {
            setTimeout(() => {
                messageDiv.style.display = 'none';
            }, 3000);
        }
    });
</script>

</body>
</html>
