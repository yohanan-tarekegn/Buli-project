<?php
$page_title = "Scholarships & Financial Support";
require_once __DIR__ . '/includes/header.php';
?>

<style>

.container{
    max-width:900px;
    margin:auto;
}

.page-header{
    text-align:center;
    margin-bottom:40px;
}

.page-header h2{
    color:#0c2340;
    font-size:35px;
}

.page-header p{
    color:#555;
}

.service-box{
    background:white;
    padding:30px;
    margin-bottom:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.service-box h3{
    color:#0c2340;
    border-left:5px solid #d4af37;
    padding-left:10px;
}

.service-box ul,
.service-box ol{
    line-height:2;
}

label{
    font-weight:bold;
    display:block;
    margin-top:15px;
}

input,
select,
textarea{
    width:100%;
    padding:12px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;
}

.submit-btn{
    background:#0c2340;
    color:yellow;
    padding:14px 30px;
    border:none;
    border-radius:7px;
    margin-top:20px;
    cursor:pointer;
}

.submit-btn:hover{
    background:#redcolor;
}

.success-message{
    display:none;
    background:#d4edda;
    color:#155724;
    padding:15px;
    border-radius:8px;
    margin-top:20px;
}

.back-btn{
    display:inline-block;
    padding:12px 25px;
    background:#0c2340;
    color:white;
    text-decoration:none;
    border-radius:6px;
}

.back-btn:hover{
    background:#d4af37;
}

</style>

<div class="container">

<div class="page-header">

<h2>Scholarships & Financial Support</h2>

<p>
The Scholarships and Financial Support Office assists eligible
students through scholarship opportunities, sponsorship programs,
and financial aid services.
</p>

</div>

<div class="service-box">

<h3>Overview</h3>

<p>
The college provides financial assistance to eligible students
to help them continue their education successfully. Support may
be based on academic excellence, financial need, leadership,
community service, or special achievements.
</p>

</div>

<div class="service-box">

<h3>Services Offered</h3>

<ul>
<li>Scholarship Opportunities</li>
<li>Financial Aid Programs</li>
<li>Sponsorship Information</li>
<li>Tuition Support</li>
<li>Emergency Financial Assistance</li>
<li>Scholarship Renewal Support</li>
</ul>

</div>

<div class="service-box">

<h3>Eligibility Requirements</h3>

<ul>
<li>Academic Excellence</li>
<li>Financial Need</li>
<li>Special Talent or Achievement</li>
<li>Leadership Experience</li>
<li>Community Service Participation</li>
</ul>

</div>

<div class="service-box">

<h3>Application Process</h3>

<ol>
<li>Review available scholarship opportunities.</li>
<li>Complete scholarship application form.</li>
<li>Submit required supporting documents.</li>
<li>Application review and evaluation.</li>
<li>Receive approval and notification.</li>
</ol>

</div>

<div class="service-box">

<h3>Required Documents</h3>

<ul>
<li>Student ID Card</li>
<li>Academic Transcript</li>
<li>Scholarship Application Form</li>
<li>Recommendation Letter (if required)</li>
<li>Proof of Financial Need (if applicable)</li>
<li>Achievement Certificates (if applicable)</li>
</ul>

</div>

<div class="service-box">

<h3>Scholarship Application Form</h3>

<form id="scholarshipForm">

<label>Full Name</label>
<input type="text" required>

<label>Student ID Number</label>
<input type="text" required>

<label>Department</label>
<input type="text" required>

<label>Email Address</label>
<input type="email" required>

<label>Phone Number</label>
<input type="text" required>

<label>Scholarship Type</label>
<select required>
    <option value="">Select Scholarship</option>
    <option>Academic Excellence Scholarship</option>
    <option>Financial Need Scholarship</option>
    <option>Sports Scholarship</option>
    <option>Leadership Scholarship</option>
    <option>Research Scholarship</option>
</select>

<label>Reason for Application</label>
<textarea rows="5" required></textarea>

<label>Current CGPA</label>
<input type="text">

<label>Upload Supporting Document</label>
<input type="file">

<button type="submit" class="submit-btn">
Apply for Scholarship
</button>

<div class="success-message" id="successMessage">
Your scholarship application has been submitted successfully.
</div>

</form>

</div>

<div class="service-box">

<h3>Benefits of Scholarships</h3>

<ul>
<li>Tuition Fee Support</li>
<li>Financial Assistance</li>
<li>Recognition of Academic Achievement</li>
<li>Encouragement for Student Success</li>
<li>Reduced Educational Expenses</li>
</ul>

</div>

<div class="service-box">

<h3>Office Information</h3>

<p><strong>Office:</strong> Scholarships & Financial Aid Office</p>

<p><strong>University:</strong> M/G/M/B/P Tecnic college</p>

<p><strong>Working Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>

<p><strong>Email:</strong> scholarships@mwu.edu.et</p>

</div>

<a href="student-services.php" class="back-btn">
← Back to Student Affairs & Services
</a>

</div>

<script>

document.getElementById("scholarshipForm").addEventListener("submit", function(e){

    e.preventDefault();

    document.getElementById("successMessage").style.display = "block";

    this.reset();

});

</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>