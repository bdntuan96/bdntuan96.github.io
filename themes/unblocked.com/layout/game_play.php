<?php
if (!$limit) {
    $limit = \helper\options::options_by_key_type('game_related_limit', 'display');
    if (!$limit) {
        $limit = 24;
    }
}
$page = 1;
$order_type = "DESC";
$display = "yes";
$field_order = "views";
$not_equal['slug'] = $game->slug;

$url = load_url()->current_url();
$url = str_replace('?clear=1', '', $url);
$game_name = $game->name;

$list_cate = \helper\game::find_related_category($game->id);
if (count($list_cate)) {
    $arr_bread = array(
        array(
            'name' => $list_cate[0]->name,
            'slug' => $list_cate[0]->slug,
            'source' => 'games/' . $list_cate[0]->slug,
        ),
        array(
            'name' => $game_name,
        ),
    );

    $category_id = $list_cate[0]->id; //ở dưới cứ thế lấy ra đỡ phải kiểm tra có ko
} else {
    $arr_bread = array(
        array(
            'name' => $game_name,
        )
    );
}

// if ($is_game_play_home) {
//     $keywords_site = 'Survival';
//     $games_category = \helper\game::get_paging($page, $limit, $keywords_site, $type, $display, $is_hot, $is_new, $field_order, $order_type, NULL, $not_equal);
// } else
if ($category_id) {
    $arr_games_cate = [];
    foreach ($list_cate as $cate_id) {
        $earch_arr_games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $cate_id->id, $not_equal);
        // array_merge $arr_games into $arr_games_cate
        $arr_games_cate = array_merge($arr_games_cate, $earch_arr_games);
    }
    // need to check if this remove_duplicate game filter function exists because: old framework does not have the function added later
    $arr_games_cate = (class_exists('\helper\game') && method_exists('\helper\game', 'remove_duplicate_game')) ? \helper\game::remove_duplicate_game($arr_games_cate) : $arr_games_cate;
    $games_category = [];
    // take a slice from the array, starting at position 0, get the limit of elements
    $games_category = array_slice($arr_games_cate, 0, $limit);
} else {
    $category_id = '';
    $games_category = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
}

// is_game_play_home => games keywords
// if ($is_game_play_home) {
//     $keywords_site = 'pokemon';
//     $games_tag = \helper\game::get_paging($page, $limit, $keywords_site, $type, $display, $is_hot, $is_new, $field_order, $order_type, NULL, $not_equal);
// } else {
$category_id = '';
$games_tag = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
// }

// Filter duplicate games in left column ($games_tag): based on right column ($games_category)
if (count($games_tag) && count($games_category)) {
    $category_ids = array_column($games_category, 'id'); // Get an array of all ids ([0] => 174, [1] => 175),...)
    $category_lookup = array_flip($category_ids); // Convert to array with above id value as key ([174] => 0,[175] => 1,...)

    $games_tag3 = [];
    // isset to check if $t->id is in $category_lookup. If id is not in there, put it in the array
    foreach ($games_tag as $t) {
        if (!isset($category_lookup[$t->id])) {
            $games_tag3[] = $t;
        }
    }
    $games_tag = $games_tag3;
}

$limit_cate = \helper\options::options_by_key_type('game_category_limit', 'display');
if (!$limit_cate) {
    $limit_cate = 12;
}
$field_order2 = "publish_date";
$games_news = \helper\game::get_paging($page, $limit_cate, $keywords, $type, $display, $is_hot, $is_new, $field_order2, $order_type, NULL, $not_equal);

\helper\game::update_views($game->id);
?>

<section class="section section--first">
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-auto d-none d-xxl-block">
                <div class="w-300">
                    <?php if ($enable_ads) : ?>
                        <div class="ads-slot myads">
                            <?php echo \helper\themes::get_layout('ads_layout/doc', array('enable_ads' => $enable_ads)); ?>
                        </div>
                    <?php endif ?>
                    <?php echo \helper\themes::get_layout('game_item_ajax_play', array('games' => $games_tag)) ?>
                </div>
            </div>

            <div class="col-lg">
                <div>
                    <iframe id="iframehtml5" class="iframe-default" src="<?php echo $game->source_html ?>" width="100%" height="<?php echo ($game->height > 600) ? $game->height : 616 ?>px" title="<?php echo $game_name; ?>" frameborder="0" border="0" scrolling="auto" allowfullscreen></iframe>
                </div>
                <div class="px-lg-3">
                    <?php echo \helper\themes::get_layout('header_game', array('game' => $game, 'url' => $url, 'list_cate' => $list_cate)); ?>
                    <br>
                </div>

                <?php if ($enable_ads) : ?>
                    <div class="ads-slot">
                        <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                    </div><br>
                <?php endif ?>

                <div class="game__content2">

                    <?php echo \helper\themes::get_layout('bread_crumb', array('arr_bread' => $arr_bread, 'title' => $game_name)); ?>

                    <div class="game__content">
                        <?php if ($game->content) : ?>
                            <?php echo html_entity_decode(($game->content)); ?>
                        <?php else : ?>
                            <p><?php echo html_entity_decode(($game->excerpt)); ?></p>
                        <?php endif; ?>

                        <?php if ($game->controlsguide != null) : ?>
                            <h2 class="title-option">Instructions</h2>
                            <?php echo html_entity_decode(($game->controlsguide)); ?>
                        <?php endif; ?>
                    </div>

                    <?php echo \helper\themes::get_layout('tag_item', array('list_cate' => $list_cate)); ?>
                </div>

                <?php if ($enable_ads) : ?>
                    <br>
                    <div class="ads-slot">
                        <?php echo \helper\themes::get_layout('ads_layout/ngang', array('enable_ads' => $enable_ads)); ?>
                    </div>
                <?php endif ?>

                <?php if (count($posts)) : ?>
                    <div class="game__content2 mt-32">
                        <p class="mb-2 fs-4 text-title">Relates News</p>
                        <div>
                            <?php echo \helper\themes::get_layout('post_item_show', array('posts' => $posts)) ?>
                        </div>
                    </div>
                <?php endif ?>
            </div>

            <div class="col-lg-auto">
                <p class="mt-5 mb-4 fs-4 text-title screen-md">Similars Games</p>
                <div class="w-300">
                    <?php if ($enable_ads) : ?>
                        <div class="ads-slot myads">
                            <?php echo \helper\themes::get_layout('ads_layout/doc', array('enable_ads' => $enable_ads)); ?>
                        </div>
                    <?php endif ?>
                    <?php echo \helper\themes::get_layout('game_item_ajax_play', array('games' => $games_category)) ?>
                </div>
            </div>
        </div>

        <?php if (count($games_news)) : ?>
            <div class="row mt-5">
                <a class="mb-4 fs-3 link-title" href="/new-games" title="new-games">New Games</a>
                <div>
                    <?php echo \helper\themes::get_layout('game_item_ajax', array('games' => $games_news, 'flag' => true)) ?>
                </div>
            </div>
        <?php endif ?>
    </div>
    </div>
</section>