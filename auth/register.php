<?php
require_once __DIR__ . '/../common_units/config.php';

if (hh_current_user()) {
    header('Location: /health-harmony/index.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name      = trim($_POST['name'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';

    if ($name === '' || $username === '' || $email === '' || $password === '' || $confirm === '') {
        $errors[] = 'Please fill in all fields.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }
    if (hh_username_exists($username)) {
        $errors[] = 'Username is already taken.';
    }
    if (hh_email_exists($email)) {
        $errors[] = 'Email is already in use.';
    }

    if (empty($errors)) {
        $data = hh_load_users();
        $user = [
            'id'             => bin2hex(random_bytes(8)),
            'name'           => $name,
            'username'       => $username,
            'email'          => $email,
            'password_hash'  => password_hash($password, PASSWORD_DEFAULT),
            'avatar'         => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0EA5E9&color=ffffff',
            'bio'            => '',
            'anonymous_mode' => false,
            'created_at'     => date('Y-m-d H:i'),
        ];
        $data['users'][] = $user;
        hh_save_users($data);

        $_SESSION['user_id'] = $user['id'];
        header('Location: /health-harmony/index.php');
        exit;
    }
}

require_once __DIR__ . '/../common_units/navbar.php';
?>
<section class="hh-auth-layout">
    <div class="hh-column">
        <h1>Create your space</h1>
        <p class="hh-muted">You can always post anonymously later. For now, just pick a name and username.</p>

        <?php if (!empty($errors)): ?>
            <div class="hh-alert hh-alert-danger">
                <ul>
                    <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post" class="hh-form" style="max-width:420px;">
            <div class="hh-form-grid">
                <div class="hh-form-group">
                    <label for="name">Display name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="hh-form-group">
                    <label for="username">Username</label>
                    <div class="hh-input-with-prefix">
                        <span>@</span>
                        <input type="text" id="username" name="username" required>
                    </div>
                </div>
            </div>
            <div class="hh-form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="hh-form-grid">
                <div class="hh-form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="hh-form-group">
                    <label for="confirm_password">Confirm password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>
            <div class="hh-form-actions">
                <button type="submit" class="hh-btn hh-btn-primary">Sign up</button>
            </div>
        </form>

        <p class="hh-muted" style="margin-top:10px; font-size:13px;">
            Already here? <a href="/health-harmony/auth/login.php" class="hh-link">Log in</a>
        </p>
    </div>
</section>

</main>
</body>
</html>
