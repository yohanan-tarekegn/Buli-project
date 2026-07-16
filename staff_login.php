<?php
session_start();
$page_title = 'Staff & Admin Login';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("SELECT * FROM staff WHERE email = :email");
                $stmt->execute([':email' => $email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password_hash'])) {
                    if ($user['role'] === 'admin') {
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_name'] = $user['full_name'];
                        header('Location: admin.php');
                        exit;
                    } else {
                        $_SESSION['staff_logged_in'] = true;
                        $_SESSION['staff_id'] = $user['id'];
                        $_SESSION['staff_name'] = $user['full_name'];
                        $_SESSION['staff_dept'] = $user['department'];
                        header('Location: staff_portal.php');
                        exit;
                    }
                } else {
                    $login_error = 'Invalid email or password.';
                }
            } catch (\PDOException $e) {
                $login_error = 'Database error: ' . $e->getMessage();
            }
        } else {
            // Simulated login fallback (Offline demo)
            if ($email === 'admin@mgmbptc.edu.et' && $password === 'buliadmin123') {
                $_SESSION['admin_logged_in'] = true;
                header('Location: admin.php');
                exit;
            } elseif ($email === 'tsegaye@mgmbptc.edu.et' && $password === 'staff123') {
                $_SESSION['staff_logged_in'] = true;
                $_SESSION['staff_id'] = 2;
                $_SESSION['staff_name'] = 'Tsegaye Mengistu';
                $_SESSION['staff_dept'] = 'Information Technology';
                header('Location: staff_portal.php');
                exit;
            } else {
                $login_error = '[Demo Mode] Admin: admin@mgmbptc.edu.et / buliadmin123, Staff: tsegaye@mgmbptc.edu.et / staff123';
            }
        }
    } else {
        $login_error = 'Please fill in all fields.';
    }
}
?>

<style>
    .staff-container {
        max-width: 480px;
        margin: 4rem auto;
        padding: 0 1.5rem;
    }
    .staff-card {
        background: #fff;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        padding: 2.5rem;
        box-shadow: 0 4px 10px rgba(0,0,0,0.06);
    }
    .staff-card h3 {
        color: #1a365d;
        margin-bottom: 0.5rem;
        font-size: 1.3rem;
        text-align: center;
    }
    .staff-card p.subtitle {
        color: #718096;
        font-size: 0.85rem;
        text-align: center;
        margin-bottom: 1.75rem;
        border-bottom: 1px solid #e2e8f0;
        padding-bottom: 1rem;
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
    .form-control-staff {
        width: 100%;
        padding: 0.65rem 0.75rem;
        border: 1px solid #cbd5e0;
        border-radius: 4px;
        font-size: 0.95rem;
    }
    .form-control-staff:focus {
        outline: none;
        border-color: #1a365d;
    }
    .btn-staff {
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
    .btn-staff:hover {
        background-color: #2b6cb0;
    }
    .staff-alert {
        padding: 0.75rem;
        background-color: #fed7d7;
        color: #742a2a;
        border: 1px solid #feb2b2;
        border-radius: 4px;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
    }
</style>

<div class="staff-container">
    <div class="staff-card">
        <h3>Staff & Administrator Access</h3>
        <p class="subtitle">Major General Mulugeta Buli Polytechnic College</p>
        
        <?php if ($login_error): ?>
            <div class="staff-alert"><?php echo htmlspecialchars($login_error); ?></div>
        <?php endif; ?>

        <form method="POST" action="staff_login.php">
            <div class="form-group">
                <label for="staffEmail">Staff Email Address</label>
                <input type="email" id="staffEmail" name="email" class="form-control-staff" placeholder="name@mgmbptc.edu.et" required>
            </div>
            <div class="form-group">
                <label for="staffPassword">Password</label>
                <input type="password" id="staffPassword" name="password" class="form-control-staff" placeholder="••••••••" required>
            </div>
            <button type="submit" name="login_submit" class="btn-staff">Sign In</button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
