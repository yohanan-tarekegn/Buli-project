<?php
$page_title = "Submission of Required Documents";
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


.document-box{

    background:white;
    padding:30px;
    margin-bottom:25px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);

}


.document-box h3{

    color:#0c2340;
    border-left:5px solid #d4af37;
    padding-left:10px;

}


.document-box ul,
.document-box ol{

    line-height:2;

}



.upload-form input,
.upload-form select{

    width:100%;
    padding:12px;
    margin-top:8px;
    border:1px solid #ccc;
    border-radius:6px;

}


label{

    font-weight:bold;
    display:block;
    margin-top:15px;

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

<h2>
Submission of Required Documents
</h2>

<p>
Submit all required documents to complete your new student
registration process at Madda Walabu University.
</p>

</div>




<div class="document-box">


<h3>Purpose of Document Submission</h3>


<ul>

<li>Confirm student's academic background.</li>

<li>Verify admission information.</li>

<li>Create official student records.</li>

<li>Complete the registration process.</li>

<li>Provide access to university services.</li>

</ul>


</div>





<div class="document-box">


<h3>Required Documents</h3>


<ul>

<li>
<strong>Admission Documents</strong>
<ul>
<li>Admission Letter</li>
<li>Admission Confirmation Document</li>
<li>Placement Letter (if applicable)</li>
</ul>
</li>



<li>
<strong>Academic Documents</strong>
<ul>
<li>Original Academic Certificate</li>
<li>Academic Transcript</li>
<li>Previous Educational Certificates</li>
<li>Grade Reports</li>
</ul>
</li>



<li>
<strong>Identification Documents</strong>
<ul>
<li>National ID Card / Passport</li>
<li>Birth Certificate (if required)</li>
<li>Passport Size Photographs</li>
</ul>
</li>



<li>
<strong>Registration Documents</strong>
<ul>
<li>Completed Registration Form</li>
<li>Student Information Form</li>
<li>Medical Information Form</li>
<li>Payment Receipt (if required)</li>
</ul>
</li>


</ul>


</div>






<div class="document-box">


<h3>Document Submission Process</h3>


<ol>

<li>
Prepare all required original documents and copies.
</li>


<li>
Visit the Registrar Office during registration period.
</li>


<li>
Submit documents to registration staff.
</li>


<li>
University staff check and verify documents.
</li>


<li>
Approved information is added to student records.
</li>


<li>
Student receives registration approval.
</li>


</ol>


</div>






<div class="document-box">


<h3>Online Document Submission Form</h3>


<form class="upload-form" id="documentForm">


<label>
Full Name
</label>

<input type="text"
placeholder="Enter full name"
required>



<label>
Admission Number
</label>

<input type="text"
placeholder="Enter admission number"
required>



<label>
Department
</label>

<input type="text"
placeholder="Enter department"
required>




<label>
Upload Admission Letter
</label>

<input type="file"
required>



<label>
Upload Academic Certificate
</label>

<input type="file"
required>



<label>
Upload Transcript
</label>

<input type="file"
required>



<label>
Upload Passport Photo
</label>

<input type="file"
required>




<label>

<input type="checkbox" required>

I confirm that all submitted documents are correct.

</label>




<button class="submit-btn">

Submit Documents

</button>




<div class="success-message" id="success">

Documents submitted successfully.
Waiting for verification.

</div>


</form>


</div>






<div class="document-box">


<h3>Important Instructions</h3>


<ul>

<li>
Submit original documents for verification.
</li>

<li>
Provide clear copies of all documents.
</li>

<li>
False information may cancel admission.
</li>

<li>
Keep copies of submitted documents.
</li>

<li>
Complete submission before the deadline.
</li>


</ul>


</div>







<div class="document-box">


<h3>Registrar Office Information</h3>


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




<a href="new-student-registration.php" class="back-btn">

← Back to Registration

</a>



</div>






<script>

document
.getElementById("documentForm")
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