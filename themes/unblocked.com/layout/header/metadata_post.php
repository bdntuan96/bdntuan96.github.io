<?php
$metadata = json_decode($post->metadata);
$thumb = $post->image;
if (empty($thumb)) {
    $thumb = \helper\options::options_by_key_type('logo');
}
$site_title = $post->title;
$site_name = \helper\options::options_by_key_type('site_name');
$site_description = $post->excerpt;
$site_keywords = $post->title;
$base_url = rtrim(\helper\options::options_by_key_type('base_url'), "/").load_url()->uri();
$banner = $thumb;
$favicon = \helper\image::get_thumbnail($thumb, 144, 144, 'm');
$data = array(
    'site_title' => $site_title,
    'site_name' => $site_name,
    'site_description' => $site_description,
    'site_keywords' => $site_keywords,
    'base_url' => $base_url,
    'banner' => $banner,
    'favicon' => $favicon,
    'twitter_appid' => $twitter_appid,
    'facebook_appid' => $facebook_appid,
);
echo \helper\themes::get_layout('header/metadata', $data);
