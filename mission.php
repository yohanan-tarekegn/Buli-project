<?php
$page_title = 'Mission and Vision';
require_once __DIR__ . '/includes/header.php';
?>
<div class="card">
        <h3><?php echo __('mission'); ?> & <?php echo __('vision'); ?></h3>
        
        <div style="margin-bottom: 1.5rem;">
            <h4 style="color: var(--accent-color); font-weight: bold;"><?php echo __('mission'); ?></h4>
            <p>
                To produce competent, innovative, and ethically grounded technicians and professionals by providing high-quality, practical-oriented technical and vocational training that meets industry standards and contributes to national economic growth.
            </p>
        </div>

        <div>
            <h4 style="color: var(--accent-color); font-weight: bold;"><?php echo __('vision'); ?></h4>
            <p>
                To become a recognized center of excellence in technical education and technology transfer in East Africa by 2035.
            </p>
        </div>
    </div>
<?php
require_once __DIR__ . '/includes/footer.php';
?>