 <?php
$page_title = 'Home';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$title_field = ($lang === 'am') ? 'title_am' : 'title_en';
$content_field = ($lang === 'am') ? 'content_am' : 'content_en';

$announcements = [];
$news = [];

if ($pdo) {
    try {
        $ann_stmt = $pdo->query("SELECT * FROM news_events WHERE type = 'announcement' ORDER BY date_posted DESC LIMIT 3");
        $announcements = $ann_stmt->fetchAll();
        
        $news_stmt = $pdo->query("SELECT * FROM news_events WHERE type = 'news' ORDER BY date_posted DESC LIMIT 3");
        $news = $news_stmt->fetchAll();
    } catch (\PDOException $e) {
        // Fallback to static
    }
}

// Fallback static arrays if database query returns empty
if (empty($announcements)) {
    $announcements = [
        [
            'id' => 1,
            'date_posted' => '2026-07-10',
            'title_en' => 'Registration Open for Semester I (2026/2027)',
            'title_am' => 'ለእረኛ (Regular) ተማሪዎች ምዝገባ ተጀምሯል (2018/2019 ዓ.ም)'
        ],
        [
            'id' => 2,
            'date_posted' => '2026-07-05',
            'title_en' => 'Workshop on Innovation and Technology Transfer starts next Tuesday.',
            'title_am' => 'የቴክኖሎጂ ፈጠራ ሴሚናር በቅርቡ ይጀምራል'
        ],
        [
            'id' => 3,
            'date_posted' => '2026-06-28',
            'title_en' => 'Announcement: Graduation ceremony date and venue updates.',
            'title_am' => 'የምረቃ ስነ-ስርዓት ዝግጅት'
        ]
    ];
}

if (empty($news)) {
    $news = [
        [
            'id' => 1,
            'date_posted' => '2026-07-12',
            'title_en' => 'College Partners with Ministry of Innovation',
            'title_am' => 'ከፈጠራና ቴክኖሎጂ ሚኒስቴር ጋር ስልታዊ ስምምነት ተፈረመ',
            'content_en' => 'MGMBPTC has signed a new partnership agreement with the Ministry of Innovation and Technology to support student startups and hardware prototyping.',
            'content_am' => 'ኮሌጃችን ከፈጠራና ቴክኖሎጂ ሚኒስቴር (MInT) ጋር በጋራ የፈጠራ ማዕከል በኮሌጁ ውስጥ ለማቋቋም የመግባቢያ ስምምነት ተፈራርሟል።'
        ],
        [
            'id' => 2,
            'date_posted' => '2026-06-20',
            'title_en' => 'Continuous Skills Upgrade: Evening ICT Trainings',
            'title_am' => 'የክህሎት ማሻሻያ፡ የማታ የኮምፒውተር ስልጠናዎች',
            'content_en' => 'Registration is ongoing for short-term evening training programs in Database Management, Web Development, and Network Administration.',
            'content_am' => 'የአካባቢውን ማህበረሰብ ፍላጎት ለማሟላት የአይቲ ክፍል የማታ አጫጭር ስልጠናዎችን አስፋፍቷል።'
        ],
        [
            'id' => 3,
            'date_posted' => '2026-05-15',
            'title_en' => 'Automotive Department Receives New Lab Equipment',
            'title_am' => 'የሞተርና አውቶሞቲቭ ወርክሾፕ እድሳት ተደረገለት',
            'content_en' => 'To bolster practical learning, our automotive workshops received advanced vehicle diagnostic units and electric engines for study.',
            'content_am' => 'የአውቶሞቲቭ ቴክኖሎጂ ወርክሾፓችን ዘመናዊ የምርመራ ማሽኖችን ተቀብሏል።'
        ]
    ];
}
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
            <?php foreach ($announcements as $ann): ?>
                <li class="notice-item">
                    <span class="notice-date"><?php echo date('M d, Y', strtotime($ann['date_posted'])); ?></span>
                    <a href="news.php#notice<?php echo $ann['id']; ?>">
                        <?php echo htmlspecialchars($ann[$title_field]); ?>
                    </a>
                </li>
            <?php endforeach; ?>
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
        <?php foreach ($news as $item): ?>
            <div class="card" style="background-color: var(--bg-light);">
                <span class="notice-date" style="margin-bottom: 0.5rem; display: block;"><?php echo date('M d, Y', strtotime($item['date_posted'])); ?></span>
                <h4><?php echo htmlspecialchars($item[$title_field]); ?></h4>
                <p style="font-size: 0.9rem; margin-bottom: 1rem;">
                    <?php 
                        $text = $item[$content_field];
                        echo htmlspecialchars(strlen($text) > 120 ? substr($text, 0, 117) . '...' : $text); 
                    ?>
                </p>
                <a href="news.php#news<?php echo $item['id']; ?>" style="font-weight: bold; font-size: 0.9rem;"><?php echo __('btn_read_more'); ?> &rarr;</a>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
