<?php
$page_title = "Health Services";
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

<h2>Health Services</h2>

<p>
The Campus Health Center provides healthcare services to support
students' physical, mental, and emotional well-being.
</p>

</div>

<div class="service-box">

<h3>Overview</h3>

<p>
The University Health Center offers medical assistance, health
education, emergency support, and wellness programs to help
students maintain good health throughout their academic journey.
</p>

</div>

<div class="service-box">

<h3>Services Offered</h3>

<ul>
<li>Campus Clinic Services</li>
<li>First Aid Services</li>
<li>Medical Consultations</li>
<li>Health Awareness Programs</li>
<li>Emergency Assistance</li>
<li>Health Screening Services</li>
<li>Mental Health Support</li>
</ul>

</div>

<div class="service-box">

<h3>Campus Clinic Services</h3>

<ul>
<li>General health checkups</li>
<li>Treatment for minor illnesses</li>
<li>Basic medical care</li>
<li>Health assessments</li>
<li>Referral services</li>
</ul>

</div>

<div class="service-box">

<h3>Emergency Assistance</h3>

<ul>
<li>Emergency first aid</li>
<li>Medical referral services</li>
<li>Emergency transportation coordination</li>
<li>Immediate health support</li>
</ul>

</div>

<div class="service-box">

<h3>Clinic Hours</h3>

<p><strong>Monday – Friday:</strong> 8:00 AM – 5:00 PM</p>
<p><strong>Saturday:</strong> 8:00 AM – 12:00 PM</p>
<p><strong>Sunday:</strong> Closed</p>

</div>

<div class="service-box">

<h3>Request Medical Appointment</h3>

<form id="healthForm">

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

<label>Type of Service Needed</label>
<select required>
    <option value="">Select Service</option>
    <option>Medical Consultation</option>
    <option>First Aid Service</option>
    <option>Health Screening</option>
    <option>Mental Health Counseling</option>
    <option>Emergency Assistance</option>
</select>

<label>Describe Your Health Concern</label>
<textarea rows="5" required></textarea>

<button type="submit" class="submit-btn">
Request Appointment
</button>

<div class="success-message" id="successMessage">
Your appointment request has been submitted successfully.
</div>

</form>

</div>

<div class="service-box">

<h3>Health Guidelines</h3>

<ul>
<li>Carry your student ID card when visiting the clinic.</li>
<li>Follow instructions from healthcare professionals.</li>
<li>Maintain personal hygiene and healthy habits.</li>
<li>Report emergencies immediately.</li>
<li>Attend health awareness programs regularly.</li>
</ul>

</div>

<div class="service-box">

<h3>Health Center Contact Information</h3>

<p><strong>Office:</strong> Campus Health Center</p>

<p><strong>University:</strong> Madda Walabu University</p>

<p><strong>Working Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>

<p><strong>Email:</strong> healthcenter@mwu.edu.et</p>

<p><strong>Emergency Phone:</strong> +251 XXX XXX XXX</p>

</div>

<a href="student-services.php" class="back-btn">
← Back to Student Affairs & Services
</a>

</div>

<script>

document.getElementById("healthForm").addEventListener("submit", function(e){

    e.preventDefault();

    document.getElementById("successMessage").style.display = "block";

    this.reset();

});

</script>

<?php
require_once __DIR__ . '/includes/footer.php';
?>