<?php include 'templates/header.php'; ?>

<script>
    function validateForm() {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        if (username.trim() === '') {
            alert('Please enter your username.');
            return false;
        }

        if (password.trim() === '') {
            alert('Please enter your password.');
            return false;
        }

        // Check if the username contains special characters
        const usernameRegex = /^[a-zA-Z0-9]+$/;
        if (!usernameRegex.test(username)) {
            alert('Username should only contain letters and numbers.');
            return false;
        }

        // Check if the password meets the minimum length requirement
        if (password.length < 8) {
            alert('Password should be at least 8 characters long.');
            return false;
        }

        return true;
    }
</script>

<div class="form-v5-content">
    <form class="form-detail" action="#" method="post" onsubmit="return validateForm()">
        <h2>Login</h2>
        <?php if (!empty($data['error'])) : ?>
            <div class="error-message-box">
                <div class="error-message"><?php echo $data['error']; ?></div>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['success'])) : ?>
            <div class="success-message-box">
                <div class="success-message"><?php echo $data['success']; ?></div>
            </div>
        <?php endif; ?>
        <div class="form-row">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="input-text" placeholder="Your Username" required>
            <i class="fas fa-user"></i>
        </div>
        <div class="form-row">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input-text" placeholder="Your Password" required>
            <i class="fas fa-lock"></i>
        </div>
        <div class="form-row-last">
            <input type="submit" name="login" class="register" value="Login">
        </div>
    </form>
</div>

<?php include 'templates/footer.php'; ?>