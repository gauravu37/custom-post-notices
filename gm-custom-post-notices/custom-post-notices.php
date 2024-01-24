<?php
/*
Plugin Name: GM Custom Post Notices
Description: Display dismissible admin notice showcasing the titles of the last 10 modified and published blog posts.
Version: 1.0
Author: Gaurav Mittal
*/

// Date: 24 Jan 2024
// Hook to display admin notice
add_action('admin_notices', 'custom_post_notices');

// Function to display admin notice
function custom_post_notices() {
    // Get the last 10 modified and published posts
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'orderby'        => 'modified',
        'order'          => 'DESC',
        'posts_per_page' => 10,
    );

    $recent_posts = new WP_Query($args);

    // Display notice if there are recent posts
    if ($recent_posts->have_posts()) {
        $notice_html = '<div class="notice notice-info is-dismissible">';
        $notice_html .= '<p>Last 10 Modified and Published Posts:</p>';
        $notice_html .= '<ul>';

        while ($recent_posts->have_posts()) {
            $recent_posts->the_post();
            $notice_html .= '<li><a href="' . esc_url(get_permalink()) . '">' . get_the_title() . '</a></li>';
        }

        $notice_html .= '</ul>';
        $notice_html .= '</div>';

        echo $notice_html;
    }

    // Reset post data
    wp_reset_postdata();
}
