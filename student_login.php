<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$login_error = '';
$register_error = '';
$register_success = '';

// Handle Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM students WHERE email = :email");
                $stmt->execute([':email' => $email]);
                $student = $stmt->fetch();

                if ($student && password_verify($password, $student['password_hash'])) {
                    $_SESSION['student_id'] = $student['id'];
                    $_SESSION['student_name'] = $student['full_name'];
                    header('Location: student_portal.php');
                    exit;
                } else {
                    $login_error = 'Invalid email or password.';
                }
            } catch (\PDOException $e) {
                $login_error = 'Database error during login: ' . $e->getMessage();
            }
        } else {
            // Simulated login for offline fallback demo
            if ($email === 'student@example.com' && $password === 'student123') {
                $_SESSION['student_id'] = 999;
                $_SESSION['student_name'] = 'Demo Student';
                header('Location: student_portal.php');
                exit;
            } else {
                $login_error = '[Demo Mode] Use student@example.com / student123 to log in.';
            }
        }
    } else {
        $login_error = 'Please fill in all fields.';
    }
}

// Handle Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    $fullname = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $dept = $_POST['department'] ?? '';
    $student_id = trim($_POST['student_id_no'] ?? '');

    if (!empty($fullname) && !empty($email) && !empty($password) && !empty($dept)) {
        if ($pdo) {
            try {
                // Check if email already registered
                $stmt = $pdo->prepare("SELECT id FROM students WHERE email = :email");
                $stmt->execute([':email' => $email]);
                if ($stmt->fetch()) {
                    $register_error = 'Email address is already registered.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO students (full_name, email, password_hash, department, student_id_no, status) VALUES (:fullname, :email, :hash, :dept, :student_id, 'Active')");
                    $stmt->execute([
                        ':fullname' => $fullname,
                        ':email' => $email,
                        ':hash' => $hash,
                        ':dept' => $dept,
                        ':student_id' => $student_id
                    ]);
                    $register_success = 'Account created successfully! You can now log in below.';
                }
            } catch (\PDOException $e) {
                $register_error = 'Database error: ' . $e->getMessage();
            }
        } else {
            $register_success = '[Demo Mode] Registration successful! (Simulated)';
        }
    } else {
        $register_error = 'Please fill in all required fields.';
    }
}

$page_title = 'Student Portal Login';
require_once __DIR__ . '/includes/header.php';
?>


<style>
    .portal-container {
        max-width: 900px;
        margin: 2rem auto;
        padding: 0 1.5rem;
    }
    .portal-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
    }
    .portal-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .portal-card h3 {
        color: #1a365d;
        margin-bottom: 1.25rem;
        border-bottom: 2px solid #1a365d;
        padding-bottom: 0.5rem;
        font-size: 1.2rem;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        font-size: 0.9rem;
        color: #2d3748;
    }
    .form-control-portal {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 4px;
        font-size: 0.95rem;
    }
    .form-control-portal:focus {
        outline: none;
        border-color: #1a365d;
    }
    .btn-portal {
        width: 100%;
        padding: 0.75rem;
        background-color: #1a365d;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
    }
    .btn-portal:hover {
        background-color: #2b6cb0;
    }
    .portal-alert {
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
    }
    .portal-alert-error {
        background-color: #fed7d7;
        color: #742a2a;
        border: 1px solid #feb2b2;
    }
    .portal-alert-success {
        background-color: #c6f6d5;
        color: #22543d;
        border: 1px solid #9ae6b4;
    }
    @media (max-width: 768px) {
        .portal-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="portal-container">
    <div class="page-header" style="text-align: center; margin-bottom: 2rem;">
        <h2>Student Portal Access</h2>
        <p style="color: #718096; margin-top: 0.5rem;">Access your academic resources, college updates, and profile.</p>
    </div>

    <div class="portal-grid">
        <!-- Login Card -->
        <div class="portal-card">
            <h3>Student Sign In</h3>
            
            <?php if ($login_error): ?>
                <div class="portal-alert portal-alert-error"><?php echo htmlspecialchars($login_error); ?></div>
            <?php endif; ?>

            <form method="POST" action="student_login.php">
                <div class="form-group">
                    <label for="loginEmail">Email Address</label>
                    <input type="email" id="loginEmail" name="email" class="form-control-portal" placeholder="student@example.com" required>
                </div>
                <div class="form-group">
                    <label for="loginPassword">Password</label>
                    <input type="password" id="loginPassword" name="password" class="form-control-portal" placeholder="••••••••" required>
                </div>
                <button type="submit" name="login_submit" class="btn-portal">Log In</button>
            </form>
            <p style="font-size: 0.85rem; color: #718096; margin-top: 1.5rem; text-align: center;">
                For testing offline: Use <strong>student@example.com</strong> / <strong>student123</strong>
            </p>
        </div>

        <!-- Registration Card -->
        <div class="portal-card">
            <h3>Create Student Account</h3>

            <?php if ($register_error): ?>
                <div class="portal-alert portal-alert-error"><?php echo htmlspecialchars($register_error); ?></div>
            <?php endif; ?>
            <?php if ($register_success): ?>
                <div class="portal-alert portal-alert-success"><?php echo htmlspecialchars($register_success); ?></div>
            <?php endif; ?>

            <form method="POST" action="student_login.php">
                <div class="form-group">
                    <label for="regName">Full Name *</label>
                    <input type="text" id="regName" name="full_name" class="form-control-portal" placeholder="Abebe Kebede" required>
                </div>
                <div class="form-group">
                    <label for="regEmail">Email Address *</label>
                    <input type="email" id="regEmail" name="email" class="form-control-portal" placeholder="abebe@example.com" required>
                </div>
                <div class="form-group">
                    <label for="regPassword">Password *</label>
                    <input type="password" id="regPassword" name="password" class="form-control-portal" placeholder="Min 6 characters" required>
                </div>
                <div class="form-group">
                    <label for="regDept">Department *</label>
                    <select id="regDept" name="department" class="form-control-portal" required>
                        <option value="">-- Select Department --</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Automotive Technology">Automotive Technology</option>
                        <option value="Electrical & Electronics">Electrical & Electronics</option>
                        <option value="Manufacturing & Mechanical">Manufacturing & Mechanical</option>
                        <option value="Construction & Civil Technology">Construction & Civil Technology</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="regID">Student ID / Ref Number (Optional)</label>
                    <input type="text" id="regID" name="student_id_no" class="form-control-portal" placeholder="MGMB/1024/18">
                </div>
                <button type="submit" name="register_submit" class="btn-portal">Register Account</button>
            </form>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
