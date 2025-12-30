
<?php
require_once __DIR__ . '/common_units/navbar.php';

$stats = hh_site_stats();
?>

<section class="hh-hero hh-hero--full">
    <div class="hh-hero-inner">
        <div class="hh-hero-copy">
            <p class="hh-hero-pill">Mental health ✶ Social harmony</p>
            <h1 class="hh-hero-heading">Health &amp; Harmony</h1>
            <p class="hh-hero-text">
                A calm, modern space where you can check in with your mind, share honestly,
                and stay in touch with people who matter without the loud feed.
            </p>
            <div class="hh-hero-cta-row">
                <a href="/health-harmony/auth/register.php" class="hh-btn hh-btn-primary hh-btn-lg">Get started</a>
                <a href="/health-harmony/pages/community.php" class="hh-btn hh-btn-ghost hh-btn-lg">Enter community</a>
            </div>
            <div class="hh-hero-stats-row" aria-label="Today on Health &amp; Harmony">
                <div class="hh-hero-stat">
                    <span class="hh-hero-stat-label">Accounts created</span>
                    <span class="hh-hero-stat-value"><?= htmlspecialchars((string)$stats['accounts_created']) ?></span>
                </div>
                <div class="hh-hero-stat">
                    <span class="hh-hero-stat-label">Accounts deleted</span>
                    <span class="hh-hero-stat-value"><?= htmlspecialchars((string)$stats['accounts_deleted']) ?></span>
                </div>
                <div class="hh-hero-stat">
                    <span class="hh-hero-stat-label">Posts today</span>
                    <span class="hh-hero-stat-value"><?= htmlspecialchars((string)$stats['posts_today']) ?></span>
                </div>
            </div>
        </div>

        <div class="hh-hero-visual">
            <div class="hh-hero-orbit-shell">
                <div class="hh-orbit">
                    <img src="../uploads/inbuilt_pictures/B.png" alt="Abstract digital brain illustration" class="hh-hero-brain">
                    <div class="hh-orbit-ring hh-orbit-ring-1"></div>
                    <div class="hh-orbit-ring hh-orbit-ring-2"></div>
                    <div class="hh-orbit-ring hh-orbit-ring-3"></div>
                </div>
                <p class="hh-hero-orbit-caption">Designed to feel like a safe orbit for your thoughts.</p>
            </div>
        </div>
    </div>
</section>

<section class="hh-band" aria-label="Recent activity and community">
    <div class="hh-band-grid">
        <section class="hh-band-card" aria-labelledby="hh-social-heading">
            <div class="hh-band-header">
                <h2 id="hh-social-heading">From our Instagram</h2>
                <p class="hh-band-tagline">Preview of how your live grid will look once connected.</p>
            </div>
            <div class="hh-social-grid" data-hh-social-paginated>
                <!-- Page 1 -->
                <article class="hh-social-card" data-page="1">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">01</p>
                    </div>
                </article>
                <article class="hh-social-card" data-page="1">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">02</p>
                    </div>
                </article>
                <article class="hh-social-card" data-page="1">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">03</p>
                    </div>
                </article>

                <!-- Page 2 -->
                <article class="hh-social-card" data-page="2">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">04</p>
                    </div>
                </article>
                <article class="hh-social-card" data-page="2">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">05</p>
                    </div>
                </article>
                <article class="hh-social-card" data-page="2">
                    <div class="hh-social-media">
                        <div class="hh-social-image-placeholder"></div>
                    </div>
                    <div class="hh-social-body">
                        <p class="hh-social-handle">@health.and.harmony</p>
                        <p class="hh-social-caption">06</p>
                    </div>
                </article>
            </div>
            <div class="hh-social-pagination">
                <button type="button" class="hh-btn hh-btn-ghost hh-btn-sm" data-hh-social-prev>&larr;</button>
                <span class="hh-social-page-indicator" data-hh-social-page-indicator>1 / 2</span>
                <button type="button" class="hh-btn hh-btn-ghost hh-btn-sm" data-hh-social-next>&rarr;</button>
            </div>
        </section>

        <section class="hh-band-card" aria-labelledby="hh-poll-heading">
            <div class="hh-band-header">
                <h2 id="hh-poll-heading">Mood pulse poll</h2>
                <p class="hh-band-tagline">
                    A quick MCQ check-in for the whole community. The engine is ready and
                    will light up when you drop questions into the <strong>Poll Questions</strong> folder.
                </p>
            </div>
            <div class="hh-poll-card">
                <div class="hh-poll-status">Waiting for poll questions to be uploaded.</div>
                <div class="hh-poll-question hh-poll-question-placeholder">
                    Your first question will show here. Options below are just a preview.
                </div>
                <form class="hh-poll-form" aria-disabled="true">
                    <div class="hh-poll-options">
                        <label class="hh-poll-option">
                            <input type="radio" name="poll_option" disabled>
                            <span>Option A</span>
                        </label>
                        <label class="hh-poll-option">
                            <input type="radio" name="poll_option" disabled>
                            <span>Option B</span>
                        </label>
                        <label class="hh-poll-option">
                            <input type="radio" name="poll_option" disabled>
                            <span>Option C</span>
                        </label>
                        <label class="hh-poll-option">
                            <input type="radio" name="poll_option" disabled>
                            <span>Option D</span>
                        </label>
                    </div>
                    <button type="button" class="hh-btn hh-btn-primary hh-btn-sm" disabled>
                        Poll will go live once questions are uploaded
                    </button>
                </form>
            </div>
        </section>
    </div>
</section>

<section class="hh-section-block" aria-labelledby="hh-team-heading">
    <div class="hh-section-block-inner">
        <header class="hh-section-block-header">
            <h2 id="hh-team-heading">The crew behind Health &amp; Harmony</h2>
            <p>Small, focused, and obsessed with making digital spaces feel human again.</p>
        </header>
        <div class="hh-team-grid hh-team-grid--wide">
            <article class="hh-team-card">
                <div class="hh-team-avatar">SD</div>
                <p class="hh-team-name">Swastik Dasgupta</p>
                <p class="hh-team-role">Founder</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">AB</div>
                <p class="hh-team-name">Aryan Banerjee</p>
                <p class="hh-team-role">Co-founder</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">DU</div>
                <p class="hh-team-name">DPSM | Uddalak</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">IM</div>
                <p class="hh-team-name">Ishayu Mukherjee</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">RH</div>
                <p class="hh-team-name">Rahil</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">RM</div>
                <p class="hh-team-name">Rajveer Mukherjee</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">RD</div>
                <p class="hh-team-name">Riddhiman</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">RS</div>
                <p class="hh-team-name">Rishabh</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
            <article class="hh-team-card">
                <div class="hh-team-avatar">SD</div>
                <p class="hh-team-name">Siddhart Das</p>
                <p class="hh-team-role">Core team</p>
                <p class="hh-team-bio"></p>
            </article>
        </div>
    </div>
</section>

<section class="hh-section-block" aria-labelledby="hh-reviews-heading">
    <div class="hh-section-block-inner">
        <header class="hh-section-block-header">
            <h2 id="hh-reviews-heading">What people are saying</h2>
            <p>Early reactions from people who tried Health &amp; Harmony in its first versions.</p>
        </header>
        <div class="hh-reviews-grid hh-reviews-grid--wide">
            <figure class="hh-review-card">
                <blockquote>
                    It feels more like a personal check-in space than another social app fighting for my attention.
                </blockquote>
                <figcaption>Second-year student</figcaption>
            </figure>
            <figure class="hh-review-card">
                <blockquote>
                    Being able to share under an anonymous label makes it easier to actually be honest.
                </blockquote>
                <figcaption>Community beta tester</figcaption>
            </figure>
            <figure class="hh-review-card">
                <blockquote>
                    The interface is quiet. I come here at night to decompress instead of doomscrolling.
                </blockquote>
                <figcaption>Working professional</figcaption>
            </figure>
        </div>
    </div>
</section>

</main>
</body>

</html>