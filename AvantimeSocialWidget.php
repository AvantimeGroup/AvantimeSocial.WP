<?php
class AvantimeSocial_Facebook_Widget extends WP_Widget
{

  function __construct() {
    parent::__construct('AvantimeSocial_Facebook_Widget', 'Avantime Social Facebook Widget');
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget($args, $instance) {
    extract($args);

    $account = $instance['account'];
    $width = $instance['width'];
    $height = $instance['height'];
    $hidecover = $instance['hidecover'];
    $showfaces = $instance['showfaces'];
    $showposts = $instance['showposts'];

    if( empty($account) )
      return;
    else {
     echo $before_widget;
        $AFB = \Avantime\Social\Services\Facebook::getInstance();
        echo $AFB->InsertFacebookBoxWithSettings($account, $width, $height, $hidecover, $showfaces, $showposts);
     echo $after_widget;
    }
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update($new_instance, $old_instance) {
    $instance = array(
      'account' => $new_instance['account'],
      'width' => $new_instance['width'],
      'height' => $new_instance['height'],
      'hidecover' => $new_instance['hidecover'],
      'showfaces' => $new_instance['showfaces'],
      'showposts' => $new_instance['showposts']
    );
    return $instance;
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form($instance) {
    if (isset($instance)) {
      $account = $instance['account'];
      $width = $instance['width'];
      $height = $instance['height'];
      $hidecover = $instance['hidecover'];
      $showfaces = $instance['showfaces'];
      $showposts = $instance['showposts'];
    } else {
      $account = 'avantimegroup';
      $width = 300;
      $height = 525;
      $hidecover = 'false';
      $showfaces = 'false';
      $showposts = 'true';
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('account'); ?>"><?php _e('ID på konto (t.ex. avantimegroup):'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('account'); ?>" name="<?php echo $this->get_field_name('account'); ?>" type="text" value="<?php echo $account; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Önskad höjd på box'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('hidecover'); ?>"><?php _e('Dölj coverbild'); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id('hidecover'); ?>" name="<?php echo $this->get_field_name('hidecover'); ?>">
        <option value="false" <?php echo $hidecover === 'false' ? 'selected="selected"': ''; ?> >Nej</option>
        <option value="true" <?php echo $hidecover === 'true' ? 'selected="selected"': ''; ?> >Ja</option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('showfaces'); ?>"><?php _e('Visa ansikten'); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id('showfaces'); ?>" name="<?php echo $this->get_field_name('showfaces'); ?>">
        <option value="false" <?php echo $showfaces === 'false' ? 'selected="selected"': ''; ?> >Nej</option>
        <option value="true" <?php echo $showfaces === 'true' ? 'selected="selected"': ''; ?> >Ja</option>
      </select>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('showposts'); ?>"><?php _e('Visa poster'); ?></label>
      <select class="widefat" id="<?php echo $this->get_field_id('showposts'); ?>" name="<?php echo $this->get_field_name('showposts'); ?>">
        <option value="false" <?php echo $showposts === 'false' ? 'selected="selected"': ''; ?> >Nej</option>
        <option value="true" <?php echo $showposts === 'true' ? 'selected="selected"': ''; ?> >Ja</option>
      </select>
    </p>
    <?php
  }

}

/**
 * Then register
 */
function myplugin_register_widgets() {
  register_widget('AvantimeSocial_Facebook_Widget');
}

add_action( 'widgets_init', 'myplugin_register_widgets' );
