<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
// services.php — General Services Page
$pageTitle = "Our Services | Gold Pe Cash";
$metaDescription = "Gold, Silver and Diamond buying services in Ranchi. Best rates, instant cash, transparent process.";
$seoKey = 'services';

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

<!-- Section 2: Services Grid Overview — Each card has its own unique image -->
<section class="section-padding" style="background: var(--white);">
    <div class="container">
        <p class="section-label">WHAT WE OFFER</p>
        <h2 class="section-heading">Our Buying &amp; Release Services</h2>
        <div class="services-grid" style="margin-top: 40px;">

            <!-- Card 1: Gold -->
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-crown"></i></div>
                <h3>Cash for Gold</h3>
                <p>Sell your old gold jewelry, coins, or scrap for the highest market price.</p>
                <a href="cash-on-gold/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">Read More</a>
            </div>

            <!-- Card 2: Silver -->
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-coins"></i></div>
                <h3>Cash for Silver</h3>
                <p>We buy silver coins, utensils, and ornaments at transparent market rates.</p>
                <a href="cash-on-silver/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">Read
                    More</a>
            </div>

            <!-- Card 3: Diamond -->
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-gem"></i></div>
                <h3>Cash for Diamond</h3>
                <p>Expert valuation for diamond jewelry based on 4Cs. Best value guaranteed.</p>
                <a href="cash-on-diamond/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">Read
                    More</a>
            </div>

            <!-- Card 4: Gold Release -->
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-unlock-alt"></i></div>
                <h3>Gold Release</h3>
                <p>Release pledged gold from banks and sell it to us at best market rates.</p>
                <a href="gold-bailout-valuation/" class="btn btn-red" style="padding: 8px 20px; font-size: 0.8rem;">Read
                    More</a>
            </div>

        </div>
    </div>
</section>

<!-- Section 3: Gold Buying — uses service-gold-final.png (different from card above) -->
<section id="gold-section" class="section-padding" style="background: var(--cream-dark);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/service-gold-final.png" alt="Cash for Gold - Gold Pe Cash"
                    style="width:100%; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
            <div>
                <p class="section-label">SERVICE 01</p>
                <h2 class="section-heading">Cash for Gold</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    We offer the <strong>highest market price</strong> for all types of gold — jewelry, coins, bars, and
                    scrap. Our certified appraisers use German XRF KARATMETER technology to test purity precisely, right
                    in front of you. No melting, no chemicals — just accurate results and instant cash.
                </p>
                <ul class="trusted-features-list">
                    <li><i class="fas fa-check-circle"></i> All Karat Gold Accepted (14K, 18K, 22K, 24K)</li>
                    <li><i class="fas fa-check-circle"></i> Jewelry, Coins, Bars, and Scrap All Bought</li>
                    <li><i class="fas fa-check-circle"></i> Instant Cash / NEFT / IMPS Payment</li>
                    <li><i class="fas fa-check-circle"></i> Best Rate — No Hidden Deductions</li>
                </ul>
                <a href="contact/?service=gold" class="btn btn-red" style="margin-top: 25px;">Get a Free Gold
                    Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Silver Buying — uses service-silver-final.png -->
<section id="silver-section" class="section-padding" style="background: var(--white);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <p class="section-label">SERVICE 02</p>
                <h2 class="section-heading">Cash for Silver</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    Turn old silver coins, silverware, or ornaments into <strong>instant cash</strong>. We evaluate
                    silver using precision weighing scales and offer rates directly linked to live silver market prices.
                    Fast, transparent, and hassle-free.
                </p>
                <ul class="trusted-features-list">
                    <li><i class="fas fa-check-circle"></i> Silver Coins, Utensils, Jewelry, Bars Accepted</li>
                    <li><i class="fas fa-check-circle"></i> Accurate Weighing Done in Front of You</li>
                    <li><i class="fas fa-check-circle"></i> Rates Linked to Live Silver Market Price</li>
                    <li><i class="fas fa-check-circle"></i> Same-Day Payment — Cash or Bank Transfer</li>
                </ul>
                <a href="contact/?service=silver" class="btn btn-red" style="margin-top: 25px;">Get a Free Silver
                    Quote</a>
            </div>
            <div>
                <img src="assets/images/service-silver-final.png" alt="Cash for Silver - Gold Pe Cash"
                    style="width:100%; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- Section 5: Diamond Buying — uses service-diamond-final.png -->
<section id="diamond-section" class="section-padding" style="background: var(--cream-dark);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/service-diamond-final.png" alt="Cash for Diamond - Gold Pe Cash"
                    style="width:100%; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
            <div>
                <p class="section-label">SERVICE 03</p>
                <h2 class="section-heading">Cash for Diamond</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    Our trained gemologists evaluate your diamonds based on <strong>4Cs: Cut, Color, Clarity, and Carat
                        Weight</strong>. You receive a fair, transparent valuation and instant payment — for loose
                    diamonds and diamond jewelry alike.
                </p>
                <ul class="trusted-features-list">
                    <li><i class="fas fa-check-circle"></i> Loose Diamonds and Diamond Jewelry Accepted</li>
                    <li><i class="fas fa-check-circle"></i> Valuation Based on International 4C Standards</li>
                    <li><i class="fas fa-check-circle"></i> Certified Gemologists on Site</li>
                    <li><i class="fas fa-check-circle"></i> Immediate Payment After Evaluation</li>
                </ul>
                <a href="contact/?service=diamond" class="btn btn-red" style="margin-top: 25px;">Get a Free Diamond
                    Quote</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Gold Release — uses trusted-appraisal.png -->
<section id="bailout-section" class="section-padding" style="background: var(--white);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <p class="section-label">SERVICE 04</p>
                <h2 class="section-heading">Gold Release Service</h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    If your gold is pledged at a bank or NBFC (Muthoot, Manappuram, SBI Gold Loan etc.), we
                    <strong>release it for you</strong> and buy it at best market rate — putting more money in your
                    hands than your loan balance.
                </p>
                <ul class="trusted-features-list">
                    <li><i class="fas fa-check-circle"></i> Gold Released from Any Bank or Finance Company</li>
                    <li><i class="fas fa-check-circle"></i> We Handle All Release Paperwork</li>
                    <li><i class="fas fa-check-circle"></i> You Receive the Surplus Amount Immediately</li>
                    <li><i class="fas fa-check-circle"></i> Completely Legal and Transparent Process</li>
                </ul>
                <a href="gold-bailout-valuation/" class="btn btn-red" style="margin-top: 25px;">Learn About Gold
                    Release</a>
            </div>
            <div>
                <img src="assets/images/trusted-appraisal.png" alt="Gold Release Service"
                    style="width:100%; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
        </div>
    </div>
</section>

<!-- Section 7: How It Works — uses support-team.png -->
<section class="section-padding" style="background: var(--cream-dark);">
    <div class="container">
        <div class="trusted-layout">
            <div>
                <img src="assets/images/support-team.png" alt="How It Works at Gold Pe Cash"
                    style="width:100%; max-height:420px; object-fit:cover; border-radius: var(--radius-lg); box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
            </div>
            <div>
                <p class="section-label">SIMPLE PROCESS</p>
                <h2 class="section-heading">How To Sell Your Gold?</h2>
                <ul class="trusted-features-list" style="margin-top: 25px;">
                    <li><i class="fas fa-store" style="color: var(--gold);"></i> <strong>Step 1:</strong> Visit our
                        nearest branch in Ranchi with your items and ID proof</li>
                    <li><i class="fas fa-microscope" style="color: var(--gold);"></i> <strong>Step 2:</strong> Free
                        valuation using German KARATMETER technology in front of you</li>
                    <li><i class="fas fa-hand-holding-usd" style="color: var(--gold);"></i> <strong>Step 3:</strong> Get
                        Cash, NEFT or IMPS immediately after gold verification</li>
                    <li><i class="fas fa-thumbs-up" style="color: var(--gold);"></i> <strong>Step 4:</strong> Best rate
                        guaranteed — based on today's live market price</li>
                </ul>
                <a href="contact/" class="btn btn-red" style="margin-top: 25px;">Visit Us Today</a>
            </div>
        </div>
    </div>
</section>

<!-- Section 8: Why Choose Us (feature boxes) -->
<section class="section-padding" style="background: var(--white);">
    <div class="container">
        <p class="section-label text-center">THE GOLD PE CASH PROMISE</p>
        <h2 class="section-heading text-center">Why Choose Us?</h2>
        <div class="features-grid" style="margin-top: 40px;">
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-user-shield"></i></div>
                <h4>Trusted Experts</h4>
                <p>Years of experience and thousands of happy customers across Ranchi.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                <h4>Instant Cash</h4>
                <p>Receive payment the same moment your gold is verified. No waiting.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <h4>Secure &amp; Transparent</h4>
                <p>Fully licensed, legally compliant with 100% transparent evaluation.</p>
            </div>
            <div class="feature-box">
                <div class="feature-icon"><i class="fas fa-award"></i></div>
                <h4>Best Value</h4>
                <p>We always give you the highest possible rate for your gold and silver.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 9: Contact -->
<section class="section-padding contact-section-wrapper">
    <div class="container">
        <p class="section-label">HAVE QUESTIONS?</p>
        <h2 class="section-heading">Contact Us</h2>
        <div class="contact-layout">
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
                                <span><?php echo htmlspecialchars($addr); ?></span>
                            </div>
                        <?php endif; endfor; ?>
                </div>
            </div>

            <!-- Form: Right Side -->
            <div>
                <form class="contact-form" action="submit_contact.php" method="POST">
                    <h3><i class="fas fa-paper-plane" style="color:#c8a84b; margin-right:10px;"></i>Send Us a Message
                    </h3>
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:15px; margin-bottom:15px;">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                    <div style="margin-bottom:15px;">
                        <input type="email" name="email" placeholder="Email Address">
                    </div>
                    <div style="margin-bottom:15px;">
                        <select name="service" required>
                            <option value="">Select a Service</option>
                            <option value="cash_on_gold">Cash on Gold</option>
                            <option value="cash_on_silver">Cash on Silver</option>
                            <option value="cash_on_diamond">Cash on Diamond</option>
                            <option value="gold_bailout">Gold Bailout / Release</option>
                        </select>
                    </div>
                    <div style="margin-bottom:15px;">
                        <textarea name="message" placeholder="Your Message"></textarea>
                    </div>
                    <button type="submit" class="btn btn-red"
                        style="width:100%; padding:16px; font-size:1rem; letter-spacing:1px;">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>