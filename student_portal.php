<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header('Location: student_login.php');
    exit;
}

$page_title = 'Student Dashboard';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$student_id = $_SESSION['student_id'];
$student = null;
$announcements = [];
$downloads = [];

if ($pdo) {
    try {
        // Fetch student profile details
        $stmt = $pdo->prepare("SELECT * FROM students WHERE id = :id");
        $stmt->execute([':id' => $student_id]);
        $student = $stmt->fetch();

        // Fetch announcements & events
        $announcements = $pdo->query("SELECT * FROM news_events ORDER BY date_posted DESC LIMIT 5")->fetchAll();

        // Fetch academic downloads
        $downloads = $pdo->query("SELECT * FROM downloads ORDER BY created_at DESC LIMIT 5")->fetchAll();
    } catch (\PDOException $e) {
        $db_error = $e->getMessage();
    }
}

// Fallback if DB is disconnected or it is the demo user
if (!$student) {
    $student = [
        'full_name' => $_SESSION['student_name'] ?? 'Demo Student',
        'email' => 'student@example.com',
        'department' => 'Information Technology',
        'student_id_no' => 'MGMB/1024/18',
        'status' => 'Active',
        'created_at' => date('Y-m-d H:i:s')
    ];
}

// Fallback arrays if no DB connection
if (empty($announcements)) {
    $announcements = [
        ['title_en' => 'Welcome to your Student Portal Dashboard', 'content_en' => 'Access all your academic resources, downloads and news here.', 'type' => 'announcement', 'date_posted' => date('Y-m-d')],
        ['title_en' => 'Semester I Registration Guidelines', 'content_en' => 'Please finalize registration by submiting COC certificates to registration offices.', 'type' => 'announcement', 'date_posted' => date('Y-m-d', strtotime('-2 days'))]
    ];
}

if (empty($downloads)) {
    $downloads = [
        ['title' => 'Student Handbook', 'category' => 'Regulations', 'file_name' => 'student_conduct.pdf'],
        ['title' => 'Academic Calendar 2026/27', 'category' => 'Academic Guides', 'file_name' => 'academic_calendar_2026.pdf'],
        ['title' => 'Level Registration Guide', 'category' => 'Academic Guides', 'file_name' => 'registration_guide.pdf']
    ];
}
?>

<style>
    .portal-container {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }
    .portal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        background: #1a365d;
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
        color: #cbd5e0;
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
        grid-template-columns: 1fr 2fr;
        gap: 2rem;
    }
    .profile-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 1.5rem;
        align-self: start;
    }
    .profile-card h3 {
        color: #1a365d;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    .profile-detail {
        margin-bottom: 1rem;
    }
    .profile-detail span {
        display: block;
        font-size: 0.8rem;
        color: #718096;
        text-transform: uppercase;
        font-weight: bold;
    }
    .profile-detail strong {
        font-size: 1rem;
        color: #2d3748;
    }
    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        font-size: 0.85rem;
        font-weight: bold;
        background: #c6f6d5;
        color: #22543d;
        margin-top: 0.25rem;
    }
    .main-panel {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }
    .content-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 1.5rem;
    }
    .content-card h3 {
        color: #1a365d;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 0.5rem;
        font-size: 1.1rem;
    }
    .announcement-item {
        border-bottom: 1px solid #e2e8f0;
        padding: 1rem 0;
    }
    .announcement-item:last-child {
        border-bottom: none;
    }
    .announcement-item h4 {
        color: #2d3748;
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }
    .announcement-item p {
        color: #4a5568;
        font-size: 0.9rem;
        line-height: 1.5;
    }
    .announcement-meta {
        font-size: 0.75rem;
        color: #718096;
        margin-top: 0.5rem;
    }
    .download-list {
        list-style: none;
    }
    .download-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e2e8f0;
    }
    .download-item:last-child {
        border-bottom: none;
    }
    .download-item-info h4 {
        color: #2d3748;
        font-size: 0.95rem;
    }
    .download-item-info span {
        font-size: 0.75rem;
        color: #718096;
        background: #edf2f7;
        padding: 0.1rem 0.4rem;
        border-radius: 3px;
        margin-top: 0.2rem;
        display: inline-block;
    }
    .btn-download-link {
        background-color: #3182ce;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: bold;
    }
    .btn-download-link:hover {
        background-color: #2b6cb0;
    }
    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="portal-container">
    <div class="portal-header">
        <div>
            <h2>Welcome back, <?php echo htmlspecialchars($student['full_name']); ?>!</h2>
            <p>MGMBPTC Student Portal Dashboard</p>
        </div>
        <div>
            <a href="student_logout.php" class="logout-btn">Log Out</a>
        </div>
    </div>

    <div class="dashboard-grid">
        <!-- Sidebar Profile -->
        <div class="profile-card">
            <h3>My Profile</h3>
            <div class="profile-detail">
                <span>Full Name</span>
                <strong><?php echo htmlspecialchars($student['full_name']); ?></strong>
            </div>
            <div class="profile-detail">
                <span>Email Address</span>
                <strong><?php echo htmlspecialchars($student['email']); ?></strong>
            </div>
            <div class="profile-detail">
                <span>Registered Department</span>
                <strong><?php echo htmlspecialchars($student['department']); ?></strong>
            </div>
            <div class="profile-detail">
                <span>Student ID Number</span>
                <strong><?php echo htmlspecialchars($student['student_id_no'] ?: 'Pending Assignment'); ?></strong>
            </div>
            <div class="profile-detail">
                <span>Account Status</span>
                <div>
                    <span class="status-badge"><?php echo htmlspecialchars($student['status']); ?></span>
                </div>
            </div>
            <div class="profile-detail" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid #e2e8f0;">
                <span>Academic Help Desk</span>
                <p style="font-size: 0.85rem; color: #4a5568; margin-top: 0.25rem;">
                    For any support, visit the Registrar's Office or drop an inquiry on our <a href="contact.php">Contact Page</a>.
                </p>
            </div>
        </div>

        <!-- Main Dashboard Content -->
        <div class="main-panel">
            <!-- News & Announcements -->
            <div class="content-card">
                <h3>Latest Notice Board</h3>
                <?php foreach ($announcements as $item): ?>
                    <div class="announcement-item">
                        <h4><?php echo htmlspecialchars($item['title_en'] ?? $item['title_am']); ?></h4>
                        <p><?php echo htmlspecialchars($item['content_en'] ?? $item['content_am']); ?></p>
                        <div class="announcement-meta">
                            Type: <strong><?php echo ucfirst($item['type']); ?></strong> | Posted on: <?php echo date('d M Y', strtotime($item['date_posted'] ?? $item['created_at'])); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Download Center Quick Access -->
            <div class="content-card">
                <h3>Resources & Reference Materials</h3>
                <ul class="download-list">
                    <?php foreach ($downloads as $item): ?>
                        <li class="download-item">
                            <div class="download-item-info">
                                <h4><?php echo htmlspecialchars($item['title']); ?></h4>
                                <span><?php echo htmlspecialchars($item['category']); ?></span>
                            </div>
                            <div>
                                <a href="downloads.php" class="btn-download-link">Go to Download</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
