// Custom recent posts:
// Exclude posts from the category "Non-English"

<ul>
<?php
    $recentPosts = new WP_Query();
    $cat_id = get_category_id("Non-English")
    $recentPosts->query("showposts=5&cat=-" . $cat_id);
?>
<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
    <li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></li>
<?php endwhile; ?>
</ul>

// Translation connect, Wikipedia style

<?php
$langs = array(
    "English"   => 1,
    "Magyar"    => 1
);
function cllb($ar) {
    if ($ar[0] < $ar[1]) {
        return -1;
    } else if ($ar[0] == $ar[1]) {
        return 0;
    } else {
        return 1;
    }
}
if (have_posts()) {
    $langtag = false;
    while (have_posts()) {
        the_post();
        $posttags = get_the_tags();
        if ($posttags) {
            foreach($posttags as $tag) {
                if (!strncmp($tag->name, "_", 1)) {
                    $langtag = $tag->term_id;
                }
            }
        }
    }
    if ($langtag) {
        $translations = new WP_Query();
        $translations->query("showposts=20&tag_id=" . $langtag);
        $res = array();
        while ($translations->have_posts()) {
            $translations->the_post();
            $post_categories = wp_get_post_categories(get_the_ID());
            foreach($post_categories as $c){
                $cat = get_category($c);
                if (array_key_exists($cat->name, $langs)) {
                    array_push($res, array($cat->name, get_permalink()));
                }
            }
        }
        usort($res, cllb);
        echo '<ul>';
        if (count($res) == 0) {
            echo '<li>No translations yet.</li>';
        } else {
            foreach ($res as $r) {
                echo '<li><a href="' . $r[1] . '" rel="bookmark">' . $r[0] . '</a></li>';
            }
        }
        echo '</ul>';
    } else {
        echo '<ul><li>No translations yet.</li></ul>';
    }
}
?>