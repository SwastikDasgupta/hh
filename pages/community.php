<?php
require_once __DIR__ . '/../common_units/config.php';
require_once __DIR__ . '/../common_units/navbar.php';

hh_require_login();
$user = hh_current_user();
$data = hh_load_community();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message   = trim($_POST['message'] ?? '');
    $anonymous = isset($_POST['anonymous']);

    if ($message !== '') {
        $entry = [
            'id'           => uniqid('msg_', true),
            'user_id'      => $user['id'],
            'created_at'   => date('Y-m-d H:i'),
            'content'      => htmlspecialchars($message, ENT_QUOTES, 'UTF-8'),
            'is_anonymous' => $anonymous,
        ];

        if ($anonymous) {
            $label = hh_get_or_assign_anon_label($data, $user['id']);
            $entry['display_name'] = $label;
            $entry['username']     = $label;
            $entry['avatar']       = null;
        } else {
            $entry['display_name'] = $user['name'];
            $entry['username']     = '@' . $user['username'];
            $entry['avatar']       = $user['avatar'];
        }

        $data['messages'][] = $entry;
        hh_save_community($data);

        header('Location: /health-harmony/pages/community.php');
        exit;
    }
}

$messages = array_reverse($data['messages']);
?>
<section class="hh-app-grid chat">
    <aside class="hh-column hh-column-left">
        <div class="hh-profile-summary">
            <div class="hh-profile-header">
                <div class="hh-avatar-lg">
                    <img src="<?= htmlspecialchars($user['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['name'])) ?>" alt="avatar">
                </div>
                <div>
                    <h2><?= htmlspecialchars($user['name']) ?></h2>
                    <p class="hh-muted">@<?= htmlspecialchars($user['username']) ?></p>
                </div>
            </div>
            <p class="hh-bio">
                <?= $user['bio'] !== '' ? nl2br(htmlspecialchars($user['bio'])) : 'Use this space to safely let things out.'; ?>
            </p>
            <p class="hh-anon-indicator">
                Tip: turn on anonymous per-message below or globally in Settings.
            </p>
            <a href="/health-harmony/pages/settings.php" class="hh-btn hh-btn-ghost hh-btn-full">Profile &amp; privacy</a>
        </div>
        <div class="hh-side-info" style="margin-top:18px;">
            <h3>Community guidelines</h3>
            <ul class="hh-list">
                <li>Be gentle. You don’t know what someone’s day has been like.</li>
                <li>No hate, no discrimination, no harassment.</li>
                <li>Don’t give medical advice beyond your experience.</li>
            </ul>
        </div>
    </aside>

    <section class="hh-column hh-column-center">
        <div class="hh-chat-window">
            <div class="hh-chat-header">
                <div>
                    <h2>Community chat</h2>
                    <p class="hh-muted">Share freely. You can switch to anonymous for any message.</p>
                </div>
                <div>
                    <span class="hh-badge">Live feed</span>
                </div>
            </div>

            <div class="hh-chat-messages" id="chatMessages">
                <?php if (empty($messages)): ?>
                    <p class="hh-muted" style="text-align:center; margin-top:24px;">No messages yet. Start the first check-in.</p>
                <?php else: ?>
                    <?php foreach ($messages as $msg): ?>
                        <?php
                        $isSelf = $msg['user_id'] === $user['id'];
                        $classes = 'hh-chat-message';
                        if ($isSelf) $classes .= ' self';
                        ?>
                        <article class="<?= $classes ?>">
                            <div class="hh-chat-avatar">
                                <?php if (!empty($msg['is_anonymous'])): ?>
                                    <span class="circle">?</span>
                                <?php elseif (!empty($msg['avatar'])): ?>
                                    <img src="<?= htmlspecialchars($msg['avatar']) ?>" alt="">
                                <?php else: ?>
                                    <span class="circle">•</span>
                                <?php endif; ?>
                            </div>
                            <div class="hh-chat-bubble">
                                <div class="hh-chat-meta">
                                    <span class="name"><?= htmlspecialchars($msg['display_name']) ?></span>
                                    <span class="tag"><?= htmlspecialchars($msg['username']) ?></span>
                                    <span class="time"><?= htmlspecialchars($msg['created_at']) ?></span>
                                </div>
                                <p><?= nl2br($msg['content']) ?></p>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <form class="hh-chat-input" method="post" action="/health-harmony/pages/community.php">
                <textarea name="message" rows="2" placeholder="Share what’s on your mind..." required></textarea>
                <div class="hh-chat-input-footer">
                    <label class="hh-switch">
                        <input type="checkbox" name="anonymous">
                        <span class="hh-slider"></span>
                    </label>
                    <span class="hh-switch-label">Send as anonymous</span>
                    <button type="submit" class="hh-btn hh-btn-primary">Send</button>
                </div>
            </form>
        </div>
    </section>
</section>

</main>
</body>
</html>
