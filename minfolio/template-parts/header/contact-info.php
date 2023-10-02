<?php 
   	$contact_email = minfolio_get_option( 'contact-email' );
?>

<div class="menu-contact">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#151515" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
    <a href="mailto:<?php echo esc_html( $contact_email ); ?>">
        <?php echo esc_html( $contact_email ); ?>
    </a>
</div>