<?php
/*
Plugin Name: Varsayılan İçerik
Plugin URI: http://wordpress.org/extend/plugins/varsayilan-icerik
Description: Yeni yazılara; varsayılan başlık, özet ve içerik metinleri girilebilmesine olanak sağlayan bir eklentidir.
Version: 1.0
Author: Süleyman ÜSTÜN
Author URI: http://suleymanustun.com
*/

add_action('admin_menu', 'create_menu');

function create_menu() {
	add_options_page('Varsayılan İçerik Ayarları', 'Varsayılan İçerik', 'administrator', __FILE__, 'vi_settings_page');
	add_action('admin_init', 'vi_register_settings');
}

function vi_register_settings() {
	register_setting('vi_settings_group', 'vi_title_text');
	register_setting('vi_settings_group', 'vi_title_check');
	register_setting('vi_settings_group', 'vi_excerpt_text');
	register_setting('vi_settings_group', 'vi_excerpt_check');
	register_setting('vi_settings_group', 'vi_content_text');
	register_setting('vi_settings_group', 'vi_content_check');
}

function vi_settings_page() {	
?>
<div class="wrap">
<h2>Varsayılan İçerik Ayarları</h2>

<form method="post" action="options.php">
    <?php settings_fields('vi_settings_group'); ?>
    <table style="width:700px">
		<tr valign="top">
			<th>&nbsp;</th>
			<th>Uygula</th>
			<th>Metin</th>
		</tr>
		<tr valign="top">
			<td><strong>Başlık</strong></td>
			<th><input name="vi_title_check" type="checkbox" value="1" <?php if(get_option('vi_title_check')) echo 'checked'; ?> /></th>
			<td><input type="text" name="vi_title_text" value="<?php echo get_option('vi_title_text'); ?>" style="width:600px" /></td>
		</tr>
		<tr valign="top">
			<td><strong>Özet</strong></td>
			<th><input name="vi_excerpt_check" type="checkbox" value="1" <?php if(get_option('vi_excerpt_check')) echo 'checked'; ?> /></th>
			<td><textarea type="text" name="vi_excerpt_text" rows="5" style="width:600px"><?php echo get_option('vi_excerpt_text'); ?></textarea></td>
		</tr>
		<tr valign="top">
			<td><strong>İçerik</strong></td>
			<th><input name="vi_content_check" type="checkbox" value="1" <?php if(get_option('vi_content_check')) echo 'checked'; ?> /></th>
			<td><textarea type="text" name="vi_content_text" rows="10" style="width:600px"><?php echo get_option('vi_content_text'); ?></textarea></td>
		</tr>
	</table>
	
	<p class="submit"><input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" /></p>

</form>
</div>
<?php } 

if(get_option('vi_title_check')) {
	add_filter('default_title', 'change_default_title' );
	function change_default_title($title) {
		$title = get_option('vi_title_text');
		return $title;
	}
}

if(get_option('vi_excerpt_check')) {
	add_filter('default_excerpt', 'change_default_excerpt' );
	function change_default_excerpt($excerpt) {
		$excerpt = get_option('vi_excerpt_text');
		return $excerpt;
	}
}

if(get_option('vi_content_check')) {
	add_filter('default_content', 'change_default_content' );
	function change_default_content($content) {
		$content = get_option('vi_content_text');
		return $content;
	}
}
?>