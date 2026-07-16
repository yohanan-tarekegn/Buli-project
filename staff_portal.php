<?php
session_start();

if (!isset($_SESSION['staff_logged_in'])) {
    header('Location: staff_login.php');
    exit;
}

$page_title = 'Staff Portal';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$staff_name = $_SESSION['staff_name'];
$staff_dept = $_SESSION['staff_dept'];

$status_msg = '';
$status_type = '';

// Handle submitting news/events
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_news'])) {
    $title_en   = trim($_POST['title_en'] ?? '');
    $title_am   = trim($_POST['title_am'] ?? '');
    $content_en = trim($_POST['content_en'] ?? '');
    $content_am = trim($_POST['content_am'] ?? '');
    $type       = $_POST['type'] ?? 'news';
    $date_posted = date('Y-m-d');

    if (!empty($title_en) && !empty($title_am) && !empty($content_en) && !empty($content_am)) {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO news_events (title_en, title_am, content_en, content_am, type, date_posted) VALUES (:title_en, :title_am, :content_en, :content_am, :type, :date_posted)");
                $stmt->execute([
                    ':title_en'   => $title_en,
                    ':title_am'   => $title_am,
                    ':content_en' => $content_en,
                    ':content_am' => $content_am,
                    ':type'       => $type,
                    ':date_posted'=> $date_posted
                ]);
                $status_msg = 'Post successfully published!';
                $status_type = 'success';
            } catch (\PDOException $e) {
                $status_msg = 'Database error: ' . $e->getMessage();
                $status_type = 'error';
            }
        } else {
            $status_msg = '[Demo Mode] Post validated successfully. (Database disconnected)';
            $status_type = 'success';
        }
    } else {
        $status_msg = 'Please fill in all fields (both English and Amharic).';
        $status_type = 'error';
    }
}

// Fetch posts
$posts = [];
if ($pdo) {
    try {
        $posts = $pdo->query("SELECT * FROM news_events ORDER BY date_posted DESC")->fetchAll();
    } catch (\PDOException $e) {
        // Silently skip
    }
}
?>

<style>
    .staff-portal-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }
    .portal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: #2b6cb0;
        color: #fff;
        padding: 1.5rem 2rem;
        border-radius: 6px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .portal-header h2 {
        font-size: 1.5rem;
    }
    .portal-header p {
        font-size: 0.9rem;
        color: #ebf8ff;
    }
    .logout-btn {
        background-color: #e53e3e;
        color: #fff;
        padding: 0.5rem 1.25rem;
        border-radius: 4px;
        font-weight: bold;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .logout-btn:hover {
        background-color: #c53030;
    }
    .dashboard-grid {
        display: grid;
        grid-template-columns: 3fr 2fr;
        gap: 2rem;
    }
    .card-title {
        color: #1a365d;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    .form-group-staff {
        margin-bottom: 1.25rem;
    }
    .form-group-staff label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        font-size: 0.9rem;
        color: #2d3748;
    }
    .control-staff {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 4px;
        font-size: 0.95rem;
        font-family: inherit;
    }
    .control-staff:focus {
        outline: none;
        border-color: #2b6cb0;
    }
    textarea.control-staff {
        resize: vertical;
        min-height: 100px;
    }
    .btn-submit-staff {
        background-color: #2b6cb0;
        color: #fff;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
    }
    .btn-submit-staff:hover {
        background-color: #2b6cb0;
    }
    .alert-staff {
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    .alert-staff-success {
        background-color: #c6f6d5;
        color: #22543d;
        border: 1px solid #9ae6b4;
    }
    .alert-staff-error {
        background-color: #fed7d7;
        color: #742a2a;
        border: 1px solid #feb2b2;
    }
    .post-list {
        max-height: 500px;
        overflow-y: auto;
    }
    .post-item {
        padding: 1rem 0;
        border-bottom: 1px solid #e2e8f0;
    }
    .post-item:last-child {
        border-bottom: none;
    }
    .post-item h4 {
        color: #2d3748;
        font-size: 0.95rem;
        margin-bottom: 0.25rem;
    }
    .post-item span.post-type {
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: bold;
        padding: 0.15rem 0.4rem;
        border-radius: 3px;
        background-color: #ebf8ff;
        color: #2b6cb0;
    }
    .post-item span.post-date {
        font-size: 0.75rem;
        color: #718096;
        margin-left: 0.5rem;
    }
    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="staff-portal-container">
    <div class="portal-header">
        <div>
            <h2>Staff Dashboard</h2>
            <p>Welcome back, <strong><?php echo htmlspecialchars($staff_name); ?></strong> (<?php echo htmlspecialchars($staff_dept); ?> Department)</p>
        </div>
        <div>
            <a href="staff_logout.php" class="logout-btn">Log Out</a>
        </div>
    </div>

    <?php if ($status_msg): ?>
        <div class="alert-staff alert-staff-<?php echo $status_type; ?>">
            <?php echo htmlspecialchars($status_msg); ?>
        </div>
    <?php endif; ?>

    <div class="dashboard-grid">
        <!-- Main Form Panel -->
        <div class="card" style="background: #fff; border: 1px solid #cbd5e0; border-radius: 6px; padding: 2rem;">
            <h3 class="card-title">Publish News, Event, or Announcement</h3>
            
            <form method="POST" action="staff_portal.php">
                <div class="form-group-staff">
                    <label for="postType">Select Post Category</label>
                    <select id="postType" name="type" class="control-staff">
                        <option value="news">News Article</option>
                        <option value="announcement">Announcement / Notice Board</option>
                        <option value="event">Upcoming College Event</option>
                    </select>
                </div>

                <!-- English Title & Content -->
                <div class="form-group-staff" style="margin-top: 1.5rem;">
                    <label for="titleEn">Title (English) *</label>
                    <input type="text" id="titleEn" name="title_en" class="control-staff" placeholder="e.g., Enrollment Deadline Extended" required>
                </div>

                <div class="form-group-staff">
                    <label for="contentEn">Body Content (English) *</label>
                    <textarea id="contentEn" name="content_en" class="control-staff" placeholder="Detailed description of the post in English..." required></textarea>
                </div>

                <!-- Amharic Title & Content -->
                <div class="form-group-staff" style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
                    <label for="titleAm">Title (Amharic) *</label>
                    <input type="text" id="titleAm" name="title_am" class="control-staff" placeholder="እባክዎን ርዕስ በአማርኛ ያስገቡ" required>
                </div>

                <div class="form-group-staff">
                    <label for="contentAm">Body Content (Amharic) *</label>
                    <textarea id="contentAm" name="content_am" class="control-staff" placeholder="ዝርዝር መግለጫ በአማርኛ..." required></textarea>
                </div>

                <button type="submit" name="submit_news" class="btn-submit-staff">Publish Entry</button>
            </form>
        </div>

        <!-- Sidebar List Panel -->
        <div class="card" style="background: #fff; border: 1px solid #cbd5e0; border-radius: 6px; padding: 1.5rem; align-self: start;">
            <h3 class="card-title">Live Published Posts (<?php echo count($posts); ?>)</h3>
            <div class="post-list">
                <?php if (empty($posts)): ?>
                    <p style="color: #718096; font-style: italic; text-align: center; padding: 2rem;">No posts published yet.</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post-item">
                            <h4><?php echo htmlspecialchars($post['title_en']); ?></h4>
                            <span class="post-type"><?php echo $post['type']; ?></span>
                            <span class="post-date"><?php echo date('d M Y', strtotime($post['date_posted'])); ?></span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
