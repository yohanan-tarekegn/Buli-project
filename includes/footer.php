    </main> <!-- End of .content-wrapper -->

    <!-- Footer section -->
    <footer class="main-footer">
        <div class="footer-container">
            <!-- About widget -->
            <div class="footer-widget footer-about">
                <h3><?php echo __('college_short'); ?></h3>
                <p><?php echo __('hero_desc'); ?></p>
                <p class="theme-note">Theme: "Shine Through Education and Technology"</p>
            </div>
            
            <!-- Quick links widget -->
            <div class="footer-widget footer-links">
                <h3><?php echo __('quick_links'); ?></h3>
                <ul>
                    <li><a href="index.php"><?php echo __('nav_home'); ?></a></li>
                    <li><a href="about.php"><?php echo __('nav_about'); ?></a></li>
                    <li><a href="academics.php"><?php echo __('nav_academics'); ?></a></li>
                    <li><a href="admission.php"><?php echo __('nav_admission'); ?></a></li>
                    <li><a href="services.php"><?php echo __('nav_services'); ?></a></li>
                    <li><a href="contact.php"><?php echo __('nav_contact'); ?></a></li>
                </ul>
            </div>
            <!-- resources -->
             <div class="footer-widget footer-resources">
                <h3><?php echo __('resources'); ?></h3>
                <ul>
                    <li><a href="downloads.php"><?php echo __('nav_download'); ?></a></li>
                </ul>
             </div>
            
            <!-- Contact widget -->
            <div class="footer-widget footer-contact">
                <h3 ><a href="contact.php" style="color: white">
                            <?php echo __('nav_contact'); ?>
                        </a></h3>
                <p><strong><?php echo __('address'); ?>:</strong> Addis Ababa, Ethiopia</p>
                <p><strong><?php echo __('phone'); ?>:</strong> +251 11 XXXXXXX</p>
                <p><strong><?php echo __('email'); ?>:</strong> info@mgmbptc.edu.et</p>
            </div>
        </div>
        
        <!-- Copyright area -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php echo __('college_name'); ?>. All Rights Reserved.</p>
        </div>
    </footer>

    <script src="js/main.js"></script>
</body>
</html>
