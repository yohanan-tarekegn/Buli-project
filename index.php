<?php
$page_title = 'Home';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner Section -->
<section class="hero-banner">
    <h2><?php echo __('hero_title'); ?></h2>
    <p><?php echo __('hero_desc'); ?></p>
    <div class="hero-actions">
        <a href="admission.php" class="btn btn-secondary"><?php echo __('btn_apply'); ?></a>
        <a href="about.php" class="btn" style="margin-left: 10px;"><?php echo __('btn_read_more'); ?></a>
    </div>
</section>

<!-- Split Main Grid -->
<div class="grid-2">
    <!-- About intro segment -->
    <section class="card">
        <h3><?php echo __('nav_about'); ?></h3>
        <p>
            Major General Mulugeta Buli Polytechnic College (MGMBPTC) is one of Ethiopia's leading technical institutions, dedicated to providing high-quality Technical and Vocational Education and Training (TVET). 
        </p>
        <p style="margin-top: 1rem;">
            Through our modern laboratories, workshops, and industry partnerships, we offer students hands-on experiences to develop the skills necessary to excel in a rapidly changing technological landscape.
        </p>
        <div style="margin-top: 1.5rem;">
            <a href="about.php" class="btn"><?php echo __('btn_read_more'); ?></a>
        </div>
    </section>

    <!-- Notice Board Segment -->
    <section class="card notice-board">
        <h3><?php echo __('announcements'); ?></h3>
        <ul class="notice-list">
            <li class="notice-item">
                <span class="notice-date">July 10, 2026</span>
                <a href="news.php#notice1">Registration for Next Academic Semester is Now Open!</a>
            </li>
            <li class="notice-item">
                <span class="notice-date">July 05, 2026</span>
                <a href="news.php#notice2">Workshop on Innovation and Technology Transfer starts next Tuesday.</a>
            </li>
            <li class="notice-item">
                <span class="notice-date">June 28, 2026</span>
                <a href="news.php#notice3">Announcement: Graduation ceremony date and venue updates.</a>
            </li>
        </ul>
    </section>
</div>

<!-- Statistics Counter Block -->
<section class="stats-list">
    <div class="stat-item">
        <h4>4,000+</h4>
        <p>Active Students</p>
    </div>
    <div class="stat-item">
        <h4>12+</h4>
        <p>TVET Departments</p>
    </div>
    <div class="stat-item">
        <h4>50+</h4>
        <p>Industry Partners</p>
    </div>
    <div class="stat-item">
        <h4>150+</h4>
        <p>Qualified Instructors</p>
    </div>
</section>

<!-- News Preview Section -->
<section class="card" style="margin-bottom: 2rem;">
    <h3><?php echo __('latest_news'); ?></h3>
    <div class="grid-3" style="margin-top: 1rem; margin-bottom: 0;">
        <div class="card" style="background-color: var(--bg-light);">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">July 12, 2026</span>
            <h4>College Partners with Ministry of Innovation</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                MGMBPTC has signed a new partnership agreement with the Ministry of Innovation and Technology to support student startups and hardware prototyping.
            </p>
            <a href="news.php#news1" style="font-weight: bold; font-size: 0.9rem;"><?php echo __('btn_read_more'); ?> &rarr;</a>
        </div>
        <div class="card" style="background-color: var(--bg-light);">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">June 20, 2026</span>
            <h4>Short-term ICT Training Registration</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                Registration is ongoing for short-term evening training programs in Database Management, Web Development, and Network Administration.
            </p>
            <a href="news.php#news2" style="font-weight: bold; font-size: 0.9rem;"><?php echo __('btn_read_more'); ?> &rarr;</a>
        </div>
        <div class="card" style="background-color: var(--bg-light);">
            <span class="notice-date" style="margin-bottom: 0.5rem; display: block;">May 15, 2026</span>
            <h4>Automotive Department Receives New Lab Equipment</h4>
            <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                To bolster practical learning, our automotive workshops received advanced vehicle diagnostic units and electric engines for study.
            </p>
            <a href="news.php#news3" style="font-weight: bold; font-size: 0.9rem;"><?php echo __('btn_read_more'); ?> &rarr;</a>
        </div>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
