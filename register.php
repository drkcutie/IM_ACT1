<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>
<body class="bg-gray-100">

<div class="flex justify-center items-center h-screen">
    <div class="container mx-auto max-w-md bg-white p-8 rounded shadow-md">
        <h1 class="text-2xl font-semibold mb-6 text-center">Register</h1>
        <form method="post" autocomplete="false">
            <div class="mb-4">
                <label for="registerFirstName" class="block">First Name:</label>
                <input type="text" id="registerFirstName" name="registerFirstName" class="w-full px-4 py-2 border rounded-md" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="registerLastName" class="block">Last Name:</label>
                <input type="text" id="registerLastName" name="registerLastName" class="w-full px-4 py-2 border rounded-md" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="registerGender" class="block">Gender:</label>
                <select id="registerGender" name="registerGender" class="w-full px-4 py-2 border rounded-md" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="registerUsername" class="block">Username:</label>
                <input type="text" id="registerUsername" name="registerUsername" class="w-full px-4 py-2 border rounded-md" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="registerPassword" class="block">Password:</label>
                <input type="password" id="registerPassword" name="registerPassword" class="w-full px-4 py-2 border rounded-md" autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="registerEmail" class="block">Email:</label>
                <input type="email" id="registerEmail" name="registerEmail" class="w-full px-4 py-2 border rounded-md"  autocomplete="off" required>
            </div>
            <div class="mb-4">
                <label for="registerBirthdate" class="block">Birthdate:</label>
                <input type="date" id="registerBirthdate" name="registerBirthdate" class="w-full px-4 py-2 border rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600" id="registerButton" name="registerButton">Register</button>
        </form>
        <p class="mt-4 text-center">Have an account? <a href="index.php" class="text-blue-500">Login here</a>.</p>
    </div>
</div>

<!-- Message Box -->
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
    function showSuccessMessage(message) {
        var messageBox = document.getElementById('messageBox');
        var messageText = document.getElementById('messageText');
        messageText.innerText = message;
        messageBox.classList.remove('hidden');
        messageBox.classList.remove('bg-red-500');
        messageBox.classList.add('bg-green-500');
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
include "connect.php";
global $connection;
if (isset($_POST['registerButton'])) {
    $firstname = $_POST['registerFirstName'];
    $lastname = $_POST['registerLastName'];
    $gender = $_POST['registerGender'];
    $username = $_POST['registerUsername'];
    $password = $_POST['registerPassword'];
    $email = $_POST['registerEmail'];
    $birthdate = $_POST['registerBirthdate'];
    $sqlUsername = "SELECT * FROM tbluseraccount WHERE username = '$username'";
    $resultUsername = mysqli_query($connection, $sqlUsername);
    $sqlEmail = "SELECT * FROM tbluseraccount WHERE emailadd = '$email'";
    $resultEmail = mysqli_query($connection, $sqlEmail);
    $usertype = "User";
    if (mysqli_num_rows($resultUsername) > 0) {

        echo "<script>showMessage('Username already exists. Please choose another one.');</script>";
    } else if (mysqli_num_rows($resultEmail) > 0) {
        echo "<script>showMessage('Email already exists. Please choose another one.');</script>";
    } else {

        $sql1 = "Insert into tbluseraccount (emailadd,username,password, usertype) values('" . $email . "','" . $username . "','" . $password . "', 'USER')";
        mysqli_query($connection, $sql1);
        $sql2 = "Insert into tbluserprofile (firstname,lastname,gender,birthdate) values('" . $firstname . "','" . $lastname . "','" . $gender . "', '" . $birthdate . "')";
        mysqli_query($connection, $sql2);
        echo "<script>showSuccessMessage('Registration Successful!');</script>";

    }
}


?>