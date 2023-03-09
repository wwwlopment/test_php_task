<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Test task</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <link rel="stylesheet" href="views/assets/css/main.css"/>
</head>
<body>
<div class="form-body">
    <div class="row">
        <div class="form-holder">
            <div class="form-content">
                <div id="registeredSuccess" style="display: none">
                    <p>You have successfully registered</p>
                </div>
                <div class="form-items">
                    <h3>Register Please</h3>
                    <p>Fill in the data below.</p>
                    <form class="requires-validation" novalidate>

                        <div class="col-md-12">
                            <input class="form-control" type="text" name="name" placeholder="Name" required>
                            <div class="valid-feedback">Name field is valid!</div>
                            <div class="invalid-feedback">Name field cannot be blank!</div>
                        </div>

                        <div class="col-md-12">
                            <input class="form-control" type="text" name="name" placeholder="Surname" required>
                            <div class="valid-feedback">Surname field is valid!</div>
                            <div class="invalid-feedback">Surname field cannot be blank!</div>
                        </div>

                        <div class="col-md-12">
                            <input class="form-control" type="email" name="email" placeholder="E-mail" required>
                            <div class="valid-feedback">Email field is valid!</div>
                            <div class="invalid-feedback">Email field cannot be blank!</div>
                        </div>

                        <div class="col-md-12">
                            <input class="form-control" type="password" name="password" placeholder="Password"
                                   id="password" required>
                            <div class="valid-feedback">Password field is valid!</div>
                            <div id="password-error" class="invalid-feedback">Password field cannot be blank!</div>
                        </div>

                        <div class="col-md-12">
                            <input class="form-control" type="password" name="password_confirm"
                                   placeholder="Password confirm" id="confirmPassword" required>
                            <div class="valid-feedback">Password field is valid!</div>
                            <div id="confirmPassword-error" class="invalid-feedback">Password field cannot be blank!
                            </div>
                        </div>

                        <div class="form-button mt-3">
                            <button id="submit" type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="views/assets/js/main.js"></script>

</body>
</html>