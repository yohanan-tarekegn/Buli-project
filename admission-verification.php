<?php
$page_title = "Admission Verification";
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


.verification-box{

    background:white;
    padding:30px;
    margin-bottom:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);

}


.verification-box h3{

    color:#0c2340;
    border-left:5px solid #d4af37;
    padding-left:10px;

}


ul,ol{

    line-height:2;

}


label{

    font-weight:bold;
    display:block;
    margin-top:15px;

}


input,
select{

    width:100%;
    padding:12px;
    margin-top:5px;
    border:1px solid #ccc;
    border-radius:6px;

}


.verify-btn{

    background:#0c2340;
    color:white;
    padding:14px 30px;
    border:none;
    border-radius:7px;
    cursor:pointer;
    margin-top:20px;

}


.verify-btn:hover{

    background:#d4af37;

}


.message{

    display:none;
    margin-top:20px;
    background:#d4edda;
    padding:15px;
    color:#155724;
    border-radius:8px;

}


</style>



<div class="container">


<div class="page-header">

<h2>Admission Verification</h2>

<p>
Confirm your admission status before completing new student registration
at Madda Walabu University.
</p>

</div>




<div class="verification-box">

<h3>About Admission Verification</h3>

<p>

Admission verification is the process of confirming that a student
has been officially admitted to the university. The university checks
student information and required documents before registration.

</p>


</div>




<div class="verification-box">

<h3>Purpose of Admission Verification</h3>

<ul>

<li>Confirm student admission status</li>

<li>Verify admission letter authenticity</li>

<li>Check academic documents</li>

<li>Create accurate student records</li>

<li>Approve students for registration</li>


</ul>


</div>




<div class="verification-box">

<h3>Required Documents</h3>


<ul>

<li>Admission Letter</li>

<li>Original Academic Certificate</li>

<li>Academic Transcript</li>

<li>National ID Card or Passport</li>

<li>Passport Size Photograph</li>

<li>Previous School Documents</li>


</ul>


</div>





<div class="verification-box">

<h3>Verification Process</h3>


<ol>

<li>Student reports to Registrar Office</li>

<li>Admission letter is checked</li>

<li>Academic documents are verified</li>

<li>Student information is confirmed</li>

<li>Verification approval is given</li>

<li>Student continues registration process</li>


</ol>


</div>






<div class="verification-box">


<h3>Online Admission Verification Form</h3>



<form id="verifyForm">


<label>
Admission Number
</label>

<input type="text"
placeholder="Enter admission number"
required>



<label>
Full Name
</label>

<input type="text"
placeholder="Enter full name"
required>




<label>
Department
</label>

<input type="text"
placeholder="Enter department"
required>
<ul>choose department</ul>
<li>computer science </li>





<label>
Academic Program
</label>

<input type="text"
placeholder="Enter program"
required>





<label>
Admission Year
</label>


<select>

<option>Select Year</option>

<option>2026</option>

<option>2027</option>


</select>





<label>
Upload Admission Letter
</label>


<input type="file">





<label>
Upload Academic Certificate
</label>


<input type="file">





<br>


<input type="checkbox" required>

I confirm that all information provided is correct.





<br>


<button class="verify-btn">

Submit Verification

</button>




<div class="message" id="success">

Admission verification submitted successfully.
Please wait for confirmation.

</div>



</form>



</div>






<div class="verification-box">


<h3>Registrar Office Contact</h3>


<p>
<strong>Office:</strong> Registrar Office
</p>


<p>
<strong>University:</strong> Madda Walabu University
</p>


<p>
<strong>Working Hours:</strong>
Monday - Friday, 8:00 AM - 5:00 PM
</p>


<p>
<strong>Email:</strong>
registrar@mwu.edu.et
</p>


</div>




</div>




<script>

document
.getElementById("verifyForm")
.addEventListener("submit",function(e){

e.preventDefault();


document
.getElementById("success")
.style.display="block";


this.reset();


});


</script>



<?php
require_once __DIR__ . '/includes/footer.php';
?>