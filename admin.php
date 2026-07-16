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

// Handle application status update (Approve / Reject)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status']) && isset($_SESSION['admin_logged_in'])) {
    $id     = (int)($_POST['record_id'] ?? 0);
    $status = $_POST['new_status'] ?? '';
    if ($id > 0 && in_array($status, ['Approved', 'Rejected'])) {
        $stmt = $pdo->prepare("UPDATE admissions SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $status, ':id' => $id]);
    }
    header('Location: admin.php?tab=students');
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
$summary  = [];

if ($pdo) {
    $students = $pdo->query("SELECT * FROM admissions ORDER BY created_at DESC")->fetchAll();
    $messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();

    $summary['total_students']  = $pdo->query("SELECT COUNT(*) FROM admissions")->fetchColumn();
    $summary['pending']         = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Pending'")->fetchColumn();
    $summary['approved']        = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Approved'")->fetchColumn();
    $summary['rejected']        = $pdo->query("SELECT COUNT(*) FROM admissions WHERE status='Rejected'")->fetchColumn();
    $summary['total_messages']  = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
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
            grid-template-columns: repeat(5, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
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
    </div>

    <!-- Tab Switcher -->
    <div class="tabs">
        <a href="admin.php?tab=students" class="tab-btn <?php echo $active_tab === 'students' ? 'active' : ''; ?>">
            &#127891; Registered Students (<?php echo $summary['total_students']; ?>)
        </a>
        <a href="admin.php?tab=messages" class="tab-btn <?php echo $active_tab === 'messages' ? 'active' : ''; ?>">
            &#128140; Contact Messages (<?php echo $summary['total_messages']; ?>)
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
                            <th>Email Address</th>
                            <th>Phone Number</th>
                            <th>Department</th>
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
                                <td><?php echo htmlspecialchars($s['email']); ?></td>
                                <td><?php echo htmlspecialchars($s['phone']); ?></td>
                                <td><?php echo htmlspecialchars($s['department']); ?></td>
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

        <?php else: ?>

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

        <?php endif; ?>

    </div><!-- end panel -->
</div><!-- end admin-container -->

</body>
</html>
