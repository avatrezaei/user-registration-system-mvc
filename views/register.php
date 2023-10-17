<?php include 'templates/header.php'; ?>

<div class="form-v5-content">
    <form class="form-detail" action="#" method="post">
        <h2>Register</h2>
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
            <input type="text" name="username" id="username" class="input-text" placeholder="username" required>
            <i class="fas fa-user"></i>
        </div>
        <div class="form-row">
            <label for="your-email">Email</label>
            <input type="email" name="email" id="email" class="input-text" placeholder="email" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="form-row">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="input-text" placeholder="password" required>
            <i class="fas fa-lock"></i>
        </div>
        <div class="form-row-last">
            <input type="submit" name="register" class="register" value="Register">
        </div>
    </form>
</div>

<?php include 'templates/footer.php'; ?>