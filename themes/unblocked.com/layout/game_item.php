<?php
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_home_limit', 'display');
    if (!$limit) {
        $limit = 50;
    }
}
// $limit = 50;
if (!$page) {
    $page = $_REQUEST['page'] ? $_REQUEST['page'] : 1;
}
if (!$field_order) {
    $field_order = \helper\options::options_by_key_type('field_order', 'display') ? \helper\options::options_by_key_type('field_order', 'display') : "publish_date";
}
$display = "yes";
$order_type = "DESC";
$num_link = 3;

if ($trending) {
    $games = \helper\game::get_top($top, $page, $limit3, $type);
    $count = $limit;
} else {
    $games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
    $count = \helper\game::get_count($keywords, $type, $display, $is_hot, $is_new, $category_id, $not_equal);
}
$paging_content = \helper\game::paging_link($count, $page, $limit, $num_link);

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
                        <!-- screen-cate: <= 992px -->
                        <div class="d-grid mt-2 mb-3 d-block d-lg-none">
                            <form method="post" class="" name="filter">
                                <select name="category" class="form-select bg-gray-200 category-input border-0">
                                    <?php if ($slug) : ?>
                                        <option value=""><?php echo ucwords(str_replace('-', ' ', $slug)) ?></option>
                                    <?php else : ?>
                                        <option value="">Categories</option>
                                    <?php endif ?>

                                    <!-- <optgroup label="Categories"> -->
                                    <?php foreach ($list_cate2 as $k => $cate2) :
                                        if (\helper\game::get_count('', '', 'yes', '', '', $cate2->id)) : ?>
                                            <option value="/games/<?php echo $cate2->slug; ?>" title="<?php echo $cate2->name; ?>"><?php echo ucwords($cate2->name); ?></option>
                                    <?php endif;
                                    endforeach ?>
                                    <optgroup></optgroup>
                                </select>
                            </form>
                        </div>

                        <!-- scree-cate: > 992px -->
                        <div class="mt-4 d-none d-lg-block category-column">
                            <ul class="nav flex-column category-column-nav">
                                <li class="mt-2 mb-2">Categories</li>
                                <?php
                                $count_bg = 0;
                                foreach ($list_cate2 as $k => $cate2) :
                                    if (\helper\game::get_count('', '', 'yes', '', '', $cate2->id)) : ?>
                                        <li class="nav-item">
                                            <a class="category-column-link" href="/games/<?php echo $cate2->slug; ?>" title="<?php echo $cate2->name; ?>">
                                                <?php echo '<span class="category-column-icon" style="' . $arr_cate_color[$count_bg] . '"></span>'; ?>
                                                <span class="text-capitalize category-column-title"><?php echo $cate2->name; ?></span>
                                            </a>
                                        </li>
                                <?php $count_bg += 1;
                                        if ($count_bg == 6) {
                                            $count_bg = 0;
                                        }
                                    endif;
                                endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php endif ?>

                <div class="col-lg">
                    <?php if ($enable_ads) : ?><br>
                        <div class="ads-slot">
                            <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                        </div><br>
                    <?php endif ?>

                    <div class="mt-4 d-none d-lg-block"></div>
                    <div class="layout-heading">
                        <h1 class="fs-3 fw-bold text-capitalize link-title2"><?php echo $title ?></h1>
                        <div class="mb-32 count-games"><?php echo $count; ?> games in total</div>
                    </div>
                    <div id="ajax-append">
                        <?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games, 'paging_content' => $paging_content, 'flag' => true)) ?>
                    </div>

                    <?php if ($enable_ads) : ?><br>
                        <div class="ads-slot">
                            <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                        </div><br>
                    <?php endif ?>

                    <?php if ($post || $slogan) : ?>
                        <div class="row mt-32">
                            <div class="game__content">
                                <h1 class="title-option"><?php echo $title; ?></h1>
                                <?php if ($post) : ?>
                                    <?php if ($post->content) : ?>
                                        <div><?php echo html_entity_decode($post->content); ?></div>
                                    <?php else : ?>
                                        <div><?php echo html_entity_decode($post->excerpt); ?></div>
                                    <?php endif; ?>
                                <?php else : ?>
                                    <div><?php echo html_entity_decode($slogan); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ($enable_ads) : ?><br>
                            <div class="ads-slot">
                                <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                            </div><br>
                        <?php endif ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>