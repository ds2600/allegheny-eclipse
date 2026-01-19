<?php
?>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="footer-container">
            <div class="social-icons">
                <a href="https://facebook.com/alleghenyeclipse" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                    <a href="https://instagram.com/allegheny_eclipse" target="_blank" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://youtube.com/@alleghenyeclipse" target="_blank" aria-label="YouTube">
                    <i class="fab fa-youtube"></i>
                </a>
            </div>
            <p class="copyright">&copy; 2026 Allegheny Eclipse. All rights reserved.<br/>Adult Color Guard and Performing Arts in Warren, Pennsylvania</p>
        </div>
        <div class="version">
            <p>
               <?php echo $build; ?>
            </p>
<?php
    if ($_ENV['ENVIRONMENT'] !== 'production') {
        echo '<p>' . $_ENV['ENVIRONMENT'] . '</p>';
    }
?>
        </div>
    </footer>

