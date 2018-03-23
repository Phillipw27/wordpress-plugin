<?php
/**
 * Plugin Name: Team Members PRO
 * Plugin URI: http://wpdarko.com/items/team-members-pro/
 * Description: A responsive, simple and clean way to display your team. Create new members, add their positions, bios, social links (and much more) and copy-paste the shortcode into any post/page. Find support and information on the <a href="http://wpdarko.com/items/team-members-pro/">plugin's page</a>.
 * Version: 1.3.1
 * Author: WP Darko
 * Author URI: http://wpdarko.com
 * License: GPL2
 */

/* adds stylesheet and script */
add_action( 'wp_enqueue_scripts', 'add_tmmp_scripts' );
function add_tmmp_scripts() {
	wp_enqueue_style( 'tmm', plugins_url('css/tmm_custom_style.min.css', __FILE__));
}

add_action( 'init', 'create_tmmp_type' );

function create_tmmp_type() {
  register_post_type( 'tmm',
    array(
      'labels' => array(
        'name' => 'Teams',
        'singular_name' => 'Team'
      ),
      'public' => true,
      'has_archive'  => false,
      'hierarchical' => false,
      'capability_type'    => 'post',
      'supports'     => array( 'title' ),
      'menu_icon'    => 'dashicons-plus',
    )
  );
}

/**
* Define the metabox and field configurations.
*
* @param array $meta_boxes
* @return array
*/
function tmmp_metaboxes( array $meta_boxes ) {
    $fields = array(
        array( 'id' => 'tmm_content_head', 'name' => 'Staff details', 'type' => 'title' ),
        array( 'id' => 'tmm_color', 'name' => 'Staff color', 'type' => 'colorpicker', 'default' => '#57c9e0', 'cols' => 12  ),
        array( 'id' => 'tmm_firstname', 'name' => 'Firstname', 'type' => 'text', 'cols' => 4 ),
        array( 'id' => 'tmm_lastname', 'name' => 'Lastname', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_job', 'name' => 'Job/role', 'type' => 'text', 'cols' => 4),
        array( 'id'   => 'tmm_photo', 'name' => 'Photo', 'type' => 'image', 'cols' => 3, 'size' => 'height=150&width=150&crop=1'),
        array( 'id' => 'tmm_desc', 'name' => 'Description/bio', 'type' => 'textarea', 'rows' => 8, 'cols' => 9),
        array( 'id' => 'tmm_comp_title', 'name' => 'Complementary info title', 'desc' => 'This adds a little link below the description/bio, it will reveal the complementary info text when a visitor hover over it.', 'type' => 'text', 'cols' => 12),
        array( 'id' => 'tmm_comp_text', 'name' => 'Complementary info text', 'type' => 'textarea', 'rows' => 3, 'cols' => 12),
        array( 'id' => 'tmm_links_head', 'name' => 'Links', 'type' => 'title' ),
        array( 
            'id'      => 'tmm_sc_type1',  
            'type'    => 'select',
            'desc' => 'Icon',
            'cols' => 3,
            'options' => array(
                'nada' => '-',
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'googleplus' => 'Google+',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'tumblr' => 'Tumblr',
                'pinterest' => 'Pinterest',
                'email' => 'Email',
                'website' => 'Website',
                'customlink' => 'Other links',
            )
        ),
        array( 'id' => 'tmm_sc_title1',  'desc' => 'Title', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_sc_url1',  'default' => 'http://', 'desc' => 'URL', 'type' => 'text', 'cols' => 5),
        array( 
            'id'      => 'tmm_sc_type2', 
            'type'    => 'select',
            'cols' => 3,
            'options' => array(
                'nada' => '-',
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'googleplus' => 'Google+',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'tumblr' => 'Tumblr',
                'pinterest' => 'Pinterest',
                'email' => 'Email',
                'website' => 'Website',
                'customlink' => 'Other links',
            )
        ),
        array( 'id' => 'tmm_sc_title2', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_sc_url2', 'default' => 'http://', 'type' => 'text', 'cols' => 5),
        array( 
            'id'      => 'tmm_sc_type3',  
            'type'    => 'select',
            'cols' => 3,
            'options' => array(
                'nada' => '-',
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'googleplus' => 'Google+',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'tumblr' => 'Tumblr',
                'pinterest' => 'Pinterest',
                'email' => 'Email',
                'website' => 'Website',
                'customlink' => 'Other links',
            )
        ),
        array( 'id' => 'tmm_sc_title3', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_sc_url3', 'default' => 'http://', 'type' => 'text', 'cols' => 5),
        array( 
            'id'      => 'tmm_sc_type4',  
            'type'    => 'select',
            'cols' => 3,
            'options' => array(
                'nada' => '-',
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'googleplus' => 'Google+',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'tumblr' => 'Tumblr',
                'pinterest' => 'Pinterest',
                'email' => 'Email',
                'website' => 'Website',
                'customlink' => 'Other links',
            )
        ),
        array( 'id' => 'tmm_sc_title4', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_sc_url4', 'default' => 'http://', 'type' => 'text', 'cols' => 5),
        array( 
            'id'      => 'tmm_sc_type5',  
            'type'    => 'select',
            'cols' => 3,
            'options' => array(
                'nada' => '-',
                'twitter' => 'Twitter',
                'linkedin' => 'LinkedIn',
                'googleplus' => 'Google+',
                'facebook' => 'Facebook',
                'instagram' => 'Instagram',
                'tumblr' => 'Tumblr',
                'pinterest' => 'Pinterest',
                'email' => 'Email',
                'website' => 'Website',
                'customlink' => 'Other links',
            )
        ),
        array( 'id' => 'tmm_sc_title5', 'type' => 'text', 'cols' => 4),
        array( 'id' => 'tmm_sc_url5', 'default' => 'http://', 'type' => 'text', 'cols' => 5),
    );
    
    $group_settings = array(
        array( 
            'id'      => 'tmm_columns',  
            'type'    => 'select',
            'desc' => 'Number of members to show per line.',
            'options' => array(
                '1' => 'One member per line',
                '2' => 'Two members per line',
                '3' => 'Three members per line',
                '4' => 'Four members per line',
                '5' => 'Five members per line',
            )
        ),
        array( 
            'id'      => 'tmm_picture_shape',  
            'type'    => 'select',
            'desc' => 'What shape should your pictures have?',
            'options' => array(
                'round' => 'Rounded pictures',
                'square' => 'Squared pictures',
            )
        ),
        array( 
            'id'      => 'tmm_picture_border',  
            'type'    => 'select',
            'desc' => 'Enable/disable the grey border around the pictures.',
            'options' => array(
                'yes' => 'Yes',
                'no' => 'No',
            )
        ),
        array( 
            'id'      => 'tmm_picture_position',  
            'type'    => 'select',
            'desc' => 'Position of the picture',
            'options' => array(
                'floating' => 'Floating at the top',
                'inbox' => 'Inside the box',
            )
        ),
        array( 
            'id'      => 'tmm_picture_filter',  
            'type'    => 'select',
            'desc' => 'Add a filter to your pictures.',
            'options' => array(
                'classic' => 'Classic',
                'vintage' => 'Vintage',
                'blackandwhite' => 'Black & White',
                'saturated' => 'Saturated',
            )
        ),
        array( 'id' => 'tmm_tp_border_size', 'desc' => 'Set the size of the colored top border (in pixels, without the "px").', 'default' => '3', 'type' => 'text'),
    );
    // Example of repeatable group. Using all fields.
    // For this example, copy fields from $fields, update I
    $group_fields = $fields;
    foreach ( $group_fields as &$field ) {
        $field['id'] = str_replace( 'field', 'gfield', $field['id'] );
    }
    $meta_boxes[] = array(
        'title' => 'Create/remove/sort team members',
        'pages' => 'tmm',
        'fields' => array(
            array(
                'id' => 'tmm_head',
                'type' => 'group',
                'repeatable' => true,
                'sortable' => true,
                'fields' => $group_fields,
                'desc' => 'Create new members here and drag and drop to reorder.',
            )
        )
    );
    $meta_boxes[] = array(
        'title' => 'Settings',
        'pages' => 'tmm',
        'context' => 'side',
        'priority' => 'high',
        'fields' => array(
            array(
                'id' => 'tmm_settings_head',
                'type' => 'group',
                'fields' => $group_settings,
            )
        )
    );
    
    return $meta_boxes;
}
add_filter( 'drkfr_meta_boxes', 'tmmp_metaboxes' );

if (!class_exists('drkfr_Meta_Box')) {
    require_once( 'drkfr/custom-meta-boxes.php' );
}

//shortcode columns
add_action( 'manage_tmm_posts_custom_column' , 'dktmmp_custom_columns', 10, 2 );

function dktmmp_custom_columns( $column, $post_id ) {
    switch ( $column ) {
	case 'shortcode' :
		global $post;
		$slug = '' ;
		$slug = $post->post_name;
   
    
    	    $shortcode = '<span style="border: solid 3px lightgray; background:white; padding:7px; font-size:17px; line-height:40px;">[tmm name="'.$slug.'"]</strong>';
	    echo $shortcode; 
	    break;
    }
}

function add_tmmp_columns($columns) {
    return array_merge($columns, 
              array('shortcode' => __('Shortcode'),
                    ));
}
add_filter('manage_tmm_posts_columns' , 'add_tmmp_columns');

//tmm shortcode
function tmmp_sc($atts) {
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
	
    query_posts( array( 'post_type' => 'tmm', 'name' => $name, ) );
    if ( have_posts() ) : while ( have_posts() ) : the_post();

    global $post;
    
	$members = get_post_meta( get_the_id(), 'tmm_head', false );
    $options = get_post_meta( get_the_id(), 'tmm_settings_head', false );
  
    foreach ($options as $key => $option) {
        $tmm_columns = $option['tmm_columns'];
    }
    
    /* checking the PRO options */
    if ($option['tmm_picture_position'] == 'inbox') {
        $picture_pos .= 'tmm-inbox-pic ';
    }

    $output .= '<div class="tmm tmm_'.$name.' '.$picture_pos.'">';
    $output .= '<div class="tmm_'.$tmm_columns.'_columns">';
    $output .= '
        <div class="tmm_wrap">
                ';
                
                $counter = 1;
                $cols = $tmm_columns;
    
                /* checking the PRO options */
    
                if ($option['tmm_picture_shape'] == 'square') {
                    $picture_classes .= 'tmm_squared-borders ';
                }
                    
                if ($option['tmm_picture_border'] == 'no') {
                    $picture_classes .= 'tmm_no-borders ';
                }
    
                if ($option['tmm_picture_filter'] == 'vintage') {
                    $picture_classes .= 'tmm_filter-vintage ';
                }
    
                if ($option['tmm_picture_filter'] == 'blackandwhite') {
                    $picture_classes .= 'tmm_filter-bandw ';
                }
    
                if ($option['tmm_picture_filter'] == 'saturated') {
                    $picture_classes .= 'tmm_filter-saturated ';
                }
                            
                $picture_att = array(
                    'class'	=> $picture_classes,
                );
    
                foreach ($members as $key => $member) {
                    
                if($i%$tmm_columns == 0) {
                        if($i > 0) { 
                            $output .= "</div>";
                            $output .= '<div class="clearer"></div>';
                        } // close div if it's not the first
                        
                        
                        $output .= "<div class='tmm_container'>";
                    } 
    
                    $output .= '<div class="tmm_member" style="border-top:'.$member['tmm_color'].' solid '.$option['tmm_tp_border_size'].'px;">';
                        $output .= wp_get_attachment_image( $member['tmm_photo'], '', '', $picture_att );
                        $output .= '<div class="tmm_textblock">';
                            $output .= '<div class="tmm_names">';
                                $output .= '<span class="tmm_fname">'.$member['tmm_firstname'].'</span>';
                                $output .= '&nbsp;';
                                $output .= '<span class="tmm_lname">'.$member['tmm_lastname'].'</span>';
                            $output .= '</div>';
                            $output .= '<div class="tmm_job">'.$member['tmm_job'].'</div>';
                            
                            $output .= '<div class="tmm_desc">';  
                                $output .= $member['tmm_desc'];
                            $output .= '</div>';
                    
                            if ($member['tmm_comp_title']) {
                                
                                $output .= '<div style="margin-top:10px; margin-bottom:15px; color:'.$member['tmm_color'].'" class="tmm_more_info">';
                                if ($member['tmm_comp_text']) {
                                    $output .= '<div class="tmm_comp_text">'.$member['tmm_comp_text'].'</div>';
                                }
                                
                                $output .= $member['tmm_comp_title'];
                                $output .= '</div>';
                            }
                           
                            $output .= '<div class="tmm_scblock">';
                            if ($member['tmm_sc_type1'] != 'nada') {
                                if ($member['tmm_sc_type1'] == 'email') {
                                    $output .= '<a class="tmm_sociallink" href="mailto:'.$member['tmm_sc_url1'].'" title="'.$member['tmm_sc_title1'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type1'].'.png"/>';
                                    $output .= '</a>';
                                } else {
                                    $output .= '<a class="tmm_sociallink" href="'.$member['tmm_sc_url1'].'" title="'.$member['tmm_sc_title1'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type1'].'.png"/>';
                                    $output .= '</a>';
                                }
                            }
                    
                            if ($member['tmm_sc_type2'] != 'nada') {
                                if ($member['tmm_sc_type2'] == 'email') {
                                    $output .= '<a class="tmm_sociallink" href="mailto:'.$member['tmm_sc_url2'].'" title="'.$member['tmm_sc_title2'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type2'].'.png"/>';
                                    $output .= '</a>';
                                } else {
                                    $output .= '<a class="tmm_sociallink" href="'.$member['tmm_sc_url2'].'" title="'.$member['tmm_sc_title2'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type2'].'.png"/>';
                                    $output .= '</a>';
                                }
                            }
                            
                            if ($member['tmm_sc_type3'] != 'nada') {
                                if ($member['tmm_sc_type3'] == 'email') {
                                    $output .= '<a class="tmm_sociallink" href="mailto:'.$member['tmm_sc_url3'].'" title="'.$member['tmm_sc_title3'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type3'].'.png"/>';
                                    $output .= '</a>';
                                } else {
                                    $output .= '<a class="tmm_sociallink" href="'.$member['tmm_sc_url3'].'" title="'.$member['tmm_sc_title3'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type3'].'.png"/>';
                                    $output .= '</a>';
                                }
                            }
                            if ($member['tmm_sc_type4'] != 'nada') {
                                if ($member['tmm_sc_type4'] == 'email') {
                                    $output .= '<a class="tmm_sociallink" href="mailto:'.$member['tmm_sc_url4'].'" title="'.$member['tmm_sc_title4'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type4'].'.png"/>';
                                    $output .= '</a>';
                                } else {
                                    $output .= '<a class="tmm_sociallink" href="'.$member['tmm_sc_url4'].'" title="'.$member['tmm_sc_title4'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type4'].'.png"/>';
                                    $output .= '</a>';
                                }
                            }
                            if ($member['tmm_sc_type5'] != 'nada') {
                                if ($member['tmm_sc_type5'] == 'email') {
                                    $output .= '<a class="tmm_sociallink" href="mailto:'.$member['tmm_sc_url5'].'" title="'.$member['tmm_sc_title5'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type5'].'.png"/>';
                                    $output .= '</a>';
                                } else {
                                    $output .= '<a class="tmm_sociallink" href="'.$member['tmm_sc_url5'].'" title="'.$member['tmm_sc_title5'].'">';
                                    $output .= '<img src="'.plugins_url('img/links/', __FILE__).$member['tmm_sc_type5'].'.png"/>';
                                    $output .= '</a>';
                                }
                            }
                            $output .= '</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                    
                    $pages_count = count( $members );
                    if ($key == $pages_count - 1) {
                        $output .= '<div class="clearer"></div>';
                    }
                    
                    $i++;
                    
                }
    
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
    $output .= '</div>';
   

  endwhile; endif; wp_reset_query(); 
	
  return $output;

}
add_shortcode("tmm", "tmmp_sc"); 

?>