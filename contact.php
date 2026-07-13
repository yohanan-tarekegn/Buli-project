<?php
$page_title = 'Contact Us';
require_once __DIR__ . '/includes/header.php';

// Simple simulated feedback logic
$feedback_status = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_name = isset($_POST['contact_name']) ? htmlspecialchars($_POST['contact_name']) : '';
    $sender_email = isset($_POST['contact_email']) ? htmlspecialchars($_POST['contact_email']) : '';
    $sender_msg = isset($_POST['contact_message']) ? htmlspecialchars($_POST['contact_message']) : '';
    
    if (!empty($sender_name) && !empty($sender_email) && !empty($sender_msg)) {
        $feedback_status = 'success';
    } else {
        $feedback_status = 'error';
    }
}
?>

<div class="page-header">
    <h2><?php echo __('contact_title'); ?></h2>
</div>

<div class="grid-2">
    <!-- Contact Info & Map Mock -->
    <div class="card">
        <h3>Campus Contact Details</h3>
        <p style="margin-bottom: 1rem;">
            Feel free to visit our campus or reach out via phone/email during our regular office hours (Monday to Friday, 8:00 AM - 5:00 PM).
        </p>
        
        <p style="margin-bottom: 0.5rem;"><strong><?php echo __('address'); ?>:</strong> Addis Ababa, Ethiopia</p>
        <p style="margin-bottom: 0.5rem;"><strong><?php echo __('phone'); ?>:</strong> +251 11 XXXXXXX / +251 911 XXXXXXX</p>
        <p style="margin-bottom: 1rem;"><strong><?php echo __('email'); ?>:</strong> info@mgmbptc.edu.et</p>

        <h4 style="margin-top: 1.5rem; margin-bottom: 0.75rem;">Location Map Placeholder</h4>
        <div style="background-color: #edf2f7; border: 1px solid var(--border-color); height: 220px; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #718096; font-style: italic;">
            [ Google Map Embed / Location Map Placeholder ]
        </div>
    </div>

    <!-- Contact Form -->
    <div class="card">
        <h3><?php echo __('contact_title'); ?> Form</h3>
        <p style="margin-bottom: 1.25rem; font-size: 0.95rem;">Send us your comments, suggestions, or academic inquiries.</p>

        <?php if ($feedback_status === 'success'): ?>
            <div class="alert alert-success">
                Thank you, <strong><?php echo $sender_name; ?></strong>! Your message has been sent successfully. We will get back to you soon.
            </div>
        <?php elseif ($feedback_status === 'error'): ?>
            <div class="alert alert-error">
                Failed to send message. Please fill out all required fields.
            </div>
        <?php endif; ?>

        <form action="contact.php" method="POST" id="contactForm">
            <div class="form-group">
                <label for="contactName"><?php echo __('name_label'); ?> *</label>
                <input type="text" name="contact_name" id="contactName" class="form-control" placeholder="Abebe Kebede">
            </div>

            <div class="form-group">
                <label for="contactEmail"><?php echo __('email_label'); ?> *</label>
                <input type="email" name="contact_email" id="contactEmail" class="form-control" placeholder="abebe@example.com">
            </div>

            <div class="form-group">
                <label for="contactSubject"><?php echo __('subject_label'); ?></label>
                <input type="text" name="contact_subject" id="contactSubject" class="form-control" placeholder="Inquiry about Registration">
            </div>

            <div class="form-group">
                <label for="contactMessage"><?php echo __('message_label'); ?> *</label>
                <textarea name="contact_message" id="contactMessage" class="form-control" placeholder="Write your message here..."></textarea>
            </div>

            <button type="submit" class="btn"><?php echo __('btn_send'); ?></button>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . '/includes/footer.php';
?>
