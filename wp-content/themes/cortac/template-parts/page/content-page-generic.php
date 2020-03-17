<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Cortac
 * @since 1.0
 * @version 1.0
 */

$page_content = "";
$feature_image = "";
if (have_rows('basic_content')) {
    
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'generic_content' :
            	$row =1;
                while(have_rows('gen_left_content')) : the_row();
                    $heading = get_sub_field("gen_left_cnt_heading");
                    $page_content = html_entity_decode(get_sub_field("gen_cnt_content"));
                    while(have_rows('gen_cnt_button')): the_row();
                        $button_title = get_sub_field('gen_cnt_btn_title');
                        $button_link = get_sub_field('gen_cnt_button_link');
                        $button_blue = get_sub_field('gen_cnt_blue_button');
                        $blue_active = ($button_blue)?'btn-conv':'';
                        $button_con = '<a href="'.$button_link.'" class="btn btn-link '.$blue_active.'">'.$button_title.'</a>';
                    endwhile;
                        if(get_sub_field("gen_cnt_image")){
                            $tmp_image = get_sub_field("gen_cnt_image"); 
                            $feature_image = $tmp_image['url'];
                        }
                        $row_class =($row%2==0)?'gray':'';
                    ?>
					<section class="service-detail generic <?php echo $row_class;?>">
					    <div class="container">
					    <div class="row">
				            <div class="col-md-5">
				                <?php
				                    echo '<h2>'.$heading.'</h2>';
				                    echo $page_content; 
				                    echo $button_con;
				                ?>    
				            </div>
				            <div class="col-md-7">
				                <img class="img-responsive" src="<?php echo $feature_image;?>" />
				            </div>
				            </div>
				            </div>
				    </section>
                        <?php
                        $row++;
                endwhile;        
                $generic_cnt = get_sub_field("gen_fix_content");
                if($generic_cnt){
                	$secon_row_class =($row_class=='gray')?'':'gray';	
                	?>
					<section class="service-detail generic <?php echo $secon_row_class;?>">
					    <div class="container">
					    <div class="row">
				            <div class="col-md-12">
				                <?php
				                	echo $generic_cnt;
				                ?>    
				            </div>
				            </div>
				            </div>
				    </section>
                	<?php
                }
                
        }
endwhile;
}
?>