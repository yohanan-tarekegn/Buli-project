<?php
session_start();

// Admin credentials (change these to your preferred values)
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'buliadmin123');

// Connect to database
require_once __DIR__ . '/includes/db.php';

$login_error = '';

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Handle login POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $input_user = $_POST['username'] ?? '';
    $input_pass = $_POST['password'] ?? '';
    if ($input_user === ADMIN_USER && $input_pass === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $login_error = 'Invalid username or password.';
    }
}

// Handle application status update (Approve / Reject) — auto-creates student account on Approval
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status']) && isset($_SESSION['admin_logged_in'])) {
    $id     = (int)($_POST['record_id'] ?? 0);
    $status = $_POST['new_status'] ?? '';
    if ($id > 0 && in_array($status, ['Approved', 'Rejected'])) {
        $stmt = $pdo->prepare("UPDATE admissions SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $status, ':id' => $id]);

        // === AUTO-CREATE STUDENT PORTAL ACCOUNT ON APPROVAL ===
        if ($status === 'Approved' && $pdo) {
            $adm = $pdo->prepare("SELECT * FROM admissions WHERE id = :id");
            $adm->execute([':id' => $id]);
            $admission = $adm->fetch();

            if ($admission) {
                // Check account doesn't already exist
                $chk = $pdo->prepare("SELECT id FROM students WHERE email = :email");
                $chk->execute([':email' => $admission['email']]);
                if (!$chk->fetch()) {
                    // Generate sequential Student ID: MGMB/YYYY/NNNN
                    $count = (int)$pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
                    $student_id_no = 'MGMB/' . date('Y') . '/' . str_pad($count + 1, 4, '0', STR_PAD_LEFT);

                    // Generate secure 8-char OTP (no ambiguous chars)
                    $charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                    $otp = '';
                    for ($i = 0; $i < 8; $i++) {
                        $otp .= $charset[random_int(0, strlen($charset) - 1)];
                    }

                    $hash = password_hash($otp, PASSWORD_DEFAULT);

                    $ins = $pdo->prepare(
                        "INSERT INTO students (full_name, email, password_hash, department, student_id_no, status, must_change_password, admission_ref_id)
                         VALUES (:name, :email, :hash, :dept, :sid, 'Active', 1, :ref_id)"
                    );
                    $ins->execute([
                        ':name'   => $admission['full_name'],
                        ':email'  => $admission['email'],
                        ':hash'   => $hash,
                        ':dept'   => $admission['department'],
                        ':sid'    => $student_id_no,
                        ':ref_id' => $admission['id']
                    ]);

                    // Store credentials in session flash for one-time display
                    $_SESSION['new_student_credentials'] = [
                        'name'       => $admission['full_name'],
                        'email'      => $admission['email'],
                        'department' => $admission['department'],
                        'student_id' => $student_id_no,
                        'otp'        => $otp
                    ];
                }
            }
        }
    }
    header('Location: admin.php?tab=students');
    exit;
}

// Handle Reset Password (regenerate OTP for a student)
$reset_msg  = '';
$reset_type = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_student_password']) && isset($_SESSION['admin_logged_in'])) {
    $id = (int)($_POST['account_id'] ?? 0);
    if ($id > 0 && $pdo) {
        try {
            // Fetch student so we can return their name
            $s = $pdo->prepare("SELECT full_name, email FROM students WHERE id = :id");
            $s->execute([':id' => $id]);
            $stu = $s->fetch();

            if ($stu) {
                $charset = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
                $otp = '';
                for ($i = 0; $i < 8; $i++) {
                    $otp .= $charset[random_int(0, strlen($charset) - 1)];
                }
                $hash = password_hash($otp, PASSWORD_DEFAULT);
                $upd = $pdo->prepare("UPDATE students SET password_hash = :hash, must_change_password = 1 WHERE id = :id");
                $upd->execute([':hash' => $hash, ':id' => $id]);

                // Flash new credentials via session
                $_SESSION['new_student_credentials'] = [
                    'name'       => $stu['full_name'],
                    'email'      => $stu['email'],
                    'department' => '',
                    'student_id' => '',
                    'otp'        => $otp,
                    'is_reset'   => true
                ];
            }
        } catch (\PDOException $e) {
            // silently ignore
        }
    }
    header('Location: admin.php?tab=accounts');
    exit;
}

// Handle delete student portal account
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student_account']) && isset($_SESSION['admin_logged_in'])) {
    $id = (int)($_POST['account_id'] ?? 0);
    if ($id > 0 && $pdo) {
        $pdo->prepare("DELETE FROM students WHERE id = :id")->execute([':id' => $id]);
    }
    header('Location: admin.php?tab=accounts');
    exit;
}

// Handle delete (admissions)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_admission']) && isset($_SESSION['admin_logged_in'])) {
    $id = (int)($_POST['record_id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM admissions WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    header('Location: admin.php?tab=students');
    exit;
}

// Handle delete (contact messages)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_message']) && isset($_SESSION['admin_logged_in'])) {
    $id = (int)($_POST['record_id'] ?? 0);
    if ($id > 0) {
        $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
    header('Location: admin.php?tab=messages');
    exit;
}

// If not logged in, show login page
if (!isset($_SESSION['admin_logged_in'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | MGMBPTC</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #edf2f7;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-card {
            background: #fff;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
        }
        .login-card h1 {
            color: #1a365d;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        .login-card p.subtitle {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 1.75rem;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 1rem;
        }
        .form-group { margin-bottom: 1.25rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.4rem;
            color: #2d3748;
            font-size: 0.9rem;
        }
        .form-group input {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #cbd5e0;
            border-radius: 4px;
            font-size: 0.95rem;
        }
        .form-group input:focus { outline: none; border-color: #1a365d; }
        .btn-login {
            width: 100%;
            padding: 0.75rem;
            background-color: #1a365d;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 0.5rem;
        }
        .btn-login:hover { background-color: #2b6cb0; }
        .error-msg {
            background-color: #fed7d7;
            color: #742a2a;
            border: 1px solid #feb2b2;
            padding: 0.75rem;
            border-radius: 4px;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.25rem;
            font-size: 0.85rem;
            color: #718096;
        }
        .back-link a { color: #1a365d; }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Admin Panel Login</h1>
        <p class="subtitle">Major General Mulugeta Buli Polytechnic College</p>

        <?php if ($login_error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($login_error); ?></div>
        <?php endif; ?>

        <form method="POST" action="admin.php">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="admin" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login_submit" class="btn-login">Log In</button>
        </form>
        <p class="back-link"><a href="index.php">&larr; Back to Website</a></p>
    </div>
</body>
</html>
<?php
    exit;
}

// Logged in — Fetch data
$active_tab = $_GET['tab'] ?? 'students';

$students = [];
$messages = [];
$accounts = [];
$summary  = [];

if ($pdo) {
    $students = $pdo->query("SELECT * FROM admissions ORDER BY created_at DESC")->fetchAll();
    $messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
    $accounts = $pdo->query("SELECT id, full_name, email, department, student_id_no, status, created_at FROM students ORDER BY created_at DESC")->fetchAll();

    $summary['total_students']  = $pdo->query("SELECT COUNT(*) FROM admissions")->fetchColumn();
    $summary['pending']         = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Pending'")->fetchColumn();
    $summary['approved']        = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Approved'")->fetchColumn();
    $summary['rejected']        = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Rejected'")->fetchColumn();
    $summary['total_messages']  = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
    $summary['total_accounts']  = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | MGMBPTC</title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background-color: #edf2f7;
            color: #2d3748;
        }

        /* -- Top Admin Bar -- */
        .admin-bar {
            background-color: #1a365d;
            color: #fff;
            padding: 0.85rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid #d69e2e;
        }
        .admin-bar h1 { font-size: 1.2rem; }
        .admin-bar .bar-right { display: flex; align-items: center; gap: 1.5rem; font-size: 0.9rem; }
        .admin-bar a { color: #cbd5e0; text-decoration: none; }
        .admin-bar a:hover { color: #d69e2e; }
        .logout-btn {
            background-color: #e53e3e;
            color: #fff;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: bold;
            text-decoration: none;
        }
        .logout-btn:hover { background-color: #c53030; color: #fff; }

        /* -- Main Container -- */
        .admin-container { max-width: 1200px; margin: 2rem auto; padding: 0 1.5rem; }

        /* -- Summary Cards -- */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        /* Account form */
        .acct-form { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem; }
        .acct-form .full-width { grid-column: 1 / -1; }
        .acct-form label { display: block; font-size: 0.85rem; font-weight:600; color:#2d3748; margin-bottom:0.3rem; }
        .acct-form input, .acct-form select { width:100%; padding:0.6rem 0.75rem; border:1px solid #cbd5e0; border-radius:4px; font-size:0.9rem; font-family:inherit; }
        .acct-form input:focus, .acct-form select:focus { outline:none; border-color:#1a365d; }
        .btn-create { background:#1a365d; color:#fff; padding:0.65rem 1.5rem; border:none; border-radius:4px; font-weight:bold; cursor:pointer; font-size:0.9rem; }
        .btn-create:hover { background:#2b6cb0; }
        .acct-alert { padding:0.75rem 1rem; border-radius:4px; margin-bottom:1.25rem; font-size:0.9rem; }
        .acct-alert-success { background:#c6f6d5; color:#22543d; border:1px solid #9ae6b4; }
        .acct-alert-error { background:#fed7d7; color:#742a2a; border:1px solid #feb2b2; }
        .summary-card {
            background: #fff;
            border: 1px solid #cbd5e0;
            border-radius: 6px;
            padding: 1.25rem;
            text-align: center;
        }
        .summary-card h2 { font-size: 2rem; color: #1a365d; }
        .summary-card p { font-size: 0.85rem; color: #718096; margin-top: 0.25rem; }
        .summary-card.pending h2 { color: #d69e2e; }
        .summary-card.approved h2 { color: #2f855a; }
        .summary-card.rejected h2 { color: #c53030; }

        /* -- Tabs -- */
        .tabs { display: flex; gap: 0; border-bottom: 2px solid #cbd5e0; margin-bottom: 1.5rem; }
        .tab-btn {
            padding: 0.75rem 1.75rem;
            border: 1px solid #cbd5e0;
            border-bottom: none;
            background: #edf2f7;
            color: #4a5568;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            text-decoration: none;
            border-radius: 4px 4px 0 0;
            margin-right: 4px;
        }
        .tab-btn.active {
            background: #fff;
            color: #1a365d;
            border-bottom: 2px solid #fff;
            margin-bottom: -2px;
        }
        .tab-btn:hover { background: #fff; color: #1a365d; }

        /* -- Table Panel -- */
        .panel {
            background: #fff;
            border: 1px solid #cbd5e0;
            border-radius: 0 6px 6px 6px;
            padding: 1.5rem;
        }
        .panel h3 {
            font-size: 1.1rem;
            color: #1a365d;
            margin-bottom: 1.25rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #1a365d;
        }
        .empty-msg {
            text-align: center;
            padding: 3rem;
            color: #718096;
            font-style: italic;
        }

        /* -- Data Table -- */
        table { width: 100%; border-collapse: collapse; font-size: 0.875rem; }
        th {
            background-color: #edf2f7;
            color: #1a365d;
            padding: 0.65rem 0.85rem;
            border: 1px solid #cbd5e0;
            text-align: left;
            font-weight: 700;
        }
        td {
            padding: 0.65rem 0.85rem;
            border: 1px solid #e2e8f0;
            vertical-align: middle;
        }
        tr:nth-child(even) td { background-color: #f7fafc; }
        tr:hover td { background-color: #ebf8ff; }

        /* -- Status Badges -- */
        .badge {
            display: inline-block;
            padding: 0.2rem 0.65rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .badge-pending  { background: #fefcbf; color: #744210; }
        .badge-approved { background: #c6f6d5; color: #22543d; }
        .badge-rejected { background: #fed7d7; color: #742a2a; }

        /* -- Action Buttons -- */
        .action-btns { display: flex; gap: 0.4rem; flex-wrap: wrap; }
        .btn-sm {
            padding: 0.3rem 0.7rem;
            font-size: 0.8rem;
            font-weight: bold;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-approve { background: #c6f6d5; color: #22543d; }
        .btn-approve:hover { background: #9ae6b4; }
        .btn-reject  { background: #fefcbf; color: #744210; }
        .btn-reject:hover  { background: #f6e05e; }
        .btn-delete  { background: #fed7d7; color: #742a2a; }
        .btn-delete:hover  { background: #feb2b2; }

        @media (max-width: 900px) {
            .summary-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 600px) {
            .summary-grid { grid-template-columns: 1fr 1fr; }
            .admin-bar { flex-direction: column; gap: 0.75rem; }
        }
        /* === Credential Card === */
        .cred-card {
            background: #f0fff4;
            border: 2px solid #48bb78;
            border-radius: 8px;
            padding: 1.5rem 2rem;
            margin-bottom: 2rem;
        }
        .cred-card h3 { color: #276749; font-size: 1.15rem; margin-bottom: 0.5rem; }
        .cred-card p  { color: #2f855a; font-size: 0.9rem; margin-bottom: 1.25rem; }
        .cred-table { width: 100%; border-collapse: collapse; margin-bottom: 1.25rem; }
        .cred-table td { padding: 0.6rem 0.85rem; border: 1px solid #9ae6b4; font-size: 0.95rem; }
        .cred-table td:first-child { font-weight: bold; color: #276749; width: 180px; background: #c6f6d5; }
        .cred-otp { font-size: 1.4rem; font-weight: bold; letter-spacing: 0.2rem; color: #22543d; font-family: monospace; }
        .cred-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-print { background:#276749; color:#fff; border:none; padding:0.5rem 1.25rem; border-radius:4px; cursor:pointer; font-weight:bold; font-size:0.9rem; }
        .btn-print:hover { background:#2f855a; }
        .cred-warning { background:#fefcbf; border:1px solid #f6e05e; border-radius:4px; padding:0.6rem 1rem; font-size:0.85rem; color:#744210; margin-top:1rem; }
    </style>
</head>
<body>

<!-- Admin Top Bar -->
<div class="admin-bar">
    <h1>&#9998; MGMBPTC Admin Panel</h1>
    <div class="bar-right">
        <span>Logged in as: <strong>admin</strong></span>
        <a href="index.php">&#8592; View Website</a>
        <a href="admin.php?action=logout" class="logout-btn">Log Out</a>
    </div>
</div>

<div class="admin-container">

    <?php
    // === SHOW CREDENTIAL CARD (one-time session flash) ===
    if (isset($_SESSION['new_student_credentials'])):
        $cred = $_SESSION['new_student_credentials'];
        unset($_SESSION['new_student_credentials']); // Show only once
    ?>
    <div class="cred-card" id="credCard">
        <?php if (!empty($cred['is_reset'])): ?>
            <h3>&#128273; Student Password Reset Successfully</h3>
            <p>A new One-Time Password (OTP) has been generated. <strong>Share this with the student immediately</strong> — the OTP is shown only once.</p>
        <?php else: ?>
            <h3>&#10003; Student Account Auto-Created Successfully</h3>
            <p>The following login credentials were generated. <strong>Share these with the student immediately</strong> — the OTP is shown only once.</p>
        <?php endif; ?>
        <table class="cred-table">
            <tr><td>Full Name</td><td><?php echo htmlspecialchars($cred['name']); ?></td></tr>
            <?php if (!empty($cred['department'])): ?>
                <tr><td>Department</td><td><?php echo htmlspecialchars($cred['department']); ?></td></tr>
            <?php endif; ?>
            <?php if (!empty($cred['student_id'])): ?>
                <tr><td>Student ID</td><td><strong><?php echo htmlspecialchars($cred['student_id']); ?></strong></td></tr>
            <?php endif; ?>
            <tr><td>Login Email</td><td><?php echo htmlspecialchars($cred['email']); ?></td></tr>
            <tr><td>One-Time Password</td><td><span class="cred-otp"><?php echo htmlspecialchars($cred['otp']); ?></span></td></tr>
        </table>
        <div class="cred-warning">
            &#9888; The student will be forced to change this password on their next login.
        </div>
        <div class="cred-actions" style="margin-top:1rem;">
            <button class="btn-print" onclick="window.print()">&#128438; Print / Save Credentials</button>
        </div>
    </div>
    <?php endif; ?>

    <!-- Summary Cards -->
    <div class="summary-grid">
        <div class="summary-card">
            <h2><?php echo $summary['total_students']; ?></h2>
            <p>Total Applicants</p>
        </div>
        <div class="summary-card pending">
            <h2><?php echo $summary['pending']; ?></h2>
            <p>Pending</p>
        </div>
        <div class="summary-card approved">
            <h2><?php echo $summary['approved']; ?></h2>
            <p>Approved</p>
        </div>
        <div class="summary-card rejected">
            <h2><?php echo $summary['rejected']; ?></h2>
            <p>Rejected</p>
        </div>
        <div class="summary-card">
            <h2><?php echo $summary['total_messages']; ?></h2>
            <p>Messages</p>
        </div>
        <div class="summary-card" style="border-top:3px solid #1a365d;">
            <h2 style="color:#1a365d;"><?php echo $summary['total_accounts'] ?? 0; ?></h2>
            <p>Student Accounts</p>
        </div>
    </div>

    <!-- Tab Switcher -->
    <div class="tabs">
        <a href="admin.php?tab=students" class="tab-btn <?php echo $active_tab === 'students' ? 'active' : ''; ?>">
            &#127891; Applications (<?php echo $summary['total_students']; ?>)
        </a>
        <a href="admin.php?tab=messages" class="tab-btn <?php echo $active_tab === 'messages' ? 'active' : ''; ?>">
            &#128140; Messages (<?php echo $summary['total_messages']; ?>)
        </a>
        <a href="admin.php?tab=accounts" class="tab-btn <?php echo $active_tab === 'accounts' ? 'active' : ''; ?>">
            &#128273; Student Accounts (<?php echo $summary['total_accounts'] ?? 0; ?>)
        </a>
    </div>

    <!-- Panel Content -->
    <div class="panel">

        <?php if ($active_tab === 'students'): ?>

            <h3>Student Application Records</h3>

            <?php if (empty($students)): ?>
                <div class="empty-msg">
                    No student applications have been received yet.<br>
                    Applications submitted through the <a href="admission.php">Admissions page</a> will appear here.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Contact Info</th>
                            <th>Program / Department</th>
                            <th>Study Mode</th>
                            <th>Uploaded Scans</th>
                            <th>Applied On</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $s): ?>
                            <tr>
                                <td><?php echo $s['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($s['full_name']); ?></strong></td>
                                <td style="font-size: 0.85rem; line-height: 1.4;">
                                    📧 <?php echo htmlspecialchars($s['email']); ?><br>
                                    📞 <?php echo htmlspecialchars($s['phone']); ?>
                                </td>
                                <td style="font-size: 0.85rem; line-height: 1.4;">
                                    <strong><?php echo htmlspecialchars($s['department']); ?></strong><br>
                                    <span style="color: #718096; font-size: 0.8rem;"><?php echo htmlspecialchars($s['program_type'] ?? 'TVET'); ?></span>
                                </td>
                                <td>
                                    <span class="badge" style="background:#edf2f7; color:#2d3748;">
                                        <?php echo htmlspecialchars($s['program_mode'] ?? 'Regular'); ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display: flex; flex-direction: column; gap: 4px;">
                                        <?php if (!empty($s['file_transcript'])): ?>
                                            <a href="<?php echo htmlspecialchars($s['file_transcript']); ?>" target="_blank" class="btn-sm btn-approve" style="text-decoration:none; font-size:0.75rem; text-align:center; display:block;">📄 Transcript</a>
                                        <?php else: ?>
                                            <span style="color:#a0aec0; font-size:0.75rem;">No Transcript</span>
                                        <?php endif; ?>

                                        <?php if (!empty($s['file_id_card'])): ?>
                                            <a href="<?php echo htmlspecialchars($s['file_id_card']); ?>" target="_blank" class="btn-sm btn-reject" style="text-decoration:none; font-size:0.75rem; text-align:center; display:block; background:#e2e8f0; color:#4a5568;">🪪 ID Card</a>
                                        <?php else: ?>
                                            <span style="color:#a0aec0; font-size:0.75rem;">No ID Card</span>
                                        <?php endif; ?>

                                        <?php if (!empty($s['file_photo'])): ?>
                                            <a href="<?php echo htmlspecialchars($s['file_photo']); ?>" target="_blank" class="btn-sm" style="text-decoration:none; font-size:0.75rem; text-align:center; display:block; background:#ebf8ff; color:#2b6cb0;">👤 Photo</a>
                                        <?php else: ?>
                                            <span style="color:#a0aec0; font-size:0.75rem;">No Photo</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td><?php echo date('d M Y, H:i', strtotime($s['created_at'])); ?></td>
                                <td>
                                    <?php
                                        $badge_class = match($s['status']) {
                                            'Approved' => 'badge-approved',
                                            'Rejected' => 'badge-rejected',
                                            default    => 'badge-pending'
                                        };
                                    ?>
                                    <span class="badge <?php echo $badge_class; ?>">
                                        <?php echo htmlspecialchars($s['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-btns">
                                        <?php if ($s['status'] !== 'Approved'): ?>
                                            <form method="POST">
                                                <input type="hidden" name="record_id" value="<?php echo $s['id']; ?>">
                                                <input type="hidden" name="new_status" value="Approved">
                                                <button type="submit" name="update_status" class="btn-sm btn-approve">Approve</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if ($s['status'] !== 'Rejected'): ?>
                                            <form method="POST">
                                                <input type="hidden" name="record_id" value="<?php echo $s['id']; ?>">
                                                <input type="hidden" name="new_status" value="Rejected">
                                                <button type="submit" name="update_status" class="btn-sm btn-reject">Reject</button>
                                            </form>
                                        <?php endif; ?>
                                        <form method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this record?');">
                                            <input type="hidden" name="record_id" value="<?php echo $s['id']; ?>">
                                            <button type="submit" name="delete_admission" class="btn-sm btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        <?php elseif ($active_tab === 'messages'): ?>

            <h3>Contact Message Inbox</h3>

            <?php if (empty($messages)): ?>
                <div class="empty-msg">
                    No contact messages have been received yet.<br>
                    Messages submitted through the <a href="contact.php">Contact page</a> will appear here.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Received On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $m): ?>
                            <tr>
                                <td><?php echo $m['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($m['name']); ?></strong></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($m['email']); ?>"><?php echo htmlspecialchars($m['email']); ?></a></td>
                                <td><?php echo htmlspecialchars($m['subject'] ?: '—'); ?></td>
                                <td style="max-width: 300px;">
                                    <?php 
                                        $msg = $m['message'];
                                        echo htmlspecialchars(strlen($msg) > 100 ? substr($msg, 0, 97) . '...' : $msg);
                                    ?>
                                </td>
                                <td><?php echo date('d M Y, H:i', strtotime($m['created_at'])); ?></td>
                                <td>
                                    <form method="POST" onsubmit="return confirm('Delete this message permanently?');">
                                        <input type="hidden" name="record_id" value="<?php echo $m['id']; ?>">
                                        <button type="submit" name="delete_message" class="btn-sm btn-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        <?php elseif ($active_tab === 'accounts'): ?>

            <h3>&#128273; Student Portal Accounts</h3>
            <p style="color:#4a5568; font-size:0.9rem; margin-bottom:1.5rem;">
                Accounts are <strong>automatically created</strong> when you approve an application in the Applications tab.
                From here you can view all accounts, reset a student's password, or delete an account.
            </p>

            <!-- Credential card re-uses the same session flash used by auto-creation -->

            <!-- Existing Accounts Table -->
            <?php if (empty($accounts)): ?>
                <div class="empty-msg">
                    No student portal accounts yet. Approve an application in the
                    <a href="admin.php?tab=students">Applications tab</a> to create one automatically.
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Full Name</th>
                            <th>Email (Login)</th>
                            <th>Department</th>
                            <th>OTP?</th>
                            <th>Enrolled</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($accounts as $a): ?>
                            <tr>
                                <td><?php echo $a['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($a['student_id_no'] ?: '—'); ?></strong></td>
                                <td><?php echo htmlspecialchars($a['full_name']); ?></td>
                                <td><?php echo htmlspecialchars($a['email']); ?></td>
                                <td><?php echo htmlspecialchars($a['department']); ?></td>
                                <td>
                                    <?php if (!empty($a['must_change_password'])): ?>
                                        <span class="badge badge-pending" title="Student has not changed their OTP yet">Pending</span>
                                    <?php else: ?>
                                        <span class="badge badge-approved">Changed</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo date('d M Y', strtotime($a['created_at'])); ?></td>
                                <td>
                                    <div class="action-btns">
                                        <form method="POST" onsubmit="return confirm('Reset password for <?php echo addslashes($a['full_name']); ?>? A new OTP will be generated.')">
                                            <input type="hidden" name="account_id" value="<?php echo $a['id']; ?>">
                                            <button type="submit" name="reset_student_password" class="btn-sm btn-approve">Reset OTP</button>
                                        </form>
                                        <form method="POST" onsubmit="return confirm('Permanently delete this student account?');">
                                            <input type="hidden" name="account_id" value="<?php echo $a['id']; ?>">
                                            <button type="submit" name="delete_student_account" class="btn-sm btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

        <?php endif; ?>

    </div><!-- end panel -->
</div><!-- end admin-container -->

</body>
</html>
