<?php 

/* SEND AN EMAIL AFTER POST PURHCASE HAS BEEN PUBLISHED */
function rdm_notify_supplier($ID, $post )  {    
    
        $user_email_address = $_POST['rdm_supplier'];
    
        
        
        
        // Purchase author
        $author = $post->post_author; /* Post author ID. */
        
        $name = get_the_author_meta( 'display_name', $author );
        $email = get_the_author_meta( 'user_email', $author );
        $title = $post->post_title;
        $permalink = get_permalink( $ID );
        $content    =   $post->post_content;
        $edit = get_edit_post_link( $ID, '' );
        
        // separate the users array    
        $send_to = $user_email_address;

        $subject = sprintf( 'New Purchase order: %s'. $title . 'from:' . $name, $email );
        $message = sprintf ('New purchase %s order  “%s”' . "\n\n" . $title, $content );
        $message .= sprintf( 'View: %s', $permalink );
        // create the from details 
        $headers[] = 'From: RDM <info@rdmgregg.co.uk>';
        // lets cc in the head just because we can 
        $headers[] = '';


        wp_mail($send_to, $subject, $message, $headers );
        return $post_ID;
}

   
        
    