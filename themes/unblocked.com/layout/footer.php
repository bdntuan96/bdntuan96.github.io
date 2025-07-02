<?php $theme_url = '/' . DIR_THEME; ?>
</div>
<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-container">
                    <div class="foot_div">
                        <a class="footer-text text2" href="/about-us" target="_blank" title="About us">About us</a>
                        <a class="footer-text text2" href="/contact-us" target="_blank" title="Contact us">Contact us</a>
                        <a class="footer-text text2" href="/privacy-policy" target="_blank" title="Privacy policy">Privacy policy</a>
                        <a class="footer-text text2" href="/term-of-use" target="_blank" title="Term of use">Term of use</a>
                        <a class="footer-text text2" href="/copyright-infringement-notice-procedure" target="_blank" title="Copyright">Copyright Infringement Notice Procedure</a>
                    </div>
                    <div class="foot_div fix_footer">
                        <span class="text2">Disclaimer: <strong><a href="/" title="<?php echo \helper\options::options_by_key_type('site_name') ?>"> <?php echo \helper\options::options_by_key_type('site_name') ?> </a></strong> is an independent website and is not affiliated with any organizations.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<button id="back-to-top" title="Back to top" aria-hidden="true">↑</button>

<div class="loading_mask hidden-load">
    <svg xmlns="http://www.w3.org/2000/svg" width="80px" height="80px" viewBox="0 0 100 100">
        <g transform="translate(50 50)">
            <g transform="scale(0.794652 0.794652)">
                <animateTransform attributeName="transform" type="scale" calcMode="spline" values="0.8;0.5;0.8" keyTimes="0;0.5;1" dur="1.5s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"></animateTransform>
                <rect x="-45" y="-45" width="90" height="90" fill="#ffffcb" stroke="#ff7c81" stroke-width="8" rx="5.55556" transform="rotate(4.81284)">
                    <animate attributeName="rx" calcMode="linear" values="0;50;0" keyTimes="0;0.5;1" dur="1.5" begin="0s" repeatCount="indefinite"></animate>
                    <animate attributeName="stroke-width" calcMode="linear" values="8;24;8" keyTimes="0;0.5;1" dur="1.5" begin="0s" repeatCount="indefinite"></animate>
                    <animateTransform attributeName="transform" type="rotate" calcMode="spline" values="0 0 0;270 0 0;540 0 0" keyTimes="0;0.5;1" dur="1.5s" keySplines="0.5 0 0.5 1;0.5 0 0.5 1" begin="0s" repeatCount="indefinite"></animateTransform>
                </rect>
            </g>
        </g>
    </svg>
</div>

<script src="<?php echo $theme_url; ?>rs/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $theme_url; ?>rs/js/jquery-3.4.1.min.js"></script>
<?php
if ($is_contact_us) {
    echo '<script defer src="' . $theme_url . 'rs/js/jquery.validate.min.js"></script>';
}
?>
<script src="<?php echo $theme_url; ?>rs/js/script.js"></script>

</body>

</html>