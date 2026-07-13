<?php
$page_title = 'Staff Directory';
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-header">
    <h2>College Staff Directory</h2>
</div>

<p style="margin-bottom: 2rem;">
    Search and find qualifications and contact details for MGMBPTC administrators, department heads, and academic instructors.
</p>

<!-- Directory Filtering Controls (Mockup Layout) -->
<section class="card" style="margin-bottom: 2rem; background-color: #edf2f7;">
    <h4 style="margin-bottom: 1rem;">Filter Directory</h4>
    <form action="staff.php" method="GET" onsubmit="event.preventDefault();">
        <div class="grid-3" style="margin-bottom: 0;">
            <div class="form-group" style="margin-bottom: 0;">
                <input type="text" id="staffSearch" class="form-control" placeholder="Search by name...">
            </div>
            
            <div class="form-group" style="margin-bottom: 0;">
                <select id="staffDeptFilter" class="form-control">
                    <option value="">-- All Departments --</option>
                    <option value="Administration">Administration</option>
                    <option value="IT">Information Technology</option>
                    <option value="Automotive">Automotive Technology</option>
                    <option value="Electrical">Electrical & Electronics</option>
                    <option value="Mechanical">Mechanical & Manufacturing</option>
                </select>
            </div>

            <div style="display: flex; gap: 0.5rem;">
                <button type="submit" class="btn" style="flex: 1;">Search</button>
                <button type="reset" class="btn btn-secondary" onclick="document.getElementById('staffSearch').value=''; document.getElementById('staffDeptFilter').selectedIndex=0;">Reset</button>
            </div>
        </div>
    </form>
</section>

<!-- Staff Listing Table -->
<section class="card" style="margin-bottom: 2rem;">
    <h3>Key Academic and Administration Personnel</h3>
    <div class="table-responsive" style="margin-top: 1rem;">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Role / Specialization</th>
                    <th>Email Contact</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">AK</div></td>
                    <td><strong>Dr. Abebe Kebede</strong></td>
                    <td>Administration</td>
                    <td>College Dean / Educational Administration</td>
                    <td>dean@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">TM</div></td>
                    <td><strong>Ato Tsegaye Mengistu</strong></td>
                    <td>Administration</td>
                    <td>Academic Vice Dean / Curriculum Specialist</td>
                    <td>academic.vicedean@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">AA</div></td>
                    <td><strong>W/ro Aster Almaz</strong></td>
                    <td>Administration</td>
                    <td>Admin Vice Dean / Human Resources</td>
                    <td>admin.vicedean@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">YB</div></td>
                    <td><strong>Ato Yohannes Bekele</strong></td>
                    <td>Information Technology</td>
                    <td>IT Department Head / Database Specialist</td>
                    <td>it.head@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">MT</div></td>
                    <td><strong>Ato Mulugeta Tadesse</strong></td>
                    <td>Automotive Technology</td>
                    <td>Automotive Department Head / Diagnostics Expert</td>
                    <td>automotive.head@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">KD</div></td>
                    <td><strong>W/t Kidist Daniel</strong></td>
                    <td>Electrical & Electronics</td>
                    <td>Electronics Instructor / Embedded Systems</td>
                    <td>kidist.d@mgmbptc.edu.et</td>
                </tr>
                <tr>
                    <td><div style="width: 40px; height: 40px; background-color: var(--border-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold; color: var(--primary-color);">BT</div></td>
                    <td><strong>Ato Bekele Tolosa</strong></td>
                    <td>Mechanical & Manufacturing</td>
                    <td>Manufacturing Instructor / CAD Design Specialist</td>
                    <td>bekele.t@mgmbptc.edu.et</td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
