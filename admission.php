<?php
$page_title = 'Admission & Registration';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/db.php';

// Simple simulated feedback logic
$form_status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect fields (basic sanitization)
    $name = isset($_POST['student_name']) ? htmlspecialchars($_POST['student_name']) : '';
    $email = isset($_POST['student_email']) ? htmlspecialchars($_POST['student_email']) : '';
    $phone = isset($_POST['student_phone']) ? htmlspecialchars($_POST['student_phone']) : '';
    $dept = isset($_POST['student_dept']) ? htmlspecialchars($_POST['student_dept']) : '';
    
    if (!empty($name) && !empty($email) && !empty($phone) && !empty($dept)) {
        if ($pdo) {
            try {
                $stmt = $pdo->prepare("INSERT INTO admissions (full_name, email, phone, department) VALUES (:name, :email, :phone, :dept)");
                $stmt->execute([
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':dept' => $dept
                ]);
                $form_status = 'success';
            } catch (\PDOException $e) {
                $form_status = 'error_db';
                $db_error = $e->getMessage();
            }
        } else {
            // Fallback simulated success
            $form_status = 'success_simulated';
        }
    } else {
        $form_status = 'error';
    }
}
?>

<div class="page-header">
    <h2>Admission and Registration Guidelines</h2>
</div>

<div class="grid-2">
    <!-- Requirements Card -->
    <div class="card">
        <h3>Entry Requirements</h3>
        <p style="margin-bottom: 1rem;">
            To apply for admission at MGMBPTC, applicants must provide standard scholastic credentials based on the level they intend to join:
        </p>
        <ul style="padding-left: 1.5rem; margin-bottom: 1rem;">
            <li style="margin-bottom: 0.5rem;"><strong>Levels 1 & 2:</strong> Completion of General Secondary Education (Grade 10/12) or equivalent technical experience.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Levels 3 & 4 (Diploma):</strong> Grade 12 completion certificates or Level 2 certification with industrial experience.</li>
            <li style="margin-bottom: 0.5rem;"><strong>Level 5 (Advanced Diploma):</strong> Level 4 certification in a related field and pass mark in COC evaluation.</li>
        </ul>
        
        <h4 style="color: var(--primary-color); margin-top: 1rem;">Required Documents:</h4>
        <ul style="padding-left: 1.5rem;">
            <li>Original and copy of educational transcript & certificates.</li>
            <li>Four recent passport-sized photographs.</li>
            <li>Valid identification card (Kebele ID or passport).</li>
            <li>Application fee receipt.</li>
        </ul>
    </div>

    <!-- Intake Schedule -->
    <div class="card">
        <h3>Academic Intake Calendar</h3>
        <p style="margin-bottom: 1rem;">We run two main entry periods for regular programs and continuous intakes for short courses:</p>
        
        <table class="data-table" style="font-size: 0.9rem;">
            <thead>
                <tr>
                    <th>Intake Semester</th>
                    <th>Application Period</th>
                    <th>Classes Begin</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Semester I (Regular)</strong></td>
                    <td>August 01 - September 15</td>
                    <td>First week of October</td>
                </tr>
                <tr>
                    <td><strong>Semester II (Regular)</strong></td>
                    <td>January 15 - February 15</td>
                    <td>First week of March</td>
                </tr>
                <tr>
                    <td><strong>Short-Term Evening</strong></td>
                    <td>Monthly registration</td>
                    <td>First Monday of each month</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- Simulated Online Admission Form -->
<section class="card" style="margin-bottom: 2rem;">
    <h3>Simulated Online Inquiry & Application Form</h3>
    <p style="margin-bottom: 1.5rem;">
        Fill out this form to submit your interest. Our registration office will review your details and email you full instructions.
    </p>

    <!-- Simulated alerts -->
    <?php if ($form_status === 'success'): ?>
        <div class="alert alert-success">
            Thank you, <strong><?php echo $name; ?></strong>! Your application for <strong><?php echo $dept; ?></strong> has been saved directly to the database. We will contact you soon.
        </div>
    <?php elseif ($form_status === 'success_simulated'): ?>
        <div class="alert alert-success" style="background-color: #e2e8f0; border-color: #cbd5e0; color: #4a5568;">
            <strong>[Offline Demo Mode]</strong> Thank you, <strong><?php echo $name; ?></strong>! Your inquiry for <strong><?php echo $dept; ?></strong> was validated successfully. (Connect to database to persist this).
        </div>
    <?php elseif ($form_status === 'error_db'): ?>
        <div class="alert alert-error">
            Database Error: Failed to save application. Details: <em><?php echo $db_error; ?></em>
        </div>
    <?php elseif ($form_status === 'error'): ?>
        <div class="alert alert-error">
            Failed to process your application request. Please ensure all form fields are filled correctly.
        </div>
    <?php endif; ?>

    <form action="admission.php" method="POST" id="admissionForm">
        <div class="grid-2" style="margin-bottom: 0;">
            <div class="form-group">
                <label for="studentName">Full Name *</label>
                <input type="text" name="student_name" id="studentName" class="form-control" placeholder="Abebe Kebede">
            </div>
            
            <div class="form-group">
                <label for="studentEmail">Email Address *</label>
                <input type="email" name="student_email" id="studentEmail" class="form-control" placeholder="abebe@example.com">
            </div>
        </div>

        <div class="grid-2" style="margin-bottom: 0;">
            <div class="form-group">
                <label for="studentPhone">Phone Number *</label>
                <input type="text" name="student_phone" id="studentPhone" class="form-control" placeholder="+251 911 XXXXXX">
            </div>
            
            <div class="form-group">
                <label for="studentDept">Select Desired Program *</label>
                <select name="student_dept" id="studentDept" class="form-control">
                    <option value="">-- Choose Department --</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Automotive Technology">Automotive Technology</option>
                    <option value="Electrical & Electronics">Electrical & Electronics</option>
                    <option value="Manufacturing & Mechanical">Manufacturing & Mechanical</option>
                    <option value="Construction & Civil Technology">Construction & Civil Technology</option>
                    <option value="Short-Term ICT Course">Short-Term ICT Course</option>
                </select>
            </div>
        </div>

        <div style="text-align: right; margin-top: 1rem;">
            <button type="submit" class="btn btn-secondary"><?php echo __('btn_submit'); ?></button>
        </div>
    </form>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
