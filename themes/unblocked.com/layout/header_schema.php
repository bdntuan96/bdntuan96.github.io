<?php $theme_url = '/' . DIR_THEME; ?>

<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="external" content="true">
    <meta name="distribution" content="Global">
    <meta http-equiv="audience" content="General">
    <?php if ($custom) {
        echo $custom;
    } ?>
    <link rel="stylesheet" href="<?php echo $theme_url; ?>rs/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $theme_url; ?>rs/css/main.css">
    <?php if ($enable_ads) : ?>
        <link rel="stylesheet" href="<?php echo $theme_url; ?>rs/css/ads.css">
    <?php endif ?>


    <?php echo \helper\themes::get_layout('header/analytics');
    include 'ads/head.php';
    ?>
    <script type="application/ld+json">
        <?php
        $domain_url = \helper\options::options_by_key_type('base_url');
        $domain_url = preg_replace('/([\/]+)$/', '', $domain_url);
        $schema = array();
        $schema['@context'] = "https://schema.org";
        $schema['@type'] = "LocalBusiness";
        $schema['name'] = \helper\options::options_by_key_type('site_name');
        $schema['image'] = $domain_url . \helper\options::options_by_key_type('logo');
        $schema['@id'] = "";
        $schema['url'] = htmlspecialchars_decode($domain_url);
        $schema['telephone'] = \helper\options::options_by_key_type('company_phone2', 'company');
        $schema['priceRange'] = "$";
        $schema['address'] = array(
            '@type' => 'PostalAddress',
            'streetAddress' => \helper\options::options_by_key_type('company_street', 'company'),
            'addressLocality' => \helper\options::options_by_key_type('company_city', 'company'),
            'addressRegion' => \helper\options::options_by_key_type('company_state', 'company'),
            'postalCode' => \helper\options::options_by_key_type('company_zipcode', 'company'),
            'addressCountry' => "US"
        );
        $schema['OpeningHoursSpecification'] =  array(
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => array(
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
                'Saturday',
                'Sunday'
            ),
            'opens' => '00:00',
            'closes' => '23:59'
        );
        $schema['sameAs'] = array(
            \helper\options::options_by_key_type('company_facebook', 'company'),
            \helper\options::options_by_key_type('company_facer', 'company'),
            \helper\options::options_by_key_type('company_twitter', 'company'),
            \helper\options::options_by_key_type('company_tiktok', 'company'),
            \helper\options::options_by_key_type('company_gettr', 'company'),
            \helper\options::options_by_key_type('company_reddit', 'company'),
            \helper\options::options_by_key_type('company_linkedin', 'company'),
            \helper\options::options_by_key_type('company_tumblr', 'company'),
            \helper\options::options_by_key_type('company_twitch', 'company'),
            \helper\options::options_by_key_type('company_telegram', 'company'),
            \helper\options::options_by_key_type('company_youtube', 'company'),
            \helper\options::options_by_key_type('company_vimeo', 'company'),
            \helper\options::options_by_key_type('company_archive', 'company'),
            \helper\options::options_by_key_type('company_producthunt', 'company'),
            \helper\options::options_by_key_type('company_github', 'company'),
            \helper\options::options_by_key_type('company_pinterest', 'company'),
            \helper\options::options_by_key_type('company_stackoverflow', 'company'),
            \helper\options::options_by_key_type('company_about', 'company'),
            \helper\options::options_by_key_type('company_gitlab', 'company'),
        );
        echo json_encode($schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        ?>
    </script>

    <script>
        let id_game = '';
        let url_game = '';
        let keywords = '';
        let tag_id = '';
        let category_id = '';
        let field_order = '';
        let order_type = '';
        let is_hot = '';
        let is_new = '';
        let slug_home = "";
        let limit = '';
        let oldValue = '<?php echo $slug ?>';
    </script>

</head>

<body class="scroll">
    <div class="content">