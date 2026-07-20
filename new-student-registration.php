<?php
$page_title = "New Student Registration";
require_once __DIR__ . '/includes/header.php';
?>

<style>
.page-header{
    text-align:center;
    margin-bottom:40px;
}

.page-header h2{
    color:#0c2340;
    font-size:2.5rem;
    margin-bottom:10px;
}

.page-header p{
    color:#555;
    max-width:800px;
    margin:auto;
}

.registration-section{
    background:#fff;
    padding:30px;
    margin-bottom:25px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.registration-section h3{
    color:#0c2340;
    margin-bottom:15px;
    border-left:5px solid #d4af37;
    padding-left:10px;
}

.registration-section ul{
    padding-left:20px;
    line-height:2;
}

.info-box{
    background:#f8f9fa;
    border-left:5px solid #0c2340;
    padding:20px;
    margin-top:20px;
}

.back-btn{
    display:inline-block;
    padding:12px 25px;
    background:#0c2340;
    color:white;
    text-decoration:none;
    border-radius:5px;
    margin-top:20px;
}

.back-btn:hover{
    background:#d4af37;
}
</style>

<div class="page-header">
    <h2>New Student Registration</h2>

    <p>
        Welcome to Madda Walabu University. All newly admitted students
        must complete the registration process before beginning their
        academic studies.
    </p>
</div>

<div class="registration-section">
    <h3>Purpose of Registration</h3>

    <p>
        New student registration officially confirms admission into the
        university and allows students to access academic and campus
        services.
    </p>

    <ul>
        <li>Verify admission status</li>
        <li>Create student records</li>
        <li>Assign student identification numbers</li>
        <li>Enroll students in academic programs</li>
        <li>Provide access to university services</li>
    </ul>
</div>

<div class="registration-section">
    <h3>Required Documents</h3>

    <ul>
        <li>Admission Letter</li>
        <li>Original Academic Certificates</li>
        <li>Copies of Academic Transcripts</li>
        <li>National ID Card or Passport</li>
        <li>Passport Size Photographs</li>
        <li>Completed Registration Form</li>
        <li>Payment Receipt (if applicable)</li>
    </ul>
</div>

<div class="registration-section">
    <h3>Registration Process</h3>

    <ul>
        <li>Step 1: <a href="admission-verification.php">
Admission Verification
</a></li>
        <li>Step 2: <a href="document-submission.php">
Submission of Required Documents</a></li>
        <li>Step 3: Completion of Registration Forms</li>
        <li>Step 4: Student Number Assignment</li>
        <li>Step 5: Student ID Card Processing</li>
        <li>Step 6: Academic Program Enrollment</li>
        <li>Step 7: Student Orientation Program</li>
    </ul>
</div>

<div class="registration-section">
    <h3>Services Available After Registration</h3>

    <ul>
        <li>Course Registration</li>
        <li>Library Access</li>
        <li>Student Portal Access</li>
        <li>Health Services</li>
        <li>Housing Services</li>
        <li>Student Clubs and Organizations</li>
        <li>Academic Advising Services</li>
    </ul>
</div>

<div class="registration-section">
    <h3>Important Information</h3>

    <div class="info-box">
        <ul>
            <li>Registration must be completed during the official registration period.</li>
            <li>Late registration may result in penalties.</li>
            <li>Students should keep copies of all submitted documents.</li>
            <li>Student ID cards must be carried while on campus.</li>
        </ul>
    </div>
</div>

<div class="registration-section">
    <h3>Registrar Office Contact</h3>

    <p><strong>Office:</strong> Registrar Office</p>
    <p><strong>University:</strong> Madda Walabu University</p>
    <p><strong>Working Hours:</strong> Monday – Friday, 8:00 AM – 5:00 PM</p>
    <p><strong>Email:</strong> registrar@mwu.edu.et</p>
</div>

<a href="student-services.php" class="back-btn">
    ← Back to Student Affairs & Services
</a>

<?php
require_once __DIR__ . '/includes/footer.php';
?>