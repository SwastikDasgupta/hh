<?php
// common_units/config.php - core bootstrap for Health & Harmony

session_start();

define('HH_BASE_DIR', __DIR__ . '/..');
define('HH_DATA_DIR', HH_BASE_DIR . '/data');

if (!is_dir(HH_DATA_DIR)) {
    mkdir(HH_DATA_DIR, 0777, true);
}

define('HH_USERS_FILE', HH_DATA_DIR . '/users.json');
define('HH_COMMUNITY_FILE', HH_DATA_DIR . '/community.json');

// ---------- Generic JSON helpers ----------

function hh_load_json(string $path, array $default): array {
    if (!file_exists($path)) {
        return $default;
    }
    $raw = file_get_contents($path);
    if ($raw === false || $raw === '') {
        return $default;
    }
    $data = json_decode($raw, true);
    return is_array($data) ? $data : $default;
}

function hh_save_json(string $path, array $data): void {
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}

// ---------- Users ----------

function hh_load_users(): array {
    return hh_load_json(HH_USERS_FILE, ['users' => []]);
}

function hh_save_users(array $data): void {
    hh_save_json(HH_USERS_FILE, $data);
}

function hh_find_user_by_id(string $id): ?array {
    $data = hh_load_users();
    foreach ($data['users'] as $user) {
        if ($user['id'] === $id) return $user;
    }
    return null;
}

function hh_find_user_by_username_or_email(string $identifier): ?array {
    $idLower = strtolower($identifier);
    $data = hh_load_users();
    foreach ($data['users'] as $user) {
        if (strtolower($user['username']) === $idLower || strtolower($user['email']) === $idLower) {
            return $user;
        }
    }
    return null;
}

function hh_username_exists(string $username): bool {
    $uLower = strtolower($username);
    $data = hh_load_users();
    foreach ($data['users'] as $user) {
        if (strtolower($user['username']) === $uLower) return true;
    }
    return false;
}

function hh_email_exists(string $email): bool {
    $eLower = strtolower($email);
    $data = hh_load_users();
    foreach ($data['users'] as $user) {
        if (strtolower($user['email']) === $eLower) return true;
    }
    return false;
}

function hh_current_user(): ?array {
    if (empty($_SESSION['user_id'])) return null;
    return hh_find_user_by_id($_SESSION['user_id']);
}

function hh_require_login(): void {
    if (!hh_current_user()) {
        header('Location: /health-harmony/auth/login.php');
        exit;
    }
}

// ---------- Community messages + anonymous labels ----------

function hh_load_community(): array {
    $data = hh_load_json(HH_COMMUNITY_FILE, ['messages' => [], 'anon_map' => []]);
    if (!isset($data['messages']) || !is_array($data['messages'])) $data['messages'] = [];
    if (!isset($data['anon_map']) || !is_array($data['anon_map'])) $data['anon_map'] = [];
    return $data;
}

function hh_save_community(array $data): void {
    hh_save_json(HH_COMMUNITY_FILE, $data);
}

function hh_get_or_assign_anon_label(array &$data, string $userId): string {
    if (isset($data['anon_map'][$userId])) return $data['anon_map'][$userId];

    $used = [];
    foreach ($data['anon_map'] as $label) {
        if (preg_match('/^an_(\\d+)$/', $label, $m)) {
            $num = (int)$m[1];
            $used[$num] = true;
        }
    }
    $n = 1;
    while (isset($used[$n])) $n++;
    $label = 'an_' . $n;
    $data['anon_map'][$userId] = $label;
    return $label;
}

function hh_release_anon_label(array &$data, string $userId): void {
    if (isset($data['anon_map'][$userId])) unset($data['anon_map'][$userId]);
}

// ---------- Site-wide stats for homepage ----------

function hh_site_stats(): array {
    $usersData = hh_load_users();
    $communityData = hh_load_community();

    $totalUsers = isset($usersData['users']) && is_array($usersData['users'])
        ? count($usersData['users'])
        : 0;

    // We do not yet persist deleted-account history; keep as 0 for now.
    $deletedUsers = 0;

    $today = (new DateTime('now'))->format('Y-m-d');
    $postsToday = 0;
    if (isset($communityData['messages']) && is_array($communityData['messages'])) {
        foreach ($communityData['messages'] as $msg) {
            if (!isset($msg['created_at'])) {
                continue;
            }
            try {
                $ts = new DateTime($msg['created_at']);
            } catch (Exception $e) {
                continue;
            }
            if ($ts->format('Y-m-d') === $today) {
                $postsToday++;
            }
        }
    }

    return [
        'accounts_created' => $totalUsers,
        'accounts_deleted' => $deletedUsers,
        'posts_today' => $postsToday,
    ];
}

// Ensure base files exist
if (!file_exists(HH_USERS_FILE)) {
    hh_save_users(['users' => []]);
}
if (!file_exists(HH_COMMUNITY_FILE)) {
    hh_save_community(['messages' => [], 'anon_map' => []]);
}
