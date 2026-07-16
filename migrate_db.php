<?php
/**
 * One-time database migration script — adds new tables to buli_db.
 * Run once via browser: http://localhost/Buli-website/migrate_db.php
 * DELETE or restrict access to this file after running.
 */
require_once __DIR__ . '/includes/db.php';

header('Content-Type: text/plain');
echo "=== MGMBPTC Database Migration ===\n\n";

if (!$pdo) {
    echo "[ERROR] Cannot connect to database. Check db.php credentials.\n";
    exit;
}

$migrations = [

    // 1. Students table
    "CREATE TABLE IF NOT EXISTS `students` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `password_hash` VARCHAR(255) NOT NULL,
        `department` VARCHAR(100) DEFAULT NULL,
        `student_id_no` VARCHAR(50) DEFAULT NULL,
        `status` VARCHAR(20) DEFAULT 'Active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    // 2. Staff table
    "CREATE TABLE IF NOT EXISTS `staff` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `full_name` VARCHAR(100) NOT NULL,
        `email` VARCHAR(100) NOT NULL UNIQUE,
        `password_hash` VARCHAR(255) NOT NULL,
        `role` ENUM('admin','staff') DEFAULT 'staff',
        `department` VARCHAR(100) DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    // 3. Gallery table
    "CREATE TABLE IF NOT EXISTS `gallery` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(200) NOT NULL,
        `description` TEXT DEFAULT NULL,
        `type` ENUM('photo','video') DEFAULT 'photo',
        `date_taken` DATE DEFAULT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    // 4. Downloads table
    "CREATE TABLE IF NOT EXISTS `downloads` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(200) NOT NULL,
        `description` VARCHAR(255) DEFAULT NULL,
        `category` VARCHAR(100) DEFAULT 'General',
        `file_name` VARCHAR(255) NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

    // 5. Seed default admin staff account (password: buliadmin123)
    "INSERT IGNORE INTO `staff` (full_name, email, password_hash, role, department)
     VALUES ('Admin User', 'admin@mgmbptc.edu.et', '" . password_hash('buliadmin123', PASSWORD_DEFAULT) . "', 'admin', 'Administration')",

    // 6. Seed a default staff account (password: staff123)
    "INSERT IGNORE INTO `staff` (full_name, email, password_hash, role, department)
     VALUES ('Tsegaye Mengistu', 'tsegaye@mgmbptc.edu.et', '" . password_hash('staff123', PASSWORD_DEFAULT) . "', 'staff', 'Information Technology')",

    // 7. Seed gallery sample entries (placeholders)
    "INSERT IGNORE INTO `gallery` (id, title, description, type, date_taken) VALUES
     (1, 'Annual Graduation Ceremony 2026', 'Graduates celebrating at the main pavilion.', 'photo', '2026-07-01'),
     (2, 'IT Workshop Lab Session', 'Students during a hands-on ICT practical session.', 'photo', '2026-06-15'),
     (3, 'Innovation Exhibition 2026', 'Student projects showcased at the national TVET expo.', 'photo', '2026-05-20'),
     (4, 'Automotive Workshop', 'Automotive trainees working on engine diagnostics.', 'photo', '2026-04-10'),
     (5, 'College Campus Tour', 'Video overview of the college facilities and campus.', 'video', '2026-03-05'),
     (6, 'Solar Energy Installation Training', 'Students installing a solar panel unit on campus.', 'photo', '2026-02-18')",

    // 8. Seed download center sample entries
    "INSERT IGNORE INTO `downloads` (id, title, description, category, file_name) VALUES
     (1, 'Student Application Form', 'Official form for new student admissions.', 'Application Forms', 'application_form.pdf'),
     (2, 'TVET Level Registration Guide', 'Step-by-step guide for level registration.', 'Academic Guides', 'registration_guide.pdf'),
     (3, 'College Academic Calendar 2026/27', 'Official academic calendar for the new year.', 'Academic Guides', 'academic_calendar_2026.pdf'),
     (4, 'Student Code of Conduct', 'Rules, regulations and student discipline manual.', 'Regulations', 'student_conduct.pdf'),
     (5, 'Research Publication Vol. 3', 'MGMBPTC annual research and innovation publication.', 'Publications', 'research_vol3.pdf'),
     (6, 'Short-Course Registration Form', 'Form for enrolling in evening short-term programs.', 'Application Forms', 'short_course_form.pdf')"
];

foreach ($migrations as $i => $sql) {
    try {
        $pdo->exec($sql);
        $n = $i + 1;
        // Friendly label
        $labels = [
            'Create students table',
            'Create staff table',
            'Create gallery table',
            'Create downloads table',
            'Seed admin account',
            'Seed staff account',
            'Seed gallery entries',
            'Seed download entries'
        ];
        echo "[OK] Step " . ($i+1) . ": " . ($labels[$i] ?? 'Migration') . "\n";
    } catch (\PDOException $e) {
        echo "[WARN] Step " . ($i+1) . " skipped: " . $e->getMessage() . "\n";
    }
}

echo "\n=== Migration complete. DELETE migrate_db.php when done. ===\n";
?>
