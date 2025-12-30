<?php
require_once __DIR__ . '/../common_units/config.php';

if (hh_current_user()) {
    header('Location: /health-harmony/index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier'] ?? '');
    $password   = $_POST['password'] ?? '';

    if ($identifier === '' || $password === '') {
        $error = 'Please enter your username/email and password.';
    } else {
        $user = hh_find_user_by_username_or_email($identifier);
        if (!$user || !password_verify($password, $user['password_hash'])) {
            $error = 'Invalid credentials.';
        } else {
            $_SESSION['user_id'] = $user['id'];
            header('Location: /health-harmony/index.php');
            exit;
        }
    }
}

require_once __DIR__ . '/../common_units/navbar.php';
?>
<section class="hh-auth-layout">
    <div class="hh-column">
        <h1>Log back in</h1>
        <p class="hh-muted">Pick up where you left off on your Health &amp; Harmony timeline.</p>

        <?php if ($error): ?>
            <div class="hh-alert hh-alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="hh-form" style="max-width:360px;">
            <div class="hh-form-group">
                <label for="identifier">Username or email</label>
                <input type="text" id="identifier" name="identifier" required>
            </div>
            <div class="hh-form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="hh-form-actions">
                <button type="submit" class="hh-btn hh-btn-primary">Log in</button>
            </div>
        </form>

        <p class="hh-muted" style="margin-top:10px; font-size:13px;">
            New here? <a href="/health-harmony/auth/register.php" class="hh-link">Create an account</a>
        </p>
    </div>
</section>

</main>
</body>
</html>
