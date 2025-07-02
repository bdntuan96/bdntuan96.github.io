<?php
// get games with limit
$limit = 20;
// $limit = 5;
$games = \helper\game::get_paging($page, $limit, $keywords, $type, $display, $is_hot, $is_new, $field_order, $order_type, $category_id, $not_equal);
// in($games); // array games
// die;

// function random: random any number from 0 ($limit-1)   
// $item: take out 1 game ((from $games array): key== random number
// from game get its slug ($item->slug) => redirect it to that page 
$ran = rand(0, $limit - 1);
$item = $games[$ran];
$slug = header("Location: /$item->slug");
exit;

// in($item);  // 1 game (has everything)
// die;
// in($item->slug);  //topdown-police-chase-2023
// die;