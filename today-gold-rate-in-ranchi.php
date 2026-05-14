<?php
if (function_exists('opcache_reset')) {
    opcache_reset();
}
$pageTitle = "Today Gold Rate in Ranchi 22k and 24k | Gold Pe Cash";
$metaDescription = "Check Today Gold Rate in Ranchi for 22k and 24k. Get live Ranchi gold price, market trends, and best value for your jewelry at Gold Pe Cash.";
$seoKey = 'gold_rate_ranchi';

include 'includes/db.php';
include 'includes/functions.php';
include 'includes/header.php';

$S = getAllSettings();
?>

<style>
    .rate-hero {
        background: linear-gradient(135deg, var(--maroon) 0%, #700000 100%);
        padding: 140px 0 80px;
        text-align: center;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .rate-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30L60 60M30 30L0 0M30 30L60 0M30 30L0 60' stroke='rgba(255,255,255,0.03)' stroke-width='1'/%3E%3C/svg%3E");
    }

    .rate-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        margin-bottom: 20px;
        color: var(--gold);
        position: relative;
        z-index: 1;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .container-narrow {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .long-content {
        margin-top: 50px;
        line-height: 2;
        color: #444;
        font-size: 1.1rem;
    }

    .long-content h2 {
        font-family: 'Playfair Display', serif;
        color: var(--maroon);
        font-size: 2.2rem;
        margin: 40px 0 20px;
        border-bottom: 2px solid var(--gold);
        display: inline-block;
        padding-bottom: 5px;
    }

    .long-content h3 {
        color: var(--navy);
        font-size: 1.6rem;
        margin: 30px 0 15px;
    }

    .long-content p {
        margin-bottom: 25px;
    }

    .highlight-box {
        background: var(--cream-dark);
        padding: 30px;
        border-radius: 15px;
        border-left: 5px solid var(--gold);
        margin: 40px 0;
    }

    .keyword-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 20px 0;
    }

    .keyword-tag {
        background: #f0f0f0;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        color: #666;
    }

    @media (max-width: 768px) {
        .rate-hero h1 {
            font-size: 2.2rem;
        }

        .rate-hero {
            padding: 100px 0 40px;
        }

        .rate-strip-section.mobile-visible {
            display: block !important;
        }
    }
</style>

<section class="rate-hero">
    <div class="container">
        <h1><?php echo htmlspecialchars(s($S, 'gold_rate_h1', 'Today Gold Rate in Ranchi 22k and 24k')); ?></h1>

        <!-- Mobile Live Rates Module (Visible only on Mobile) -->
        <div class="mobile-live-rates">
            <div
                style="font-size: 0.65rem; color: rgba(255,255,255,0.7); margin-bottom: 8px; width: 100%; text-align: center; font-weight: 500; letter-spacing: 1px;">
                <span class="live-dot" style="width: 8px; height: 8px; margin-right: 5px;"></span><i class="fas fa-sync-alt" style="margin-right: 4px;"></i> LIVE RATES
            </div>

            <div class="rate-item-mob">
                <span class="rate-mob-text">
                    <span class="rate-mob-title">1g of Gold in Indian Rupee</span>
                    <strong class="rate-mob-amount"><i class="fas fa-crown" style="color: #ffd700;"></i>
                        ₹<?php echo s($S, 'gold_rate', '6,250'); ?></strong>
                </span>
            </div>
            <div class="rate-item-mob">
                <span class="rate-mob-text">
                    <span class="rate-mob-title">1g of Silver in Indian Rupee</span>
                    <strong class="rate-mob-amount"><i class="fas fa-ring" style="color: #c0c0c0;"></i>
                        ₹<?php echo s($S, 'silver_rate', '74.50'); ?></strong>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Section 2: Today's Buying Rates (Same as Homepage) -->
<section class="rate-strip-section" style="padding: 40px 0; border-bottom: 1px solid #eee;">
    <div class="container">
        <p class="rate-strip-label"><span class="live-dot"></span><i class="fas fa-sync-alt" style="margin-right: 8px;"></i> LIVE BUYING RATES —
            UPDATED DAILY</p>
        <h2 class="rate-strip-heading" style="color: white;">Today We Are Buying At These Prices</h2>
        <div class="rate-cards">
            <div class="rate-card">
                <div
                    style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; justify-content: center;">
                    <i class="fas fa-crown" style="color: var(--gold); font-size: 1.3rem;"></i>
                    <span style="font-weight: 600; color: var(--maroon); font-size: 0.8rem; letter-spacing: 1px;">1g of
                        Gold in Indian Rupee</span>
                </div>
                <div class="rate-value">₹ <?php echo htmlspecialchars(s($S, 'gold_rate', '6,250')); ?></div>
                <div class="rate-label" style="color: #27ae60; font-weight: 600;"><i class="fas fa-hand-holding-usd"
                        style="margin-right: 5px;"></i>We Pay You</div>
            </div>
            <div class="rate-card">
                <div
                    style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; justify-content: center;">
                    <i class="fas fa-ring" style="color: #aaa; font-size: 1.3rem;"></i>
                    <span style="font-weight: 600; color: var(--maroon); font-size: 0.8rem; letter-spacing: 1px;">1g of
                        Silver in Indian Rupee</span>
                </div>
                <div class="rate-value">₹ <?php echo htmlspecialchars(s($S, 'silver_rate', '74.50')); ?></div>
                <div class="rate-label" style="color: #27ae60; font-weight: 600;"><i class="fas fa-hand-holding-usd"
                        style="margin-right: 5px;"></i>We Pay You</div>
            </div>
        </div>
        <div style="margin-top: 30px; text-align: center;">
            <a href="contact/" class="btn btn-gold" style="padding: 14px 35px;">Sell Your Gold Now <i
                    class="fas fa-arrow-right" style="margin-left: 8px;"></i></a>
        </div>
    </div>
</section>

<section class="section-padding" style="background: #fdfdfd; padding-top: 40px;">
    <div class="container container-narrow">

        <div class="long-content">
            <?php echo s($S, 'gold_rate_content'); ?>

            <div class="keyword-list">
                <span class="keyword-tag">Today Gold Rate in Ranchi</span>
                <span class="keyword-tag">Today Gold Price in Ranchi</span>
                <span class="keyword-tag">Today Ranchi Gold Rate</span>
                <span class="keyword-tag">22k Gold Price Today in Ranchi</span>
                <span class="keyword-tag">24k Gold Price Today in Ranchi</span>
                <span class="keyword-tag">24k Gold Rate Today in Ranchi</span>
                <span class="keyword-tag">Gold Market Price Today in Ranchi</span>
            </div>
        </div>

        <div style="text-align: center; margin-top: 50px;">
            <a href="contact/" class="btn btn-red"
                style="padding: 15px 40px; font-size: 1.1rem; border-radius: 50px; font-weight: 700;">Sell Your Gold at
                Best Rates Now</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>