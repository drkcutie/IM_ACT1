<?php
include_once "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <!-- Include Tailwind CSS -->

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen ">
    <div class="container mx-auto max-w-md bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Login</h1>
        <form method="post"  >
            <div class="mb-4">
                <label for="loginUsername" class="block">Username:</label>
                <input type="text" id="loginUsername" name="loginUsername" class="w-full px-4 py-2 border rounded-md" req>

            </div>
            <div class="mb-4">
                <label for="loginPassword" class="block">Password:</label>
                <input type="password" id="loginPassword" name="loginPassword" class="w-full px-4 py-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600" name = "loginButton">Login</button>
        </form>
        <p class="mt-4 text-center">Don't have an account? <a href="register.php" class="text-blue-500">Register here</a>.</p>
    </div>
</div>
<div id="messageBox" class="fixed bottom-5 right-5 bg-red-500 text-white px-4 py-2 rounded-md hidden">
    <span id="messageText"></span>
    <button id="closeButton" class="ml-2 focus:outline-none animate-pulse">Close</button>
</div>

<script>
    // Function to show the message box with the given message
    function showMessage(message) {
        var messageBox = document.getElementById('messageBox');
        var messageText = document.getElementById('messageText');
        messageText.innerText = message;
        messageBox.classList.remove('hidden');
        setTimeout(function () {
            messageBox.classList.add('hidden');
        }, 5000); // Auto-hide after 5 seconds
    }


    // Function to close the message box
    document.getElementById('closeButton').addEventListener('click', function () {
        var messageBox = document.getElementById('messageBox');
        messageBox.classList.add('hidden');
    });
</script>
</body>
</html>
<?php
global $connection;
if (isset($_POST['loginButton'])) {
    $username = ($_POST['loginUsername']);
    $password = ($_POST['loginPassword']);

    $sql2 = "SELECT * FROM tbluseraccount WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($connection, $sql2);
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION['user'] = $user;
        echo "<script> window.location.href = 'dashboard.php';</script>";
    } else {
        echo "<script>showMessage('Incorrect username or password. Try again.');</script>";

    }
}
?>