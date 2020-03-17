<?php

/**
 * Template Name: Contact us
 *
 * @package WordPress
 * @subpackage Cortac
 * @since Cortac 1.0
 */
if (!empty($_POST)) {
    $name = $_POST['first_name']." ".$_POST['last_name'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    
    $to = bloginfo('admin_email');
    $subject = 'Contact us';
    $body = '<html>';
    $body .= '<body>';
    $body .= 'Name : '.$name."<br>";
    $body .= 'Company : '.$company."<br>";
    $body .= 'Email : '.$email."<br>";
    $body .= '</body>';
    $body .= '</html>';
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($to, $subject, $body, $headers);
    if ( wp_redirect(getPageLinkByName('contact') ) ) {
        exit;
    }
}
get_header();
?>
<?php

if (have_rows('basic_content')) {
    while (have_rows('basic_content')) : the_row();
        // All your subfields code for this goes here.
        switch (get_row_layout()) {
            case 'contact_content' :
                get_template_part('template-parts/page/contact/content', 'contact-us');
                break;
        }
    endwhile;
}
?>


<?php

get_footer();
