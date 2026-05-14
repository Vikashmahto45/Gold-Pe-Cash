<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
// about.php — About Us Page (Fully Dynamic)
$pageTitle = "About Us | Gold Pe Cash";
$metaDescription = "Learn about Gold Pe Cash — Ranchi's most trusted buyers of gold, silver, and diamonds.";
$seoKey = 'about';

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$S = getAllSettings();
?>

<style>
    /* Make the transparent fixed header solid since there is no hero banner anymore */
    header {
        background: var(--navy) !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
    }

    body {
        padding-top: 70px;
        /* Offset for the fixed header */
    }
</style>

<!-- Section 2: Trusted Buyers -->
<section class="section-padding" style="background: var(--white);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="<?php echo htmlspecialchars(s($S, 'about_trusted_img', 'assets/images/trusted-appraisal.png')); ?>"
                    alt="Professional Gold Appraisal at Gold Pe Cash"
                    style="width: 100%; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
            </div>
            <div>
                <h2 class="section-heading">
                    <?php echo htmlspecialchars(s($S, 'about_heading', 'Trusted Buyers of Gold, Silver & Diamonds')); ?>
                </h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    <?php echo htmlspecialchars(s($S, 'about_text1', 'At Gold Pe Cash, we believe in providing a fair and transparent gold evaluation process. Our experienced appraisers ensure you receive the highest value for your gold using state-of-the-art technology.')); ?>
                </p>

                <ul class="trusted-features-list">
                    <li><i class="fas fa-check-circle"></i> Instant Cash Payment</li>
                    <li><i class="fas fa-check-circle"></i> 100% Transparent Process</li>
                    <li><i class="fas fa-check-circle"></i> Best Market Rates Guaranteed</li>
                    <li><i class="fas fa-check-circle"></i> No Hidden Charges</li>
                </ul>
                <a href="gold-pe-cash-services/" class="btn btn-red">Explore Our Services</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 3: Why Choose Gold Pe Cash? -->
<section class="section-padding" style="background: var(--cream-dark);">
    <div class="container">
        <p class="section-label text-center">OUR PROCESS</p>
        <h2 class="section-heading text-center">Why Choose Gold Pe Cash?</h2>
        <div class="features-grid" style="margin-top: 40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'about_feature1_title', 'Trusted Experts')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'about_feature1_text', '')); ?></p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-hand-holding-usd"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'about_feature2_title', 'Instant Cash Facility')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'about_feature2_text', '')); ?></p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'about_feature3_title', 'Secure & Transparent Process')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'about_feature3_text', '')); ?></p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-thumbs-up"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'about_feature4_title', 'Best Value Guaranteed')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'about_feature4_text', '')); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: FAQ -->
<section class="section-padding faq-section">
    <div class="container">
        <div class="faq-grid-new">
            <div>
                <h2 style="color: white; font-size: 2.2rem; margin-bottom: 30px;">Frequently Asked Questions</h2>
                <div>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <div class="faq-item <?php echo $i === 1 ? 'active' : ''; ?>">
                            <div class="faq-question">
                                <?php echo htmlspecialchars(s($S, "faq{$i}_q", "Question $i")); ?>
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="faq-answer">
                                <?php echo htmlspecialchars(s($S, "faq{$i}_a", "Answer $i")); ?>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
            <div>
                <img src="<?php echo htmlspecialchars(s($S, 'about_team_img', 'assets/images/support-team.png')); ?>" alt="Gold Pe Cash Customer Support Team"
                    style="width: 100%; max-height: 400px; object-fit: cover; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Our Services Preview -->
<section class="section-padding" style="background: var(--cream-dark);">
    <div class="container">
        <p class="section-label">UNLOCKING THE TRUE WORTH OF PURE GOLD</p>
        <h2 class="section-heading">Our Services</h2>
        <div class="services-grid" style="margin-top: 40px;">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-crown"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service1_title', 'Leading Gold Buyer In Ranchi')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service1_text', '')); ?></p>
                <a href="gold-pe-cash-services/?type=gold" class="btn btn-red"
                    style="padding: 8px 20px; font-size: 0.8rem;">View
                    More</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-unlock-alt"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service2_title', 'Release Pledged Gold Service')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service2_text', '')); ?></p>
                <a href="gold-bailout-valuation/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">View
                    More</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-home"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service3_title', 'Doorstep Gold Selling Service')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service3_text', '')); ?></p>
                <a href="gold-pe-cash-services/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">View
                    More</a>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-money-bill-wave"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service4_title', 'Sell Gold for Instant Cash')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service4_text', '')); ?></p>
                <a href="contact/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">View More</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Contact Us -->
<section class="section-padding contact-section-wrapper">
    <div class="container">
        <p class="section-label">HAVE QUESTIONS?</p>
        <h2 class="section-heading">Contact Us</h2>
        <div class="contact-layout">

            <!-- Row 1 Left: Info Box -->
            <div class="contact-info-box">
                <div class="contact-info-item">
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:<?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>">
                        <?php echo htmlspecialchars(s($S, 'email', 'info@goldpecash.com')); ?>
                    </a>
                </div>
                <div class="contact-info-item">
                    <i class="fas fa-phone-alt"></i>
                    <a href="tel:<?php echo htmlspecialchars(s($S, 'phone', '+91-9576889595')); ?>">
                        <?php echo htmlspecialchars(s($S, 'phone', '+91-9576889595')); ?>
                    </a>
                </div>
                <div class="contact-info-item">
                    <i class="fab fa-whatsapp"></i>
                    <a
                        href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', s($S, 'whatsapp', '919576889595')); ?>">
                        <?php echo htmlspecialchars(s($S, 'whatsapp', '+91-9576889595')); ?>
                    </a>
                </div>
                <div class="branch-list">
                    <h4>Our Branches</h4>
                    <?php for ($i = 1; $i <= 7; $i++): ?>
                        <?php $addr = s($S, "address$i", '');
                        if ($addr): ?>
                            <div class="branch-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($addr); ?>" target="_blank" rel="noopener" style="color:inherit; text-decoration:none; transition: color 0.3s;" onmouseover="this.style.color='#c8a84b'" onmouseout="this.style.color='inherit'">
                                    <span><?php echo htmlspecialchars($addr); ?></span>
                                </a>
                            </div>
                        <?php endif; endfor; ?>
                </div>
            </div>

            <!-- Form: Right Side -->
            <div>
                <form class="contact-form" action="submit_contact.php" method="POST">
                    <h3><i class="fas fa-paper-plane" style="color:#c8a84b; margin-right:10px;"></i>Send Us a Message
                    </h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div style="margin-bottom: 15px;">
                        <select name="service" required>
                            <option value="">Select a Service</option>
                            <option value="cash_on_gold">Cash on Gold</option>
                            <option value="cash_on_silver">Cash on Silver</option>
                            <option value="cash_on_diamond">Cash on Diamond</option>
                            <option value="gold_bailout">Gold Bailout / Release</option>
                            <option value="doorstep">Doorstep Service</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <textarea name="message" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-red"
                        style="width: 100%; padding:16px; font-size:1rem; letter-spacing:1px;">SUBMIT</button>
                </form>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>