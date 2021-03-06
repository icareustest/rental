<?php
$full_img='';
if (esc_html( get_post_meta($post->ID, 'group_pictures', true) ) == 'yes') {   
    $arguments = array(
        'numberposts'       =>  -1,
        'post_type'         =>  'attachment',
        'post_parent'       =>  $post->ID,
        'post_status'       =>  null, 
        'orderby'           =>  'menu_order',
        'post_mime_type'    =>  'image',
        'order'             =>  'ASC'
    );
  
    $post_attachments   = get_posts($arguments);
    if ($post_attachments || has_post_thumbnail() ) {  ?>   
        <div id="carousel-example-generic" class="carousel slide post-carusel" data-ride="carousel" data-interval="false">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <?php  
            $counter=0;
            foreach ($post_attachments as $attachment) {
                $counter++;
                $active='';
                if($counter==1 ){
                    $active=" active ";
                }else{
                     $active=" ";
                }
                ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php print intval($counter-1);?>" class="<?php esc_attr($active);?>"></li>   
            <?php
            }
            ?>
            </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php
            $counter=0;
            foreach ($post_attachments as $attachment) {

                $counter++;
                $active='';
                if($counter==1){
                    $active=" active ";
                }else{
                     $active=" ";
                }
                $full_img        = wp_get_attachment_image_src($attachment->ID, 'wpestate_property_full_map');
                $full_prty       = wp_get_attachment_image_src($attachment->ID, 'full');
                $attachment_meta = wpestate_get_attachment($attachment->ID)
                ?>

                <div class="item <?php print esc_attr($active);?>">
                    <a href="<?php print esc_url($full_prty[0]); ?>" rel="prettyPhoto[pp_gal]" class="prettygalery" > 
                        <img  src="<?php print esc_url($full_img[0]);?>" alt="<?php print esc_attr($attachment_meta['caption']); ?>" class="img-responsive" />
                    </a>

                    <?php if ($attachment_meta['caption']!='') { ?>
                    <div class="carousel-caption">
                        <div class="carousel-caption-text"><?php print esc_html($attachment_meta['caption']);?></div>
                        <div class="carousel-caption-back"></div>
                    </div>
                    <?php } ?>
                </div>

             <?php } //end foreach?>
            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic"  id="post_carusel_left" data-slide="prev">
               <i class="fas fa-angle-left"></i>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" id="post_carusel_right" data-slide="next">
               <i class="fas fa-angle-right"></i>
            </a>
        </div>

    <?php
    } // end if post_attachments
} //end grup pictures