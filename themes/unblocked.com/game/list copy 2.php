<?php
if (isset($_REQUEST['base_url'])) {
    $base_url = $_REQUEST['base_url'];
    if (strpos($base_url, 'https://') === 0) {
        $base_url = str_replace('https://', '', $base_url);
    } elseif (strpos($base_url, 'http://') === 0) {
        $base_url = str_replace('http://', '', $base_url);
    }
    $base_url = rtrim(str_replace('/', '', $base_url));
}

if (!is_dir("htmlsource/$base_url")) {
    mkdir("htmlsource/$base_url", 0777, true);
}

$limit = 999;
$page = 1;
$games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, 'id', 'desc', $category_id2, $not_equal);

foreach ($games as $game) {
    $slug = $game->slug;

    $data['custom'] = \helper\themes::get_layout('header/metadata_game', array('game' => $game));
    $h = '';
    $h =  \helper\themes::get_layout('header', $data);
    $h .= \helper\themes::get_layout('menu', array('slug' => $slug));
    $h .= \helper\themes::get_layout('game_play_home', array('game' => $game));
    $h .= \helper\themes::get_layout('header/richtext', array('game' => $game));
    $h .= \helper\themes::get_layout('footer');
    $h = str_replace('://unblocked.com', "://$base_url", $h);

    $destination_file = "htmlsource/$base_url/$slug.html";
    if (($destination_file & 0xC000) !== 0xC000) {
        chmod($destination_file, 0755);
    }
    // in($destination_file);

    $r = file_put_contents($destination_file, $h);
    if ($r) {
        echo "<br>$destination_file  has saved";
    } else {
        echo '<div style="color: red;font-size: larger;font-weight: bold;">Tạo file Thất Bại:  ' .  $destination_file . '</div><br>';
    }
}
