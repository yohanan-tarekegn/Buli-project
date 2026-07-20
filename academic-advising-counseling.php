<?php
$page_title = "Academic Advising & Counseling";
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
    color:white;
    padding:14px 30px;
    border:none;
    border-radius:7px;
    margin-top:20px;
    cursor:pointer;
}

.submit-btn:hover{
    background:red;
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
    color:blue;
    text-decoration:none;
    border-radius:6px;
}

.back-btn:hover{
    background:#d4af37;
}

</style>

<div class="container">

<div class="page-header">

<h2>Academic Advising & Counseling</h2>

<p>
The Academic Advising and Counseling Office helps students
achieve academic success, personal development, and career growth.
</p>

</div>


<div class="service-box">

<h3>Purpose of Academic Advising & Counseling</h3>

<ul>
<li>Support student academic success.</li>
<li>Help students make informed educational decisions.</li>
<li>Improve study and learning skills.</li>
<li>Promote mental and emotional well-being.</li>
<li>Assist students in overcoming academic challenges.</li>
<li>Prepare students for future careers.</li>
</ul>

</div>


<div class="service-box">

<h3>Services Offered</h3>

<ul>
<li><strong>Academic Advising</strong> - Course selection and academic planning.</li>
<li><strong>Study Skills Support</strong> - Time management and exam preparation.</li>
<li><strong>Personal Counseling</strong> - Guidance on personal and emotional concerns.</li>
<li><strong>Stress Management</strong> - Coping strategies for academic pressure.</li>
<li><strong>Mentorship Programs</strong> - Support from faculty and senior students.</li>
</ul>

</div>


<div class="service-box">

<h3>How to Access the Service</h3>

<ol>
<li>Visit the Academic Advising Office.</li>
<li>Request an appointment.</li>
<li>Discuss your academic or personal concerns.</li>
<li>Receive guidance and recommendations.</li>
<li>Follow up with your advisor when needed.</li>
</ol>

</div>


<div class="service-box">

<h3>Benefits for Students</h3>

<ul>
<li>Better academic performance.</li>
<li>Improved study habits.</li>
<li>Increased confidence.</li>
<li>Enhanced mental well-being.</li>
<li>Career readiness.</li>
<li>Personal growth and development.</li>
</ul>

</div>


<div class="service-box">

<h3>Request Advising Appointment</h3>

<form id="advisingForm">

<label>Full Name</label>
<input type="text" placeholder="Enter your full name" required>

<label>Student ID Number</label>
<input type="text" placeholder="Enter student ID number" required>

<label>Department</label>
<input type="text" placeholder="Enter department" required>

<label>Email Address</label>
<input type="email" placeholder="Enter email address" required>

<label>Phone Number</label>
<input type="text" placeholder="Enter phone number" required>

<label>Service Needed</label>
<select required>
<option value="">Select Service</option>
<option>Academic Advising</option>
<option>Study Skills Support</option>
<option>Personal Counseling</option>
<option>Stress Management</option>
<option>Mentorship Program</option>
</select>

<label>Describe Your Concern</label>
<textarea rows="5" placeholder="Explain your concern or request"></textarea>

<button type="submit" class="submit-btn">
Request Appointment
</button>

<div class="success-message" id="successMessage">
Your advising request has been submitted successfully.
The office will contact you soon.
</div>

</form>

</div>


<div class="service-box">

<h3>Office Information</h3>

<p><strong>Office:</strong> Academic Advising & Counseling Center</p>

<p><strong>University:</strong> Madda Walabu University</p>

<p><strong>Working Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>

<p><strong>Email:</strong> counseling@mwu.edu.et</p>

</div>


<a href="student-services.php" class="back-btn">
← Back to Student Affairs & Services
</a>

</div>

<script>

document.getElementById("advisingForm").addEventListener("submit", function(e){

e.preventDefault();

document.getElementById("successMessage").style.display = "block";

this.reset();

});

</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>