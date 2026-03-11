<?php
// ডাটাবেজ কানেকশন
$host = "localhost";
$user = "root";
$pass = "";
$db   = "your_database_name";

$conn = new mysqli($host, $user, $pass, $db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // পাসওয়ার্ডটি হ্যাশ করা (নিরাপত্তার জন্য)
    $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

    // ডাটাবেজে পাসওয়ার্ড আপডেট করার কুয়েরি
    $sql = "UPDATE users SET password='$hashed_password' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "পাসওয়ার্ড সফলভাবে সেভ হয়েছে!";
    } else {
        echo "ভুল হয়েছে: " . $conn->error;
    }
}

$conn->close();
?>
