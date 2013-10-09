<?php 
/**
* Plugin Name: bbPress Tag-Cloud Widget
* Description: Display bbPress tag cloud in a widget.
* Revision Date: 09 10, 2013
* Author: ckchaudhary
* Author URI: http://webdeveloperswall.com/
*/
add_action('widgets_init', create_function('', 'return register_widget("bbPressTagCloudWidget");') );
class bbPressTagCloudWidget extends WP_Widget{

    function bbPressTagCloudWidget(){
        $widget_ops = array('classname' => 'bbPressTagCloudWidget', 'description' => 'Display a tag cloud of all topic tags' );
        $this->WP_Widget('bbPressTagCloudWidget', '(bbPress) Tag Cloud', $widget_ops);
    }

    function form($instance){
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = $instance['title'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','totalcure');?>: 
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
                    name="<?php echo $this->get_field_name('title'); ?>" type="text" 
                    value="<?php echo attribute_escape($title); ?>" />
            </label>
        </p>
        <?php
    }
 
    function update($new_instance, $old_instance){
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        return $instance;
    }
 
    function widget($args, $instance){
        extract($args, EXTR_SKIP);

        echo $before_widget;
        $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

        if (!empty($title))
          echo $before_title . $title . $after_title;

        echo "<div class='bbptopictags-cloud'>";
        echo do_shortcode( '[bbp-topic-tags]' );
        echo "</div>";
        
        echo $after_widget;
    }
}//end class
?>