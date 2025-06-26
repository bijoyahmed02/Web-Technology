<?php
session_start();
if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] === true)) {
    echo "<script>
    window.location.href='admin.php';
    </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="icon" href="C:\Users\Asus\Downloads\anlogo.jpg" type="image/x-icon">
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background: url('/Assignment/pexels-quang-nguyen-vinh-222549-14036250.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .flex-container {
            display: flex;
            align-items: center;
            justify-content: center;
            }
            .flex-container h1 {
            text-align: center;
            }
            .flex-container form {
           padding-left: 30px ;
            }
 
        .column {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    .error-message {
            color: rgb(3, 142, 22);
            font-size: 12px;
            margin-bottom: 2px;
            display: block;
        }
</style>
</head>
<body>
    <h1 style="color: rgb(252, 252, 252);">Hotel Grand Cox's</h1>
    <div class="flex-container">
        <div style="background-color:rgb(205, 164, 250); ; height: 650px; width: 450px;">
            <h1>Sign in</h1>
            <form id="receptionistForm" action="Rprocess.php" method="post">
 
                <b><label for="FullName" style="align-self: flex-start;">Full Name:</label></b><br>
                <input type="text" name="username" placeholder="FULL NAME" id="username" style="width: 60%; padding: 3px; margin-bottom: 9px;"><br>
                <span class="error-message" id="nameError" ></span>
 
                <b><label for="email" style="align-self: flex-start;">Email:</label></b><br>
                <input type="email" name="email" placeholder="User Email" id="email" style="width: 60%; padding: 3px; margin-bottom: 9px;"><br>
                <span class="error-message" id="emailError" ></span>
 
                <b><label for="password">Password:</label></b><br>
                <input type="password" name="pass" placeholder="Password" id="password" style="width: 60%; padding: 3px; margin-bottom: 9px;"><br>
                <span class="error-message" id="passwordError"></span>
 
                <b><label for="contact Number">Contact Number:</label></b><br>
                <input type="number" name="number" placeholder="Phone Number" id="number" style="width: 60%; padding: 3px; margin-bottom: 9px;"><br>
                <span class="error-message" id="numberError"></span>
 
                <b><label for="birthday">Date of Birth:</label></b><br>
                <input type="date" id="dob" name="dob" style="width: 50%; padding: 3px; margin-bottom: 9px;"><br>
                <span class="error-message" id="dobError"></span>
 
                <b><label for="Country">Country:</label></b><br>
                <select id="country" name="country" style="width: 50%; padding: 3px; margin-bottom: 9px;" >
                    <option value="Select Country">Select Country</option>
                    <option value="India">India</option>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="Australia">Australia</option>
                    <option value="Bangladesh">Bangladesh</option>
                    <option value="other">Other</option>
                </select><br>
                <span class="error-message" id="countryError"></span>
 
 
                <b><label for="gender">Gender:</label></b><br>
                <div style="display: flex; margin-bottom: 8px;">
                <input type="radio" name="gender" value="Male" id="genderMale">
                <label for="male">Male</label>
                <input type="radio" name="gender" value="Female" id="genderFemale">
                <label for="male">Female</label>
                </div>
                <span class="error-message" id="genderError"></span>

                <input type="submit" value="Submit" style=" border-radius: 6px; margin-top: 10px; font: bold; font-size: 14px; color: rgb(76, 1, 1);  margin-left: 125px; padding: 4px 50px;" formaction="Rprocess.php"><br>
            </form>
            <form action="control.php" method="get" style="margin:0;">
               <input type="submit" value="Cancel" style=" border-radius: 6px; margin-top: 10px; font: bold; font-size: 14px; color: rgb(3, 1, 76);  margin-left: 125px; padding: 4px 50px;"> 
            </form>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('receptionistForm');
    const submitButton = document.querySelector('input[value="Submit"]');
 
    submitButton.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent form submission
        let isValid = true;
        document.querySelectorAll('.error-message').forEach(span => { // Clear all error messages
            span.textContent = '';
        });
 
        const fullName = document.getElementById('username').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const pnumber = document.getElementById('number').value;
        const birthDateValue = document.getElementById('dob').value;
        const country = document.getElementById('country').value;
        const gender = document.querySelector('input[name="gender"]:checked');
 
        const namePattern = /^[a-zA-Z\s]+$/;
        if (!namePattern.test(fullName)) {
            document.getElementById("nameError").textContent = "Write a valid Name";
            isValid = false;
        }
 
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            document.getElementById("emailError").textContent = "Please enter a valid email address";
            isValid = false;
        }
 
        if (password.length < 8) {
            document.getElementById("passwordError").textContent = "Enter a password and password must be at least 8 characters long";
            isValid = false;
        }
 
        if (pnumber==="") {
            document.getElementById("numberError").textContent = "please provide your number";
            isValid = false;
        }
 
        const birthDate = new Date(birthDateValue);
        const currentDate = new Date();
        let age = currentDate.getFullYear() - birthDate.getFullYear();
        const m = currentDate.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && currentDate.getDate() < birthDate.getDate())) {
            age--;
        }
        if (!birthDateValue || isNaN(birthDate) || age < 18) {
            document.getElementById("dobError").textContent = "You must be at least 18 years old";
            isValid = false;
        }
 
        if (country === "Select Country") {
            document.getElementById("countryError").textContent = "Please select your Country";
            isValid = false;
        }
 
        if (!gender) {
            document.getElementById("genderError").textContent = "Please select your Gender";
            isValid = false;
        }
 
        if (isValid) {
            alert('Registration Successful!');
            form.submit();
        }
    });
 
    const addInputListeners = () => {
        document.getElementById('username').addEventListener('input', () => {
            const namePattern = /^[a-zA-Z\s]+$/;
            if (namePattern.test(document.getElementById('username').value.trim())) {
                document.getElementById("nameError").textContent = "";
            }
        });
 
        document.getElementById('email').addEventListener('input', () => {
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailPattern.test(document.getElementById('email').value.trim())) {
                document.getElementById("emailError").textContent = "";
            }
        });
 
        document.getElementById('password').addEventListener('input', () => {
            if (document.getElementById('password').value.length >= 8) {
                document.getElementById("passwordError").textContent = "";
            }
        });

        document.getElementById('number').addEventListener('input', () => {
        if (document.getElementById('number').value !== "") {
        document.getElementById("numberError").textContent = "";
        }
        });
 
        document.getElementById('dob').addEventListener('change', () => {
            const birthDate = new Date(document.getElementById('dob').value);
            const currentDate = new Date();
            let age = currentDate.getFullYear() - birthDate.getFullYear();
            const m = currentDate.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && currentDate.getDate() < birthDate.getDate())) {
                age--;
            }
            if (age >= 18) {
                document.getElementById("dobError").textContent = "";
            }
        });
 
        document.getElementById('country').addEventListener('change', () => {
            if (document.getElementById('country').value !== "Select Country") {
                document.getElementById("countryError").textContent = "";
            }
        });
 
        document.getElementById('genderMale').addEventListener('change', () => {
            document.getElementById("genderError").textContent = "";
        });
 
        document.getElementById('genderFemale').addEventListener('change', () => {
            document.getElementById("genderError").textContent = "";
        });
    };
 
    addInputListeners();
});
</script>
</body>
</html>
