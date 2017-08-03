<?php
/*
Plugin Name: Bouclier anti-haine Respect Zone
Plugin URI: https://www.respectzone.org/
Description: 
Version: 1.7.5
Author: Alex SEBBANE
Author URI: 
License: GPLv2 or later
Text Domain: respectzone_comment
*/
add_action('admin_menu', 'respectzone_comment_setup_menu');

function respectzone_comment_setup_menu(){
	//add_menu_page( 'Respect Zone Comment Configuration', 'Bouclier RZ', 'manage_options', 'rz-comment-admin', 'rzadmin_init' );
	add_submenu_page('options-general.php','Respect Zone Comment Configuration', __('Bouclier RZ','respectzone-comment'), 'manage_options', 'rz-comment-admin', 'rzadmin_init' );
}

function rzadmin_init(){
	rzadmin_handle_post();
	$rz_list = get_option("rz_list");
	if($rz_list==""){
		add_option('rz_list','ext');
	}
	?>
	<h1><?php _e('Bouclier anti Haine RespectZone','respectzone-comment'); ?></h1>
	<p><?php _e('Choisir la source de la liste des insultes qui seront recherchées :','respectzone-comment'); ?></p>

	<form  method="post" enctype="post">
		<input type="radio" name="rz_list" value="int" <?php if($rz_list=='int'){ echo "checked"; } ?> > <?php _e('Local','respectzone-comment');?> (<?php echo plugin_dir_path( __FILE__ ).'file/fichier.txt';?>)<br />
		<input type="radio" name="rz_list" value="ext" <?php if($rz_list=='ext'){ echo "checked"; } ?> > <?php _e('Hébergé par respectzone','respectzone-comment'); ?> ('https://api.respectzone.org/wp-content/plugins/api-licornsandhaters/ajax.php')<br />
		<?php submit_button(__('Valider','respectzone-comment')) ?>
	</form>
	<p></p>
	<?php
}

load_theme_textdomain('respectzone-comment', get_template_directory() . '/languages');

function rzadmin_handle_post(){
	// First check if the file appears on the _FILES array
	if(isset($_POST['submit'])){
		$rz_list = $_POST["rz_list"];
		update_option('rz_list', $rz_list);
	}
}

function respectzone_comment_styles()
{
    // Register the style like this for a plugin:
    wp_register_style( 'respectzone_comment_custom-style', plugins_url( '/css/custom.css', __FILE__ ), array(), '20161212', 'all' );
    // For either a plugin or a theme, you can then enqueue the style:
    wp_enqueue_style( 'respectzone_comment_custom-style' );
}
add_action( 'wp_enqueue_scripts', 'respectzone_comment_styles' );

function respectzone_comment_scripts_basic()
{
    // Register the script like this for a plugin:
    wp_register_script( 'respectzone_comment-script', plugins_url( '/js/custom.js', __FILE__ ) );

    // For either a plugin or a theme, you can then enqueue the script:
    wp_enqueue_script( 'respectzone_comment-script' );
}
add_action( 'wp_enqueue_scripts', 'respectzone_comment_scripts_basic' );

function respectzone_comment_getrandomalias_origine($elem){
	$nb = respectzone_comment_getnbsyllabe($elem);
	$retour = "";
	for($i=1;$i<=$nb;$i++){
		$retour .= "<i class=respect-".rand(1,11)."></i>";
	}
	return $retour;
}

function respectzone_comment_getrandomalias($elem){
	$nb = respectzone_comment_getnbsyllabe($elem);
	$arr = array();
	//$arr[]=1;
    for($i=0;$i<=$nb;$i++){
		$arr[]=rand(2,12);
	}
	shuffle($arr);
	$retour = "<span class=respect>  ";
	for($j=0;$j<=$nb;$j++){
			$retour .= "<img src=".plugin_dir_url( __FILE__ )."images/" . $arr[$j] . ".gif >";
	}
	$retour .= "  </span>";
	return $retour;
}

function respectzone_comment_getnbsyllabe($mot){
	$mot = strtolower(htmlentities ($mot));
	$mot = strtok ($mot,"");
	$voyelles = array ("a","e","i","o","u","y");
	$cvcv = "";
	$moins = 0;
	for ($i=0;$i<strlen ($mot)-1;$i++) {
		if (in_array($mot[$i],$voyelles)) {$cvcv .="v";} else {$cvcv .="c";}
	}
	$cvcv = $cvcv." ";
	$cvcv = str_replace ("vv","v",$cvcv);
	$cvcv = str_replace ("vv","v",$cvcv);
	$cvcv = str_replace ("vv","v",$cvcv);
	$cvcv = str_replace ("cc","c",$cvcv);
	$cvcv = str_replace ("cc","c",$cvcv);
	$cvcv = str_replace ("cc","c",$cvcv);
	$cvcv = str_replace ("c ","",$cvcv);
	$cvcv = str_replace (" ","",$cvcv);
	$nbsyllabes1 = count (explode ("cv",$cvcv));
	$nbsyllabes2 = count (explode ("vc",$cvcv));
	$nbsyllabes = min ($nbsyllabes1,$nbsyllabes2);
	$nbsyllabes = $nbsyllabes - $moins;
	return $nbsyllabes;
}

function respectzone_comment_tri_taille_chaine($chaine1, $chaine2)
{
    $taille1 = strlen($chaine1);
    $taille2 = strlen($chaine2);
    if ($taille1 == $taille2)
    {
        return strcmp($chaine1, $chaine2); // Ordre alphabetique si les chaines sont de meme taille
    }
    return ($taille1 < $taille2) ? 1 : -1;
}

function respectzone_comment_getdictionnaire(){
	if(isset($_SESSION['respectzone_comment_dictionnaire']) && $_SESSION['respectzone_comment_dictionnaire']<>""){
		return $_SESSION['respectzone_comment_dictionnaire'];
	}else{
		$rz_list = get_option("rz_list");
		if($rz_list=="ext") {
			return file_get_contents('https://api.respectzone.org/wp-content/plugins/api-licornsandhaters/ajax.php');
		}else{
			return file_get_contents(plugin_dir_path( __FILE__ ).'file/fichier.txt');
		}
	}
}

function respectzone_comment_mb_stripos_all($haystack, $needle) {
	$s = 0;
	$i = 0;
	while(is_integer($i)) {
		$i = mb_stripos($haystack, $needle, $s);
		if(is_integer($i)) {
			$aStrPos[] = $i;
			$s = $i + mb_strlen($needle);
		}
	}
	if(isset($aStrPos)) {
		return $aStrPos;
	} else {
		return false;
	}
}

function respectzone_comment_filter_text( $comment_text, $comment = null ) {
	$origin = $comment_text;
	$dictionnaire=respectzone_comment_getdictionnaire();
	$tableau=explode(',',$dictionnaire);
	usort($tableau, 'respectzone_comment_tri_taille_chaine');
	foreach($tableau as $elem ){
		$mystring = $comment_text;
		//$findme   = utf8_decode($elem);
        $pos = strpos(strtoupper($mystring), strtoupper($elem));
        if ($pos === false) {
			//rien a faire
		} else {
			//$comment_text = str_replace($findme,getrandomalias($findme),$mystring);
			$comment_text = preg_replace("/\b".$elem."\b/i",respectzone_comment_getrandomalias($elem),$mystring);
			continue;
		}
	}

	$nball =  respectzone_comment_mb_stripos_all($comment_text,"<img src=".plugin_dir_url( __FILE__ )."images/");

	if (count($nball)>1){

	$postion = rand(1,count($nball))-1;

	//$comment_text_replace  = serialize($nball).'||'.$postion."--";
	$comment_text_replace = substr($comment_text, 0, $nball[$postion]);
	$comment_text_replace .= "<a  title='Respect Zone' target=blank href='http://www.respectzone.org/charte'><img alt='respect zone' src=".plugin_dir_url( __FILE__ )."images/1.gif ></a>";
	$comment_text_replace .= substr($comment_text, $nball[$postion], strlen($comment_text));

	//$comment_text_replace .= count($nball).serialize($nball);
	$comment_text = $comment_text_replace;
	}
	return $comment_text;//.'|||'.$origin;
}
add_filter( 'comment_text', 'respectzone_comment_filter_text', 10, 2 );

add_action( 'comment_form', 'my_form_notice' );
function my_form_notice( $id ){
	if (get_locale()=='fr_FR') {
		echo '<div style="text-align:right;"><a target=_blank href="http://www.respectzone.org/"><img src="' . plugin_dir_url(__FILE__) . '/images/mention_fr.png" ></a></div>';
	}else{
		echo '<div style="text-align:right;"><a target=_blank href="http://www.respectzone.org/"><img src="' . plugin_dir_url(__FILE__) . '/images/mention_en.png" ></a></div>';
	}
};
