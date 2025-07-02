<?php
$list_cate2 = \helper\category::find_by_taxonomy('game');
$list_tags = \helper\tag::find_tag_by_taxonomy('game');

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

<div class="row">
    <?php if (count($list_cate2) || count($list_tags)) : ?>
        <div class="col-lg-auto">
            <!-- screen-cate: <= 992px -->
            <div class="d-grid mt-2 mb-3 d-block d-lg-none">
                <form method="post" class="" name="filter">
                    <select name="category" class="form-select bg-gray-200 category-input border-0">
                        <?php if ($slug) : ?>
                            <option value=""><?php echo ucwords(str_replace('-', ' ', $slug)) ?></option>
                        <?php else : ?>
                            <option value="">Categories & Tags</option>
                        <?php endif ?>

                        <?php foreach ($list_cate2 as $k => $cate2) :
                            if (\helper\game::get_count('', '', 'yes', '', '', $cate2->id)) : ?>
                                <option value="/games/<?php echo $cate2->slug; ?>" title="<?php echo $cate2->name; ?>"><?php echo ucwords($cate2->name); ?></option>
                        <?php endif;
                        endforeach ?>

                        <optgroup></optgroup>
                        <?php foreach ($list_tags as $k => $tag) :
                            if (\helper\game::get_count('', '', 'yes', '', '', $tag->id)) : ?>
                                <option value="/tag/<?php echo $tag->slug; ?>" title="<?php echo $tag->name; ?>"><?php echo ucwords($tag->name); ?></option>
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
                    <?php foreach ($list_cate2 as $k => $cate2) :
                        if (\helper\game::get_count('', '', 'yes', '', '', $cate2->id)) : ?>
                            <li class="nav-item">
                                <a class="category-column-link" href="/games/<?php echo $cate2->slug; ?>" title="<?php echo $cate2->name; ?>">
                                    <?php
                                    if ($k < count($arr_cate_color)) {
                                        foreach ($arr_cate_color as $k2 => $color) {
                                            if ($k == $k2) {
                                                echo '<span class="category-column-icon" style="' . $color . '"></span>';
                                            }
                                        }
                                    } else {
                                        echo '<span class="category-column-icon" style="background-color: #F6A963"></span>';
                                    }
                                    ?>
                                    <span class="text-capitalize category-column-title"><?php echo $cate2->name; ?></span>
                                </a>
                            </li>
                    <?php endif;
                    endforeach ?>

                    <?php if (count($list_tags)) : ?>
                        <hr>
                        <li class="mb-2">Tags</li>
                        <?php foreach ($list_tags as $k => $tag) :
                            // if (\helper\game::get_count('', '', 'yes', '', '', $tag->id)) :
                            if (\helper\game::count_by_tag($tag->id)) :
                        ?>
                                <li class="nav-item">
                                    <a class="category-column-link" href="/tag/<?php echo $tag->slug; ?>" title="<?php echo $tag->name; ?>">
                                        <?php
                                        if ($k < count($arr_cate_color)) {
                                            foreach ($arr_cate_color as $k2 => $color) {
                                                if ($k == $k2) {
                                                    echo '<span class="category-column-icon" style="' . $color . '"></span>';
                                                }
                                            }
                                        } else {
                                            echo '<span class="category-column-icon" style="background-color: #F6A963"></span>';
                                        }
                                        ?>
                                        <span class="text-capitalize category-column-title"><?php echo $tag->name; ?></span>
                                    </a>
                                </li>
                        <?php
                            endif;
                        endforeach ?>
                    <?php endif ?>
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
        <?php endif; ?>
    </div>
</div>