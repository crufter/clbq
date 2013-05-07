<?php get_header(); ?>

    <div class="single_left">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      
            <h1><?php the_title(); ?></h1>
            
            <?php if (has_tag("in-progress")) { ?>
                <div class="ongoing">
                    This is an ongoing QA session. If you have any questions to include comment below, write us an email or
                    whatever floats your boat :).
                </div>
            <?php } ?>
            
            <?php the_content(); ?>
            
            <p><?php the_tags(); ?></p>
        
        <?php endwhile; else: ?>
        
            <h3>Sorry, no posts matched your criteria.</h3>
        
        <?php endif; ?>    
    
        <div class="clear"></div>                    
    </div><!--//single_left-->
    
    
    <?php get_sidebar(); ?>
    
<?php get_footer(); ?>