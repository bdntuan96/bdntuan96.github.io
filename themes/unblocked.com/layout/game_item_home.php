<?php
$field_order2 = "publish_date";
$order_type = "desc";
$limit2 = "24";
$games_news2 = \helper\game::get_paging($page, $limit2, $keywords, $type, $display, $is_hot, $is_new, $field_order2, $order_type, NULL, $not_equal);
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_home_limit', 'display');
    if (!$limit) {
        $limit = 98;
    }
}
if (!$page) {
    $page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
}
if (!$field_order) {
    $field_order = \helper\options::options_by_key_type('field_order', 'display') ? \helper\options::options_by_key_type('field_order', 'display') : "publish_date";
}
$display = "yes";
$order_type = "DESC";
$num_link = 3;

if ($tag_id != '') {
    $games = \helper\game::paging_by_tag($tag_id, $page, $limit);
    $count = \helper\game::count_by_tag($tag_id);
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
} else {
    if ($trending) {
        $games = \helper\game::get_top($top, $page, $limit3, $type);
        $count = $limit;
    } else {
        $games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
        $count = \helper\game::get_count($keywords, $type, $display, $is_hot, $is_new, $category_id, $not_equal);
    }
    $paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);
}

$list_cate2 = \helper\category::find_by_taxonomy('game');

$arr_cate_color = [
    "background-color: #D34949",
    "background-color: #66D78C",
    "background-color: #F6A963",
    "background-color: #55E4DB",
    "background-color: #68CF6C",
    "background-color: #706DE4",
    "background-color: #D760D2",
];
?>

<section class="section section--first">
    <div class="container-fluid">

        <?php if (!count($games)) :
            echo \helper\themes::get_layout('error', array('keywords' => $keywords, 'title' => $title, 'count' => $count)); ?>

        <?php else: ?>
            <div class="row">
                <?php if (count($list_cate2)) : ?>
                    <div class="col-lg-auto">
                        <div class="w-300">
                            <?php if ($enable_ads) : ?>
                                <div class="ads-slot myads">
                                    <?php echo \helper\themes::get_layout('ads_layout/doc', array('enable_ads' => $enable_ads)); ?>
                                </div>
                            <?php endif ?>
                            <h4 class="title-option">New Games Uploaded</h4>
                            <?php echo \helper\themes::get_layout('game_item_ajax_play', array('games' => $games_news2)) ?>
                        </div>
                    </div>
                <?php endif ?>

                <div class="col-lg">
                    <?php if ($enable_ads) : ?><br>
                        <div class="ads-slot">
                            <?php echo \helper\themes::get_layout('ads_layout/home_top', array('enable_ads' => $enable_ads)); ?>
                        </div><br>
                    <?php endif ?>

                    <div class="mt-4 d-none d-lg-block"></div>
                    <div class="layout-heading">
                        <h1 class="title-option">Classroom 6x - Play Unblocked Games at School</h1>
                        <p style="text-align: justify;"><strong><em>Welcome to <a title="Classrom 6x website" href="/">Classroom 6x </a> - the premier online destination for gaming enthusiasts seeking thrilling and immersive experiences. Whether you're a fan of <a href="https://en.wikipedia.org/wiki/HTML5#:~:text=HTML5" target="_blank">HTML5 </a>games, <a href="https://en.wikipedia.org/wiki/Unity" target="_blank">Unity </a>games, or other web-based gaming adventures, Classroom 6x has got you covered.&nbsp;</em></strong></p>

                    </div>
                    <div id="ajax-append">
                        <?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games, 'limit' => $limit, 'flag' => true)) ?>
                    </div>

                    <?php if ($enable_ads) : ?><br>
                        <div class="ads-slot">
                            <?php echo \helper\themes::get_layout('ads_layout/home_bottom', array('enable_ads' => $enable_ads)); ?>
                        </div><br>
                    <?php endif ?>


                    <?php if ($post) : ?>
                        <div class="game__content">
                            <?php if ($post->content) : ?>
                                <div><?php echo html_entity_decode($post->content); ?></div>
                            <?php else : ?>
                                <div><?php echo html_entity_decode($post->excerpt); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>

<script>
    keywords = "<?php echo $keywords; ?>";
    field_order = "<?php echo $field_order ?>";
    order_type = "<?php echo $order_type ?>";
    category_id = "<?php echo $category_id ?>";
    is_hot = "<?php echo $is_hot ?>";
    is_new = "<?php echo $is_new ?>";
    tag_id = "<?php echo $tag_id ?>";
    limit = "<?php echo $limit ?>";
</script>