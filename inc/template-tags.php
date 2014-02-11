<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package smart
 */
if ( ! function_exists( 'sfu_theme_pagination' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */

function smart_pagination($pages = '', $range = 2)
{  
        $showitems = ($range * 2)+1;  
        
        global $paged;
        if(empty($paged)) $paged = 1;
        
        if($pages == ''){
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if(!$pages){
                        $pages = 1;
                }
        }   
        
        if(1 != $pages){
        echo '<ul class="pagination">';
        if($paged > 2 && $paged > $range+1){
                echo '<li class="arrow"><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';        
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&laquo;</a></li>';
        }
        if($paged > 1){
                echo '<li class="arrow"><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&lsaquo;</a></li>';        
        }
        
        for ($i=1; $i <= $pages; $i++){
                if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                        echo ($paged == $i)? '<li class="current"><a href="">'.$i.'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
                }
        }
        
        if ($paged < $pages){
                echo '<li class="arrow"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&rsaquo;</a>';
        }
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages){
                echo '<li class="arrow"><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
        }elseif($showitems < $pages){
                echo '<li class="arrow unavailable"><a href="">&raquo;</a></li>';
        }
         echo "</ul>\n";
        }
}
endif;

if ( ! function_exists( 'smart_img' ) ) :
/**
 * Custom image retriever.
 * Will automatically retrieve images from the theme images folder
 */ 
function smart_img($imgName, $imgClass='', $imgWidth='', $imgHeight='', $imgCrop=true, $imgRetina=false){
    if($imgClass == 'url'){
        $imgReturn = get_bloginfo('stylesheet_directory').'/images/'.$imgName;
    }elseif($imgName == 'thumbnail'){
    	$imgID = get_post_thumbnail_id();
    	$url = wp_get_attachment_image_src( $imgID, 'large' );
    	$title = get_post($imgID)->post_title;
    	$imgSrc = matthewruddy_image_resize( $url[0], $imgWidth, $imgHeight, $imgCrop, $imgRetina );
    	$imgReturn = '<img class="'.$imgClass.'" src="'.$imgSrc['url'].'" alt="'.$title.'" title="'.$title.'" />';
    }elseif($imgWidth){
    	$url = get_bloginfo('stylesheet_directory').'/images/'.$imgName;
    	$imgSrc = matthewruddy_image_resize( $url, $imgWidth, $imgHeight, $imgCrop, $imgRetina );
    	$imgReturn = '<img src="'.$imgSrc['url'].'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }elseif($imgClass){
        $imgReturn = '<img class="'.$imgClass.'" src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }else{
        $imgReturn = '<img src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }
    echo $imgReturn;
}
endif;


if ( ! function_exists( 'smart_clear' ) ) :
/**
 * Custom clear fix.
 * What it says on the box
 */
function smart_clear(){
    echo '<div class="smart-clear" style="clear:both;"></div>';
}
endif;


if ( ! function_exists( 'smart_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function smart_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'smart' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'smart' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'smart' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'smart_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function smart_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'smart' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'smart' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'smart' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'smart_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function smart_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	/*if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}*/

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'smart' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function smart_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so smart_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so smart_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in smart_categorized_blog.
 */
function smart_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'smart_category_transient_flusher' );
add_action( 'save_post',     'smart_category_transient_flusher' );
