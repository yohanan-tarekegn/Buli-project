<?php
session_start();

if (!isset($_SESSION['student_id'])) {
    header('Location: student_login.php');
    exit;
}

require_once __DIR__ . '/includes/db.php';

$student_id = $_SESSION['student_id'];

// Guard: if student still has OTP set, force them to change password first
if ($pdo) {
    try {
        $chk = $pdo->prepare("SELECT must_change_password FROM students WHERE id = :id");
        $chk->execute([':id' => $student_id]);
        $row = $chk->fetch();
        if ($row && !empty($row['must_change_password'])) {
            header('Location: change_password.php');
            exit;
        }
    } catch (\PDOException $e) { /* silently skip */ }
}

$page_title = 'Student Dashboard';
require_once __DIR__ . '/includes/header.php';

$student = null;
$announcements = [];
$downloads = [];
$student_grades = [];

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

        // Fetch student course grades
        $stmt_g = $pdo->prepare("
            SELECT g.*, c.course_code, c.course_title, c.credit_hours, c.department
            FROM grades g
            JOIN courses c ON g.course_id = c.id
            WHERE g.student_id = :student_id
            ORDER BY g.semester ASC, c.course_code ASC
        ");
        $stmt_g->execute([':student_id' => $student_id]);
        $student_grades = $stmt_g->fetchAll();
    } catch (\PDOException $e) {
        $db_error = $e->getMessage();
    }
}

// Fallback if DB is disconnected or it is the demo user
if (!$student) {
    $student = [
        'full_name' => $_SESSION['student_name'] ?? 'Demo Student',
        'email' => 'student@mgmbptc.edu.et',
        'department' => 'Information Technology',
        'student_id_no' => 'MGMB/2026/0001',
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

if (empty($student_grades)) {
    // Mock records mapped to IT department
    $student_grades = [
        [
            'course_code' => 'IT-101',
            'course_title' => 'Introduction to Computing',
            'credit_hours' => 3,
            'semester' => 'Year 1, Sem I',
            'grade' => 'A',
            'grade_point' => 4.00,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-102',
            'course_title' => 'Fundamentals of Programming (C++)',
            'credit_hours' => 4,
            'semester' => 'Year 1, Sem I',
            'grade' => 'B+',
            'grade_point' => 3.50,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'COM-101',
            'course_title' => 'Technical English Communication',
            'credit_hours' => 2,
            'semester' => 'Year 1, Sem I',
            'grade' => 'A-',
            'grade_point' => 3.75,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'COM-103',
            'course_title' => 'Occupational Safety & Health (OSH)',
            'credit_hours' => 2,
            'semester' => 'Year 1, Sem I',
            'grade' => 'A',
            'grade_point' => 4.00,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-103',
            'course_title' => 'Database Management Systems',
            'credit_hours' => 3,
            'semester' => 'Year 1, Sem II',
            'grade' => 'A-',
            'grade_point' => 3.75,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-201',
            'course_title' => 'Network Administration & Security',
            'credit_hours' => 4,
            'semester' => 'Year 1, Sem II',
            'grade' => 'B',
            'grade_point' => 3.00,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'COM-102',
            'course_title' => 'Entrepreneurship & Job Creation',
            'credit_hours' => 2,
            'semester' => 'Year 1, Sem II',
            'grade' => 'A+',
            'grade_point' => 4.00,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-202',
            'course_title' => 'Web Application Development',
            'credit_hours' => 3,
            'semester' => 'Year 2, Sem I',
            'grade' => 'A',
            'grade_point' => 4.00,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-203',
            'course_title' => 'Hardware & System Troubleshooting',
            'credit_hours' => 3,
            'semester' => 'Year 2, Sem I',
            'grade' => 'B-',
            'grade_point' => 2.75,
            'status' => 'Completed'
        ],
        [
            'course_code' => 'IT-301',
            'course_title' => 'System Analysis & Design',
            'credit_hours' => 3,
            'semester' => 'Year 2, Sem I',
            'grade' => 'IP',
            'grade_point' => 0.00,
            'status' => 'Ongoing'
        ]
    ];
}

// Calculate GPA and cumulative CGPA dynamically
$semesters_data = [];
$total_cum_credits = 0;
$total_cum_points = 0;

foreach ($student_grades as $g) {
    $sem = $g['semester'];
    if (!isset($semesters_data[$sem])) {
        $semesters_data[$sem] = [
            'credits_completed' => 0,
            'quality_points' => 0,
            'courses' => []
        ];
    }
    
    $semesters_data[$sem]['courses'][] = $g;
    
    if ($g['status'] === 'Completed') {
        $credits = (int)$g['credit_hours'];
        $gp = (float)$g['grade_point'];
        
        $semesters_data[$sem]['credits_completed'] += $credits;
        $semesters_data[$sem]['quality_points'] += ($credits * $gp);
    }
}

$cgpa_progression = [];
foreach ($semesters_data as $sem => &$data) {
    if ($data['credits_completed'] > 0) {
        $data['gpa'] = round($data['quality_points'] / $data['credits_completed'], 2);
        $total_cum_credits += $data['credits_completed'];
        $total_cum_points += $data['quality_points'];
        
        $current_cgpa = round($total_cum_points / $total_cum_credits, 2);
        $data['cumulative_cgpa'] = $current_cgpa;
        $cgpa_progression[$sem] = $current_cgpa;
    } else {
        $data['gpa'] = 0.00;
        $data['cumulative_cgpa'] = count($cgpa_progression) > 0 ? end($cgpa_progression) : 0.00;
    }
}
unset($data);

$final_cgpa = $total_cum_credits > 0 ? round($total_cum_points / $total_cum_credits, 2) : 0.00;
$total_credits_earned = $total_cum_credits;

// Determine current semester based on ongoing courses or the latest one
$current_semester = 'Year 2, Sem I';
if (!empty($student_grades)) {
    // Just grab the last semester in list
    $last_item = end($student_grades);
    $current_semester = $last_item['semester'];
}

// Generate CGPA SVG Chart
$chart_svg = '';
if (count($cgpa_progression) > 0) {
    $points = [];
    $x_start = 60;
    $x_end = 440;
    $y_start = 30;
    $y_end = 160;
    $chart_w = $x_end - $x_start;
    $chart_h = $y_end - $y_start;
    
    $sems = array_keys($cgpa_progression);
    $vals = array_values($cgpa_progression);
    $count = count($cgpa_progression);
    
    $min_y = 2.0;
    $max_y = 4.0;
    
    for ($i = 0; $i < $count; $i++) {
        $x = $x_start + ($count > 1 ? ($i * ($chart_w / ($count - 1))) : ($chart_w / 2));
        $val = $vals[$i];
        
        $y = $y_end - (($val - $min_y) / ($max_y - $min_y)) * $chart_h;
        $y = max($y_start, min($y, $y_end));
        $points[] = ['x' => $x, 'y' => $y, 'val' => $val, 'sem' => $sems[$i]];
    }
    
    $path_d = '';
    foreach ($points as $idx => $p) {
        $path_d .= ($idx === 0 ? 'M' : 'L') . " {$p['x']} {$p['y']}";
    }
    
    ob_start();
    ?>
    <svg viewBox="0 0 500 200" style="width: 100%; height: auto;">
        <defs>
            <linearGradient id="chartGrad" x1="0%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#2b6cb0" stop-opacity="0.25" />
                <stop offset="100%" stop-color="#ffffff" stop-opacity="0.0" />
            </linearGradient>
        </defs>
        
        <!-- Y Gridlines & Y Labels -->
        <?php for ($g = 2.0; $g <= 4.0; $g += 0.5): 
            $gy = $y_end - (($g - $min_y) / ($max_y - $min_y)) * $chart_h;
        ?>
            <line x1="60" y1="<?php echo $gy; ?>" x2="440" y2="<?php echo $gy; ?>" stroke="#e2e8f0" stroke-width="1" stroke-dasharray="4,4" />
            <text x="48" y="<?php echo $gy + 4; ?>" font-size="10" font-weight="600" fill="#718096" text-anchor="end"><?php echo number_format($g, 2); ?></text>
        <?php endfor; ?>
        
        <!-- Line and Area -->
        <?php if ($count > 1): ?>
            <path d="<?php echo $path_d; ?>" fill="none" stroke="#2b6cb0" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="<?php echo $path_d; ?> L <?php echo $points[$count-1]['x']; ?> <?php echo $y_end; ?> L <?php echo $points[0]['x']; ?> <?php echo $y_end; ?> Z" fill="url(#chartGrad)" />
        <?php endif; ?>
        
        <!-- Points & Tooltips -->
        <?php foreach ($points as $p): ?>
            <circle cx="<?php echo $p['x']; ?>" cy="<?php echo $p['y']; ?>" r="5" fill="#1a365d" stroke="#fff" stroke-width="2" />
            <!-- CGPA text value above node -->
            <text x="<?php echo $p['x']; ?>" y="<?php echo $p['y'] - 11; ?>" font-size="10.5" font-weight="bold" fill="#1a365d" text-anchor="middle"><?php echo number_format($p['val'], 2); ?></text>
            <!-- Semester labels on X axis -->
            <text x="<?php echo $p['x']; ?>" y="<?php echo $y_end + 18; ?>" font-size="9" font-weight="bold" fill="#718096" text-anchor="middle"><?php echo htmlspecialchars($p['sem']); ?></text>
        <?php endforeach; ?>
    </svg>
    <?php
    $chart_svg = ob_get_clean();
} else {
    $chart_svg = '<div style="text-align:center; padding: 2rem; color: #a0aec0;">No CGPA progression history available yet.</div>';
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
        grid-template-columns: 1fr 2.8fr;
        gap: 2rem;
    }
    .profile-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 1.5rem;
        align-self: start;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
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
        gap: 1.5rem;
    }
    .content-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 1.75rem;
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .content-card h3 {
        color: #1a365d;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 0.5rem;
        font-size: 1.15rem;
    }
    
    /* Academic Dashboard Styling */
    .academics-summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .acad-card {
        background: #f7fafc;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 1.25rem 1rem;
        text-align: center;
    }
    .acad-card h4 {
        font-size: 1.8rem;
        color: #1a365d;
        margin-bottom: 0.25rem;
        font-weight: 800;
    }
    .acad-card p {
        font-size: 0.8rem;
        font-weight: 600;
        color: #718096;
        text-transform: uppercase;
    }
    .semester-grade-block {
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    .semester-header {
        background: #edf2f7;
        padding: 0.75rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e2e8f0;
        font-weight: bold;
        color: #2d3748;
    }
    
    /* Tab System */
    .portal-tabs {
        display: flex;
        gap: 0.35rem;
        border-bottom: 2px solid #e2e8f0;
        margin-bottom: 1.5rem;
    }
    .portal-tab-btn {
        background: none;
        border: none;
        padding: 0.85rem 1.5rem;
        font-size: 0.95rem;
        font-weight: bold;
        color: #4a5568;
        cursor: pointer;
        border-radius: 6px 6px 0 0;
        transition: all 0.2s;
        border: 1px solid transparent;
        margin-bottom: -2px;
    }
    .portal-tab-btn:hover {
        color: #1a365d;
        background: #f7fafc;
    }
    .portal-tab-btn.active {
        color: #1a365d;
        background: #fff;
        border-color: #cbd5e0 #cbd5e0 #fff #cbd5e0;
        border-bottom-color: #fff;
    }
    .portal-tab-content {
        display: none;
    }
    .portal-tab-content.active {
        display: block;
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
    
    /* Academic tables formatting */
    table.acad-table {
        width: 100%;
        border-collapse: collapse;
    }
    table.acad-table th, table.acad-table td {
        padding: 0.65rem 1rem;
        text-align: left;
        border-bottom: 1px solid #edf2f7;
        font-size: 0.9rem;
    }
    table.acad-table th {
        background-color: #fafafa;
        color: #4a5568;
        font-weight: 600;
    }
    
    .badge-grade {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        font-weight: bold;
        border-radius: 3px;
        font-size: 0.8rem;
    }
    .grade-A { background-color: #c6f6d5; color: #22543d; }
    .grade-B { background-color: #ebf8ff; color: #2b6cb0; }
    .grade-C { background-color: #feebc8; color: #744210; }
    .grade-IP { background-color: #edf2f7; color: #4a5568; }

    @media (max-width: 900px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
        .academics-summary-grid {
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
                <span>Current Semester</span>
                <strong><?php echo htmlspecialchars($current_semester); ?></strong>
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

        <!-- Main Panel with Tabs -->
        <div class="main-panel">
            
            <!-- Tab Navigation Links -->
            <div class="portal-tabs">
                <button class="portal-tab-btn active" onclick="switchPortalTab(event, 'tabHome')">&#127968; Notice Board</button>
                <button class="portal-tab-btn" onclick="switchPortalTab(event, 'tabAcademics')">&#128202; Academic Record (CGPA)</button>
                <button class="portal-tab-btn" onclick="switchPortalTab(event, 'tabCourses')">&#128218; Enrolled Courses</button>
            </div>

            <!-- TAB 1: Notice Board & Downloads -->
            <div class="portal-tab-content active" id="tabHome">
                <!-- News & Announcements -->
                <div class="content-card" style="margin-bottom: 1.5rem;">
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

                <!-- Downloads Quick Access -->
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

            <!-- TAB 2: Academic Record & CGPA Graph -->
            <div class="portal-tab-content" id="tabAcademics">
                <div class="content-card">
                    <h3>Academic Dashboard</h3>
                    
                    <!-- Academics Summary statistics -->
                    <div class="academics-summary-grid">
                        <div class="acad-card">
                            <h4><?php echo number_format($final_cgpa, 2); ?></h4>
                            <p>Cumulative GPA (CGPA)</p>
                        </div>
                        <div class="acad-card">
                            <h4><?php echo $total_credits_earned; ?></h4>
                            <p>Credits Completed</p>
                        </div>
                        <div class="acad-card" style="border-top:3px solid #2b6cb0;">
                            <h4>Active</h4>
                            <p>Academic Status</p>
                        </div>
                    </div>
                    
                    <!-- CGPA Progress Graph -->
                    <div style="border: 1px solid #e2e8f0; border-radius: 6px; padding: 1.25rem; margin-bottom: 2rem; background: #fafafb;">
                        <h4 style="color:#1a365d; font-size: 1rem; margin-bottom: 1rem; text-align: center;">📈 Cumulative GPA Progression Chart</h4>
                        <div style="max-width: 500px; margin: 0 auto;">
                            <?php echo $chart_svg; ?>
                        </div>
                    </div>

                    <!-- Past Semesters Grade Sheets -->
                    <h4 style="color:#1a365d; margin-bottom: 1rem; font-size: 1.1rem;">Semesters Grade Sheet</h4>
                    
                    <?php 
                    // Loop through semesters and render grade tables
                    foreach ($semesters_data as $sem => $data):
                        // Skip empty or purely ongoing semesters in grade sheets
                        if ($data['credits_completed'] == 0) continue;
                    ?>
                        <div class="semester-grade-block">
                            <div class="semester-header">
                                <span>📁 <?php echo htmlspecialchars($sem); ?></span>
                                <span>GPA: <?php echo number_format($data['gpa'], 2); ?> | CGPA: <?php echo number_format($data['cumulative_cgpa'], 2); ?></span>
                            </div>
                            <table class="acad-table">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Course Title</th>
                                        <th>Credit Hours</th>
                                        <th>Grade</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['courses'] as $c): 
                                        if ($c['status'] !== 'Completed') continue; 
                                        $g_class = 'grade-' . substr($c['grade'], 0, 1);
                                    ?>
                                        <tr>
                                            <td><code><?php echo htmlspecialchars($c['course_code']); ?></code></td>
                                            <td><?php echo htmlspecialchars($c['course_title']); ?></td>
                                            <td><?php echo $c['credit_hours']; ?> Cr.</td>
                                            <td><span class="badge-grade <?php echo $g_class; ?>"><?php echo htmlspecialchars($c['grade']); ?></span></td>
                                            <td><?php echo number_format($c['credit_hours'] * $c['grade_point'], 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- TAB 3: Enrolled Courses -->
            <div class="portal-tab-content" id="tabCourses">
                <div class="content-card">
                    <h3>Current Enrolled Courses (<?php echo htmlspecialchars($current_semester); ?>)</h3>
                    <p style="color:#718096; font-size:0.88rem; margin-bottom:1.5rem;">
                        Below are the active courses you are registered for this semester. Ongoing study details, credits and final marks will update upon semester exam completion.
                    </p>

                    <table class="acad-table">
                        <thead>
                            <tr>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Credit Hours</th>
                                <th>Department</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $ongoing_found = false;
                            foreach ($student_grades as $c): 
                                // Show courses in the current semester or with status Ongoing
                                if ($c['semester'] === $current_semester || $c['status'] === 'Ongoing'):
                                    $ongoing_found = true;
                                    $status_label = ($c['status'] === 'Ongoing') ? 'In Progress' : 'Completed';
                                    $status_style = ($c['status'] === 'Ongoing') ? 'background:#feebc8; color:#744210;' : 'background:#c6f6d5; color:#22543d;';
                            ?>
                                <tr>
                                    <td><code><?php echo htmlspecialchars($c['course_code']); ?></code></td>
                                    <td><strong><?php echo htmlspecialchars($c['course_title']); ?></strong></td>
                                    <td><?php echo $c['credit_hours']; ?> Cr.</td>
                                    <td><?php echo htmlspecialchars($c['department'] ?? 'Information Technology'); ?></td>
                                    <td>
                                        <span class="badge-grade" style="<?php echo $status_style; ?> padding: 0.2rem 0.5rem; font-size:0.75rem;">
                                            <?php echo $status_label; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php 
                                endif;
                            endforeach; 
                            if (!$ongoing_found):
                            ?>
                                <tr>
                                    <td colspan="5" style="text-align:center; color:#a0aec0; padding:1.5rem;">No active course enrollments found for this semester.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function switchPortalTab(evt, tabId) {
        // Hide all tab contents
        const tabContents = document.querySelectorAll('.portal-tab-content');
        tabContents.forEach(content => {
            content.classList.remove('active');
        });

        // Deactivate all tab buttons
        const tabButtons = document.querySelectorAll('.portal-tab-btn');
        tabButtons.forEach(btn => {
            btn.classList.remove('active');
        });

        // Show selected tab content and add active class to button
        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }
</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
