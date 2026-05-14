<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-grid">
            <div class="footer-col">
                <h3>Gold Pe Cash</h3>
                <p><?php echo htmlspecialchars(s($S, 'footer_text', "At Gold Pe Cash, we specialize in providing a secure and transparent process for selling your old gold jewelry for instant cash.")); ?>
                </p>
                <div class="social-icons">
                    <a href="<?php echo htmlspecialchars(s($S, 'social_facebook', '#')); ?>" target="_blank"
                        rel="noopener" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="<?php echo htmlspecialchars(s($S, 'social_instagram', '#')); ?>" target="_blank"
                        rel="noopener" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="<?php echo htmlspecialchars(s($S, 'social_youtube', '#')); ?>" target="_blank"
                        rel="noopener" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="<?php echo htmlspecialchars(s($S, 'social_whatsapp', 'https://wa.me/919576889595')); ?>"
                        target="_blank" rel="noopener" title="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                </div>
                <div style="margin-top: 20px;">
                    <h4 style="font-size: 1.1rem; margin-bottom: 10px; color: var(--gold);">Get In Touch</h4>
                    <p style="margin-bottom: 5px;">
                        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', s($S, 'phone', '+91-9576889595')); ?>"
                            style="color:inherit;text-decoration:none;">
                            <i class="fas fa-phone-alt" style="color: var(--gold); margin-right: 8px;"></i>
                            <?php echo htmlspecialchars(s($S, 'phone', '+91-9576889595')); ?>
                        </a>
                    </p>
                    <p>
                        <a href="mailto:<?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>"
                            style="color:inherit;text-decoration:none;">
                            <i class="fas fa-envelope" style="color: var(--gold); margin-right: 8px;"></i>
                            <?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>
                        </a>
                    </p>
                </div>
            </div>
            <div class="footer-col">
                <h4>Useful Links</h4>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li><a href="about-us/">About Us</a></li>
                    <li><a href="gold-pe-cash-services/">Services</a></li>
                    <li><a href="cash-on-gold/">Cash on Gold</a></li>
                    <li><a href="cash-on-silver/">Cash on Silver</a></li>
                    <li><a href="cash-on-diamond/">Cash on Diamond</a></li>
                    <li><a href="gold-bailout-valuation/">Gold Bailout</a></li>
                    <li><a href="today-gold-rate-in-ranchi/">Today Gold Rate</a></li>
                    <li><a href="contact/">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 style="margin-top: 0;">Our Offices</h4>
                <?php for ($i = 1; $i <= 7; $i++): ?>
                    <?php $addr = s($S, "address$i", '');
                    if ($addr): ?>
                        <p style="font-size: 0.8rem; margin-bottom: 5px;">
                            <i class="fas fa-map-marker-alt" style="color:var(--gold); margin-right:4px;"></i>
                            <?php echo htmlspecialchars($addr); ?>
                        </p>
                    <?php endif; endfor; ?>
            </div>
        </div>
        <div class="footer-bottom-flex">
            <p>&copy; <?php echo date('Y'); ?> Gold Pe Cash. All rights reserved.</p>
            <p>Developed by <a href="https://globalwebify.com/" target="_blank">GlobalWebify</a></p>
        </div>
    </div>
</footer>

<script src="assets/js/main.js"></script>

<!-- Emergency Hamburger Override Script -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function forceHamburger() {
            var hamburger = document.querySelector('.hamburger');
            if (window.innerWidth <= 992 && hamburger) {
                hamburger.style.setProperty('display', 'flex', 'important');
                hamburger.style.setProperty('visibility', 'visible', 'important');
                hamburger.style.setProperty('opacity', '1', 'important');

                // Extra failsafe to ensure the spans inside are white and visible
                var spans = hamburger.querySelectorAll('span');
                spans.forEach(function (s) {
                    s.style.setProperty('background-color', '#ffffff', 'important');
                    s.style.setProperty('display', 'block', 'important');
                });
            } else if (window.innerWidth > 992 && hamburger) {
                hamburger.style.setProperty('display', 'none', 'important');
            }
        }

        forceHamburger();
        window.addEventListener("resize", forceHamburger);
    });
</script>

</body>

</html>