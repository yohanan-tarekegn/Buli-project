<?php
$page_title = "Student Housing & Accommodation";
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
    background:#d4af37;
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

<h2>Student Housing & Accommodation</h2>

<p>
Student Housing Services provide safe, comfortable, and secure
accommodation for students living on campus.
</p>

</div>

<div class="service-box">

<h3>Overview</h3>

<p>
The Student Housing Office manages dormitories and accommodation
services to ensure students have a supportive living environment
that promotes academic success and personal well-being.
</p>

</div>

<div class="service-box">

<h3>Services Offered</h3>

<ul>
<li>Dormitory Services</li>
<li>Housing Allocation</li>
<li>Residence Hall Information</li>
<li>Accommodation Support</li>
<li>Room Assignment Services</li>
<li>Housing Maintenance Requests</li>
</ul>

</div>

<div class="service-box">

<h3>Housing Facilities</h3>

<ul>
<li>Student Dormitories</li>
<li>Study Rooms</li>
<li>Reading Areas</li>
<li>Water Supply Services</li>
<li>Electricity Services</li>
<li>Campus Security Services</li>
<li>Common Recreation Areas</li>
</ul>

</div>

<div class="service-box">

<h3>Housing Guidelines</h3>

<ul>
<li>Follow residence hall regulations.</li>
<li>Maintain cleanliness in rooms and common areas.</li>
<li>Respect fellow residents and staff.</li>
<li>Protect university property.</li>
<li>Observe quiet hours for study and rest.</li>
<li>Report maintenance issues promptly.</li>
</ul>

</div>

<div class="service-box">

<h3>Accommodation Application Process</h3>

<ol>
<li>Submit accommodation request form.</li>
<li>Housing eligibility review.</li>
<li>Room allocation and approval.</li>
<li>Receive housing assignment.</li>
<li>Complete move-in procedures.</li>
</ol>

</div>

<div class="service-box">

<h3>Accommodation Request Form</h3>

<form id="housingForm">

<label>Full Name</label>
<input type="text" required>

<label>Student ID Number</label>
<input type="text" required>

<label>Department</label>
<input type="text" required>

<label>Gender</label>
<select required>
    <option value="">Select Gender</option>
    <option>Male</option>
    <option>Female</option>
</select>

<label>Phone Number</label>
<input type="text" required>

<label>Email Address</label>
<input type="email" required>

<label>Preferred Residence Hall</label>
<select required>
    <option value="">Select Residence Hall</option>
    <option>Male Dormitory Block A</option>
    <option>Male Dormitory Block B</option>
    <option>Female Dormitory Block A</option>
    <option>Female Dormitory Block B</option>
</select>

<label>Special Accommodation Needs</label>
<textarea rows="4"></textarea>

<button type="submit" class="submit-btn">
Apply for Accommodation
</button>

<div class="success-message" id="successMessage">
Your accommodation request has been submitted successfully.
</div>

</form>

</div>

<div class="service-box">

<h3>Support Services</h3>

<ul>
<li>Room Transfer Requests</li>
<li>Maintenance Assistance</li>
<li>Residence Counseling</li>
<li>Student Welfare Support</li>
<li>Resident Assistant Services</li>
</ul>

</div>

<div class="service-box">

<h3>Housing Office Information</h3>

<p><strong>Office:</strong> Student Housing & Accommodation Office</p>

<p><strong>University:</strong> M/G/M/B/P/T College</p>

<p><strong>Working Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>

<p><strong>Email:</strong> housing@mgmbpt.edu.et</p>

<p><strong>Location:</strong> Student Affairs Building</p>

</div>

<a href="student-services.php" class="back-btn">
← Back to Student Affairs & Services
</a>

</div>

<script>

document.getElementById("housingForm").addEventListener("submit", function(e){

    e.preventDefault();

    document.getElementById("successMessage").style.display = "block";

    this.reset();

});

</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>