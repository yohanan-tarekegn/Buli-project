<?php
session_start();
require_once __DIR__ . '/includes/db.php';

$login_error = '';

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
                    $_SESSION['student_id']   = $student['id'];
                    $_SESSION['student_name'] = $student['full_name'];

                    // Force password change on first login (OTP detected)
                    if (!empty($student['must_change_password'])) {
                        header('Location: change_password.php');
                    } else {
                        header('Location: student_portal.php');
                    }
                    exit;
                } else {
                    $login_error = 'Invalid email or password. Contact the Registrar if you have not received your credentials.';
                }
            } catch (\PDOException $e) {
                $login_error = 'Database error: ' . $e->getMessage();
            }
        } else {
            // Offline demo fallback
            if ($email === 'student@mgmbptc.edu.et' && $password === 'student123') {
                $_SESSION['student_id'] = 999;
                $_SESSION['student_name'] = 'Demo Student';
                header('Location: student_portal.php');
                exit;
            } else {
                $login_error = 'Invalid credentials. (Demo: student@mgmbptc.edu.et / student123)';
            }
        }
    } else {
        $login_error = 'Please fill in all fields.';
    }
}

$page_title = 'Student Portal Login';
require_once __DIR__ . '/includes/header.php';
?>

<style>
    .login-wrapper {
        max-width: 460px;
        margin: 4rem auto;
        padding: 0 1.5rem;
    }
    .login-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 2.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }
    .login-card h2 {
        color: #1a365d;
        font-size: 1.4rem;
        margin-bottom: 0.4rem;
        text-align: center;
    }
    .login-card .subtitle {
        color: #718096;
        font-size: 0.85rem;
        text-align: center;
        margin-bottom: 1.75rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
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
    .form-control-login {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 4px;
        font-size: 0.95rem;
        font-family: inherit;
    }
    .form-control-login:focus {
        outline: none;
        border-color: #1a365d;
    }
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
    .btn-login:hover {
        background-color: #2b6cb0;
    }
    .login-alert {
        padding: 0.75rem;
        border-radius: 4px;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
        background-color: #fed7d7;
        color: #742a2a;
        border: 1px solid #feb2b2;
    }
    .info-notice {
        background: #ebf8ff;
        border: 1px solid #bee3f8;
        color: #2a69ac;
        border-radius: 4px;
        padding: 0.85rem 1rem;
        margin-top: 1.5rem;
        font-size: 0.85rem;
        line-height: 1.6;
        text-align: center;
    }
    .info-notice strong {
        display: block;
        margin-bottom: 0.25rem;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h2>&#127891; Student Portal Login</h2>
        <p class="subtitle">Major General Mulugeta Buli Polytechnic College</p>

        <?php if ($login_error): ?>
            <div class="login-alert"><?php echo htmlspecialchars($login_error); ?></div>
        <?php endif; ?>

        <form method="POST" action="student_login.php">
            <div class="form-group">
                <label for="loginEmail">Student Email Address</label>
                <input type="email" id="loginEmail" name="email" class="form-control-login"
                       placeholder="yourname@mgmbptc.edu.et" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name="password" class="form-control-login"
                       placeholder="••••••••" required>
            </div>
            <button type="submit" name="login_submit" class="btn-login">Sign In to Portal</button>
        </form>

        <div class="info-notice">
            <strong>&#8505; Don't have an account?</strong>
            Student portal accounts are issued by the college Registrar's Office upon successful enrollment.
            Contact the Registrar or visit the <a href="contact.php">Contact page</a> for assistance.
        </div>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
