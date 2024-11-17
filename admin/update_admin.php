<?php
// Start output buffering
ob_start(); 

include('partails/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" required>
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </td>    
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

// Check whether the admin button is clicked or not
if (isset($_POST['submit'])) {
    // 1. Get the data from the form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']); // Fixed to match form field name

    // 2. Check whether the user with current ID and current Password exists or not
    $sql = "SELECT * FROM users WHERE id=$id AND password='$current_password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        // Check whether data is available or not
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exists and password can be changed
            // Check whether the new password matches the confirm password
            if ($new_password == $confirm_password) {
                // Update password
                $sql = "UPDATE users SET password='$new_password' WHERE id=$id";

                // Execute the query
                $res = mysqli_query($conn, $sql); // Changed to use the correct variable

                // Check whether the query executed or not
                if ($res == true) {
                    // Display success message
                    $_SESSION['change-pwd'] = "<div class='success'>Changed successfully.</div>";
                    // Redirect the user
                    header('location: admin_users.php');
                    exit(); // Always exit after header redirect
                } else {
                    // Display error message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to change password.</div>";
                    // Redirect the user
                    header('location: admin_users.php');
                    exit(); // Always exit after header redirect
                }
            } else {
                // Redirect to manage Admin page with error message
                $_SESSION['pwd-not-Match'] = "<div class='error'>Passwords did not match.</div>";
                header('location: admin_users.php');
                exit(); // Always exit after header redirect
            }
        } else {
            // User does not exist, set message and redirect
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
            // Redirect the user
            header('location: admin_users.php');
            exit(); // Always exit after header redirect
        }
    }
}

// Include footer
include('partails/footer.php'); 

// Flush output buffer
ob_end_flush();
?>
