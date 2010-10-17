<?php
function getTwitter(){
/*
***ENTER YOUR TWITTER ID BETWEEN THE SINGLE QUOTES-----|
                                                       |    */
$TwitterID = 'gregponchak';/* <------------------------|    */

echo $TwitterID;
}

/*Do not edit below here*/
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h5>',
        'after_title' => '</h5>',
    ));
    
function displayCategories() {
  $args=array(
  'orderby' => 'name',
  'order' => 'ASC'
  );
  $categories=get_categories($args);
  echo '<b>Categories</b>';
  foreach($categories as $category) { 
    echo '<a href="#" onclick="openAndHide(\''.$category->name.'\')" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
  } 
  echo '<br />';
  foreach($categories as $category) { 
    echo '<div class="hidden" id="'.$category->name.'"><ul>';
    
	global $post;
 	$myposts = get_posts('category_name='.$category->name);
 	foreach($myposts as $post) : ?>
    	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php
		endforeach;
		echo '</ul></div>';
  }
}


class Example_Widget extends WP_Widget {
	function Example_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'rss', 'description' => 'Displays the main rss link for this blog.' );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'rss-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'rss-widget', 'Self RSS Widget', $widget_ops, $control_ops );
	}

	function form($instance) {
		// outputs the options form on admin
	}

	function update($new_instance, $old_instance) {
		// processes widget options to be saved
	}

	function widget($args, $instance) {
		// outputs the content of the widget
		echo '<ul><li><a href="';
		echo bloginfo("rss_url");
		echo '">rss</a></li></ul>';
	}

}
register_widget('Example_Widget');

?>