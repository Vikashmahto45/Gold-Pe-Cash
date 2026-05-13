<?php
// index.php — Homepage (Fully Dynamic)
$pageTitle = "Gold Pe Cash | Premier Gold Buyers in Ranchi";
$metaDescription = "Premium service for selling gold, silver, and diamonds in Ranchi. Instant cash, transparent valuation, and best market rates.";
$seoKey = 'home';

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';

// Load all settings at once
$S = getAllSettings();
?>

<!-- Section 1: Hero Banner -->
<section class="hero-section">
    <div class="container" style="text-align: center; position: relative; z-index: 2;">

        <div style="margin-bottom: 20px; display: flex; justify-content: center; gap: 15px; opacity: 0.5;">
            <i class="fas fa-crown" style="font-size: 1.2rem; color: var(--gold);"></i>
            <i class="fas fa-gem" style="font-size: 1.2rem; color: var(--gold);"></i>
            <i class="fas fa-crown" style="font-size: 1.2rem; color: var(--gold);"></i>
        </div>

        <p
            style="color: var(--gold); text-transform: uppercase; letter-spacing: 4px; font-size: 0.85rem; font-weight: 600; margin-bottom: 15px;">
            <?php echo htmlspecialchars(s($S, 'hero_tagline', "Ranchi's Most Trusted Gold Buyers")); ?>
        </p>

        <h1 class="home-hero-title"
            style="font-size: 3.5rem; color: white; margin-bottom: 25px; line-height: 1.2; max-width: 800px; margin-left: auto; margin-right: auto;">
            <?php echo htmlspecialchars(s($S, 'hero_heading', 'Get Cash for Your Gold,')); ?><br>
            <span
                style="color: var(--gold);"><?php echo htmlspecialchars(s($S, 'hero_heading_gold', 'Anytime, Anywhere')); ?></span>
        </h1>

        <p class="home-hero-desc"
            style="font-size: 1.15rem; color: rgba(255,255,255,0.8); max-width: 650px; margin: 0 auto 35px; line-height: 1.8;">
            <?php echo htmlspecialchars(s($S, 'hero_text', 'Get instant cash for your precious items — gold, diamonds, silver, and stones.')); ?>
        </p>

        <div class="home-hero-btns"
            style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 50px;">
            <a href="contact/" class="btn btn-gold" style="padding: 16px 40px; font-size: 1rem;">Get a Free Quote</a>
            <a href="tel:<?php echo htmlspecialchars(s($S, 'phone', '+919576889595')); ?>" class="btn btn-outline-white"
                style="padding: 16px 40px; font-size: 1rem;"><i class="fas fa-phone-alt"
                    style="margin-right: 8px;"></i>Call Now</a>
        </div>

        <div class="home-hero-stats" style="display: flex; justify-content: center; gap: 40px; flex-wrap: wrap;">
            <div class="stat-item" style="text-align: center;">
                <div class="stat-number"
                    style="font-size: 1.8rem; font-weight: 700; color: var(--gold); font-family: var(--font-heading);">
                    <?php echo htmlspecialchars(s($S, 'stat1_number', '1,000+')); ?>
                </div>
                <div class="stat-label"
                    style="font-size: 0.8rem; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px;">
                    <?php echo htmlspecialchars(s($S, 'stat1_label', 'Happy Customers')); ?>
                </div>
            </div>
            <div class="stat-divider" style="width: 1px; background: rgba(255,255,255,0.2);"></div>
            <div class="stat-item" style="text-align: center;">
                <div class="stat-number"
                    style="font-size: 1.8rem; font-weight: 700; color: var(--gold); font-family: var(--font-heading);">
                    6</div>
                <div class="stat-label"
                    style="font-size: 0.8rem; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px;">
                    Branches in Ranchi</div>
            </div>
            <div class="stat-divider" style="width: 1px; background: rgba(255,255,255,0.2);"></div>
            <div class="stat-item" style="text-align: center;">
                <div class="stat-number"
                    style="font-size: 1.8rem; font-weight: 700; color: var(--gold); font-family: var(--font-heading);">
                    <?php echo htmlspecialchars(s($S, 'stat3_number', '4.8')); ?> ★
                </div>
                <div class="stat-label"
                    style="font-size: 0.8rem; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 1px;">
                    <?php echo htmlspecialchars(s($S, 'stat3_label', 'Customer Rating')); ?>
                </div>
            </div>
        </div>

        <!-- Mobile Live Rates Module -->
        <div class="mobile-live-rates">
            <div style="font-size: 0.65rem; color: rgba(255,255,255,0.7); margin-bottom: 8px; width: 100%; text-align: center; font-weight: 500; letter-spacing: 1px;">
                <i class="fas fa-sync-alt" style="margin-right: 4px;"></i> LIVE RATES
            </div>
            
            <div class="rate-item-mob">
                <span class="rate-mob-text">
                    <span class="rate-mob-title">1g of Gold in Indian Rupee</span>
                    <strong class="rate-mob-amount"><i class="fas fa-crown" style="color: #ffd700;"></i> ₹<?php echo s($S, 'gold_rate', '6,250'); ?></strong>
                </span>
            </div>
            <div class="rate-item-mob">
                <span class="rate-mob-text">
                    <span class="rate-mob-title">1g of Silver in Indian Rupee</span>
                    <strong class="rate-mob-amount"><i class="fas fa-ring" style="color: #c0c0c0;"></i> ₹<?php echo s($S, 'silver_rate', '74.50'); ?></strong>
                </span>
            </div>
        </div>

    </div>
</section>

<!-- Section 2: Today's Buying Rates -->
<section class="rate-strip-section">
    <div class="container">
        <p class="rate-strip-label"><span class="live-dot"></span><i class="fas fa-sync-alt" style="margin-right: 8px;"></i> LIVE BUYING RATES —
            UPDATED DAILY</p>
        <h2 class="rate-strip-heading">Today We Are Buying At These Prices</h2>
        <p style="color: rgba(255,255,255,0.7); margin-bottom: 35px; font-size: 0.95rem;">Sell your Gold, Silver or
            Diamond to us and get instant cash at the best market rates in Ranchi</p>
        <div class="rate-cards">
            <div class="rate-card">
                <div
                    style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; justify-content: center;">
                    <i class="fas fa-crown" style="color: var(--gold); font-size: 1.3rem;"></i>
                    <span style="font-weight: 600; color: var(--maroon); font-size: 0.8rem; letter-spacing: 1px;">1g
                        of Gold in Indian Rupee</span>
                </div>
                <div class="rate-value">₹ <?php echo htmlspecialchars(s($S, 'gold_rate', '6,250')); ?></div>
                <div class="rate-label" style="color: #27ae60; font-weight: 600;"><i class="fas fa-hand-holding-usd"
                        style="margin-right: 5px;"></i>We Pay You</div>
            </div>
            <div class="rate-card">
                <div
                    style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; justify-content: center;">
                    <i class="fas fa-ring" style="color: #aaa; font-size: 1.3rem;"></i>
                    <span style="font-weight: 600; color: var(--maroon); font-size: 0.8rem; letter-spacing: 1px;">1g
                        of Silver in Indian Rupee</span>
                </div>
                <div class="rate-value">₹ <?php echo htmlspecialchars(s($S, 'silver_rate', '74.50')); ?></div>
                <div class="rate-label" style="color: #27ae60; font-weight: 600;"><i class="fas fa-hand-holding-usd"
                        style="margin-right: 5px;"></i>We Pay You</div>
            </div>
        </div>
        <div style="margin-top: 30px;">
            <a href="contact/" class="btn btn-gold" style="padding: 14px 35px;">Sell Your Gold Now <i
                    class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
</section>

<!-- Section 3: Trusted Buyers -->
<section class="section-padding trusted-section-new">
    <div class="container">
        <div class="trusted-main-grid">
            <!-- Left: Content -->
            <div>
                <p class="section-label">Premium Gold Buyers</p>
                <h2 class="section-heading">
                    <?php echo htmlspecialchars(s($S, 'trusted_heading', 'Trusted Buyers of Gold, Silver & Diamonds')); ?>
                </h2>
                <p style="color: var(--text-muted); margin-bottom: 20px; line-height: 1.8;">
                    <?php echo htmlspecialchars(s($S, 'trusted_text1', '')); ?>
                </p>
                <p style="color: var(--text-muted); margin-bottom: 30px; line-height: 1.8;">
                    <?php echo htmlspecialchars(s($S, 'trusted_text2', '')); ?>
                </p>
                <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                    <a href="contact/" class="btn btn-red">Contact Us</a>
                    <a href="tel:<?php echo htmlspecialchars(s($S, 'phone', '+919576889595')); ?>"
                        class="btn btn-outline-dark"><i class="fas fa-phone-alt" style="margin-right: 8px;"></i>Call
                        Now</a>
                </div>
            </div>

            <!-- Right: Feature Highlights -->
            <div class="trusted-highlights-grid">
                <div class="trust-highlight-card">
                    <div class="trust-icon"><i class="fas fa-microscope"></i></div>
                    <h4>Advanced Testing</h4>
                    <p>Karatmeter purity testing — accurate to 99.9%</p>
                </div>
                <div class="trust-highlight-card">
                    <div class="trust-icon"><i class="fas fa-money-check-alt"></i></div>
                    <h4>Instant Payment</h4>
                    <p>Cash, bank transfer, or cheque — your choice</p>
                </div>
                <div class="trust-highlight-card">
                    <div class="trust-icon"><i class="fas fa-user-shield"></i></div>
                    <h4>100% Transparent</h4>
                    <p>Testing done openly in front of you — no surprises</p>
                </div>
                <div class="trust-highlight-card">
                    <div class="trust-icon"><i class="fas fa-map-marked-alt"></i></div>
                    <h4>6 Branches</h4>
                    <p>Conveniently located across Ranchi for easy access</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 4: Our Services -->
<section class="services-section-new section-padding">
    <div class="container">
        <p class="section-label" style="color: var(--gold); text-align: center;">OUR EXPERTISE</p>
        <h2 class="section-heading" style="color: var(--white); text-align: center;">Premium Services</h2>
        <div class="services-grid-new" style="margin-top: 50px;">
            <div class="service-card-new">
                <div class="service-card-icon"><i class="fas fa-crown"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service1_title', 'Premier Gold Buying')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service1_text', 'We provide the best rates in Ranchi, unlocking the true worth of your gold with precision karatmeter testing.')); ?>
                </p>
                <a href="gold-pe-cash-services/?type=gold" class="service-link">Learn More <i
                        class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-new">
                <div class="service-card-icon"><i class="fas fa-unlock-alt"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service2_title', 'Gold Loan Release')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service2_text', 'Trapped in high-interest loans? We release your pledged gold from banks and settle the difference in cash.')); ?>
                </p>
                <a href="gold-bailout-valuation/" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-new">
                <div class="service-card-icon"><i class="fas fa-home"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service3_title', 'Doorstep Service')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service3_text', 'Experience our premium service from the comfort of your home. Secure, private, and convenient.')); ?>
                </p>
                <a href="gold-pe-cash-services/" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="service-card-new">
                <div class="service-card-icon"><i class="fas fa-money-bill-wave"></i></div>
                <h3><?php echo htmlspecialchars(s($S, 'service4_title', 'Instant Liquidity')); ?></h3>
                <p><?php echo htmlspecialchars(s($S, 'service4_text', 'Sell your gold for instant cash or bank transfer. A transparent, legitimate process for your peace of mind.')); ?>
                </p>
                <a href="contact/" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Section 4.5: Financial Solution (Story Mode) -->
<section class="solution-section section-padding">
    <div class="container">
        <div class="solution-grid">
            <div class="solution-image-col">
                <div class="solution-image-wrapper">
                    <img src="<?php echo htmlspecialchars(s($S, 'home_story_img', 'assets/images/comic-story.png')); ?>"
                        alt="Anjali's Journey from Debt to Relief - Comic Strip Story">
                </div>
            </div>
            <div class="solution-content-col">
                <p class="section-label" style="color: var(--maroon);">REAL STORIES</p>
                <h2 class="section-heading" style="color: var(--text-dark); margin-bottom: 20px;">Overcome Financial
                    Stress with Your Own Gold</h2>
                <p class="solution-text">
                    Life can be unpredictable. Unexpected debts, business needs, or family emergencies can create
                    immense pressure. Many of our customers, just like <strong>Anjali from Ranchi</strong>, found
                    themselves overwhelmed by high-interest loans while owning valuable idle gold.
                </p>
                <p class="solution-text">
                    Instead of letting debt pile up, she chose to unlock the value of her gold. With <strong>Gold Pe
                        Cash</strong>, she received an instant, fair market cash payment that helped her clear her debts
                    immediately.
                </p>
                <div class="solution-highlight">
                    <div class="highlight-icon"><i class="fas fa-shield-alt"></i></div>
                    <div>
                        <h4>Debt-Free Tomorrow</h4>
                        <p>Turn your gold into a tool for financial freedom today. Transparent valuation, instant
                            payment.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Section 5: Why Choose Us -->
<section class="choose-us-section section-padding">
    <div class="container">
        <h2 class="section-heading text-center" style="color: var(--maroon);">Why Choose Us to Selling Your Old Gold
        </h2>
        <div class="choose-grid">
            <div class="choose-card">
                <div class="choose-icon"><i class="fas fa-user-check"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'feature1_title', 'Expert Appraisal')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'feature1_text', 'Our certified experts use karatmeter to determine exact purity. Fair price guaranteed.')); ?>
                </p>
            </div>
            <div class="choose-card">
                <div class="choose-icon"><i class="fas fa-tags"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'feature2_title', 'Fair Prices')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'feature2_text', 'We offer the best competitive market rates. 100% transparent pricing with no hidden charges.')); ?>
                </p>
            </div>
            <div class="choose-card">
                <div class="choose-icon"><i class="fas fa-map-marker-alt"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'feature3_title', '6 Branches')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'feature3_text', '6 branches across Ranchi for easy access. Plus doorstep pickup available.')); ?>
                </p>
            </div>
            <div class="choose-card">
                <div class="choose-icon"><i class="fas fa-eye"></i></div>
                <h4><?php echo htmlspecialchars(s($S, 'feature4_title', 'Transparent Process')); ?></h4>
                <p><?php echo htmlspecialchars(s($S, 'feature4_text', 'Testing done in front of you. No hidden charges. Full documentation provided.')); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Section 6: Testimonials + Promo -->
<!-- Section 6: Testimonials + Promo -->
<section class="testimonials-section-new section-padding">
    <div class="container">
        <div class="testimonials-layout">
            <!-- Left: Promo CTA -->
            <div class="promo-box-new">
                <div class="promo-content">
                    <h2 class="promo-heading">LOOKING TO SELL YOUR GOLD?</h2>
                    <p class="promo-text">Get Best Value & Instant Payment!</p>
                    <a href="contact/" class="btn btn-gold promo-btn">Contact Us Now</a>
                </div>
                <div class="promo-decoration"></div>
            </div>

            <!-- Right: Testimonials Grid -->
            <div class="testimonials-content">
                <h2 class="section-heading" style="color: var(--text-dark); margin-bottom: 30px;">What People Say About
                    Us</h2>
                <div class="testimonials-grid-new">
                    <div class="testi-card-new">
                        <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p>"<?php echo htmlspecialchars(s($S, 'testi1_text', 'Highly recommend Gold Pe Cash. They are trustworthy buyers who gave me maximum value. The evaluation was fair and completely transparent.')); ?>"
                        </p>
                        <div class="testi-author">
                            <h4><?php echo htmlspecialchars(s($S, 'testi1_name', 'Puja Kumari')); ?></h4>
                            <span><?php echo htmlspecialchars(s($S, 'testi1_location', 'Ranchi')); ?></span>
                        </div>
                    </div>
                    <div class="testi-card-new">
                        <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p>"<?php echo htmlspecialchars(s($S, 'testi2_text', 'I was impressed with their honest evaluation and fast payment. Very reliable service with no hidden charges.')); ?>"
                        </p>
                        <div class="testi-author">
                            <h4><?php echo htmlspecialchars(s($S, 'testi2_name', 'Reena Rao')); ?></h4>
                            <span><?php echo htmlspecialchars(s($S, 'testi2_location', 'Satisfied Customer')); ?></span>
                        </div>
                    </div>
                    <div class="testi-card-new">
                        <div class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                        <p>"<?php echo htmlspecialchars(s($S, 'testi3_text', 'No hidden charges, fair value, and instant cash on the spot. I felt completely safe and satisfied throughout the process.')); ?>"
                        </p>
                        <div class="testi-author">
                            <h4><?php echo htmlspecialchars(s($S, 'testi3_name', 'Vikash')); ?></h4>
                            <span><?php echo htmlspecialchars(s($S, 'testi3_location', 'Loyal Client')); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 7: How It Works -->
<!-- Section 7: How It Works -->
<section class="process-section-new section-padding">
    <div class="container">
        <h2 class="section-heading text-center" style="margin-bottom: 60px;">How It Works</h2>
        <div class="process-grid">
            <div class="process-card-new">
                <div class="step-badge">01</div>
                <div class="process-icon">
                    <i class="fas fa-gem"></i>
                </div>
                <h4>Evaluation</h4>
                <p>Bring your Gold, Silver or Diamond. We test purity using advanced karatmeter right before your eyes.
                </p>
                <div class="process-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="process-card-new">
                <div class="step-badge">02</div>
                <div class="process-icon">
                    <i class="fas fa-calculator"></i>
                </div>
                <h4>Appraisal</h4>
                <p>Our experts provide a precise, market-value based quote instantly with zero hidden charges.</p>
                <div class="process-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="process-card-new">
                <div class="step-badge">03</div>
                <div class="process-icon">
                    <i class="fas fa-handshake"></i>
                </div>
                <h4>Acceptance</h4>
                <p>Review the offer at your own pace. No pressure, just a transparent deal you can trust.</p>
                <div class="process-arrow"><i class="fas fa-chevron-right"></i></div>
            </div>
            <div class="process-card-new">
                <div class="step-badge">04</div>
                <div class="process-icon">
                    <i class="fas fa-rupee-sign"></i>
                </div>
                <h4>Instant Cash</h4>
                <p>Accept the offer and walk out with immediate cash, bank transfer, or cheque. Simple as that.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 8: CTA Banner -->
<section class="cta-section">
    <div class="container" style="position: relative; z-index: 2;">
        <h2 style="color: white; font-size: 2.5rem; margin-bottom: 15px;">Sell Your Gold For Cash</h2>
        <p style="font-size: 1.2rem; margin-bottom: 30px; opacity: 0.9;">Get Instant Cash Now! Call us or visit any of
            our 6 branches in Ranchi.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="tel:<?php echo htmlspecialchars(s($S, 'phone', '+919576889595')); ?>" class="btn btn-gold">Call
                Now</a>
            <a href="contact/" class="btn btn-outline-white">Contact Us</a>
        </div>
    </div>
</section>

<!-- Section 9: Stats -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div>
                    <div class="stat-number"><?php echo htmlspecialchars(s($S, 'stat1_number', '1,000+')); ?></div>
                    <div class="stat-label"><?php echo htmlspecialchars(s($S, 'stat1_label', 'Happy Customers')); ?>
                    </div>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-award"></i></div>
                <div>
                    <div class="stat-number"><?php echo htmlspecialchars(s($S, 'stat2_number', '10+')); ?></div>
                    <div class="stat-label"><?php echo htmlspecialchars(s($S, 'stat2_label', 'Years of Trust')); ?>
                    </div>
                </div>
            </div>
            <div class="stat-box">
                <div class="stat-icon"><i class="fas fa-star"></i></div>
                <div>
                    <div class="stat-number"><?php echo htmlspecialchars(s($S, 'stat3_number', '4.8')); ?></div>
                    <div class="stat-label"><?php echo htmlspecialchars(s($S, 'stat3_label', 'Google Rating')); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>