

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator | Jain Hotels & Dinings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Ubuntu", sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            width: 400px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .form-control {
            border-radius: 0.25em;
        }

        .form-check-input {
            width: 1.5em;
            height: 1.5em;
            border-radius: 0.25em;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    // Login handling
    $loginError = ''; // Initialize error message

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "booking_database";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
   
        
        // Retrieve form data
        $email = $_POST['exampleInputEmail1'];
        $password = $_POST['exampleInputPassword1'];
        $rememberMe = isset($_POST['exampleCheck1']);

        // Authentication (replace with your own logic)
        $stmt = $conn->prepare("SELECT * FROM adminuser WHERE email = ?");
        $stmt->bind_param("s", $email); // 's' specifies string parameter
        $stmt->execute();
        $result = $stmt->get_result(); // Get results for MySQLi 
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            // Successful login
            session_start();
            $_SESSION['user_id'] = $user['user_id'];

            // Remember Me functionality (adjust security as needed)
            if ($rememberMe) {
                setcookie('email', $email, time() + (86400 * 30), "/"); // 30 days
                setcookie('password', $password, time() + (86400 * 30), "/");
            }

            // Update last login time
            $stmt = $conn->prepare("UPDATE adminuser SET last_login = NOW() WHERE user_id = ?");
            $stmt->bind_param("i", $_SESSION['user_id']); // 'i' specifies integer parameter
            $stmt->execute();

            // Redirect to the dashboard or protected area
            header('Location: dashboard.php'); 
            exit();
        } else {
            $loginError = "Invalid email or password.";
        }

        $stmt->close(); // Close the statement
        $conn->close(); // Close the connection
    }
    ?>

    <div class="container-fluid vh-100 d-flex justify-content-center align-items-center bg-light">
        <div class="card rounded-3 border-0">
            <div class="card-body">
                <?php if ($loginError) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $loginError; ?></div>
                <?php } ?>

                <img src="/img/logo1.png" alt="logo_png" class="img-fluid mx-auto d-block" style="max-width: 100px;">

                <p class="text-center mb-1">Thank you for getting back, please login to your account by filling out this form:
                </p>

                <form class="p-4" method="post"> 
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="coolname@name.com" name="exampleInputEmail1" required> 
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="exampleInputPassword1" required> 
                    </div>

                    <div class="form-check d-flex align-items-center mb-3">
                        <input type="checkbox" class="form-check-input me-2" id="exampleCheck1" name="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                </form>

                <p class="text-center mt-4"><small>Designed by <a href="/" target="_blank"
                class="text-decoration-none">Jain Hotels & Dinings</a></small></p>
            </div>
        </div>
    </div>

    <script>
        const rememberMeCheckbox = document.getElementById('exampleCheck1');
        const loginForm = document.querySelector('form'); 

        loginForm.addEventListener('submit', () => {
            if (rememberMeCheckbox.checked) {
                localStorage.setItem('username', document.getElementById('exampleInputEmail1').value);
                localStorage.setItem('password', document.getElementById('exampleInputPassword1').value);
            } else {
                localStorage.removeItem('username');
                localStorage.removeItem('password');
            }
        });

        window.addEventListener('load', () => {
            const storedUsername = localStorage.getItem('username');
            const storedPassword = localStorage.getItem('password');

            if (storedUsername && storedPassword) {
                document.getElementById('exampleInputEmail1').value = storedUsername;
                document.getElementById('exampleInputPassword1').value = storedPassword;
                rememberMeCheckbox.checked = true;
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-鷓fecSFcmRY犭FNtjPzCPbtYkBz334ztuV8/D946T83iMlRykT5zY+MylQevIGoCvF="
    crossorigin="anonymous"></script>
</body>
</html> 
