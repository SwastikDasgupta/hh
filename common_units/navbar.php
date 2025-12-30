<?php
require_once __DIR__ . '/config.php';

$user = hh_current_user();
$isLoggedIn = $user !== null;
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Health &amp; Harmony</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/health-harmony/css/app.css">
    <script src="/health-harmony/js/app.js" defer></script>
</head>
<body>
<header class="hh-navbar">
    <div class="hh-nav-left">
        <a href="/health-harmony/index.php" class="hh-logo">
            <span class="hh-logo-mark">H&amp;H</span>
            <span class="hh-logo-text">Health &amp; Harmony</span>
        </a>
    </div>

    <button class="hh-nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <nav class="hh-nav-links" id="navLinks">
        <?php if ($isLoggedIn): ?>
            <a href="/health-harmony/index.php" class="<?= $current === 'index.php' ? 'active' : '' ?>">Home</a>
            <a href="/health-harmony/pages/community.php" class="<?= $current === 'community.php' ? 'active' : '' ?>">Community</a>
            <a href="/health-harmony/pages/dm.php" class="<?= $current === 'dm.php' ? 'active' : '' ?>">DMs</a>
            <a href="/health-harmony/pages/settings.php" class="<?= $current === 'settings.php' ? 'active' : '' ?>">Settings</a>
        <?php else: ?>
            <a href="/health-harmony/index.php" class="active">Home</a>
        <?php endif; ?>
    </nav>

    <div class="hh-nav-actions">
        <button id="themeToggle" type="button" class="hh-btn hh-btn-ghost hh-btn-sm" aria-label="Toggle theme">🌓</button>
        <?php if ($isLoggedIn): ?>
            <a href="/health-harmony/auth/logout.php" class="hh-btn hh-btn-ghost hh-btn-sm">Logout</a>
            <div class="hh-nav-profile">
                <div class="hh-avatar">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? 'https://ui-avatars.com/api/?name=H+H') ?>" alt="avatar">
                </div>
                <div class="hh-nav-user-meta">
                    <span class="hh-nav-name"><?= htmlspecialchars($user['name']) ?></span>
                    <span class="hh-nav-username">@<?= htmlspecialchars($user['username']) ?></span>
                </div>
            </div>
        <?php else: ?>
            <a href="/health-harmony/auth/login.php" class="hh-btn hh-btn-ghost hh-btn-sm">Log in</a>
            <a href="/health-harmony/auth/register.php" class="hh-btn hh-btn-primary hh-btn-sm">Sign up</a>
        <?php endif; ?>
    </div>
</header>
<main class="hh-main">
