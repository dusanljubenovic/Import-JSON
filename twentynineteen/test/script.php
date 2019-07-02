<?php


function import_events() {

	$events_data = json_decode( file_get_contents( get_template_directory_uri().'/test/datas.json' ) );

  insert_or_update( $events_data );

  wp_die();
  
  }

  function insert_or_update($events_data) {


	if ( ! $events_data)
	  return false;
     
    foreach($events_data as $event){

       $number_updates=0;
       $number_new_events=0;

        if (get_post_status($event ->id)) {

            $number_updates++;
            
            $dev_post = array(
            'ID'                =>  $event ->id,
            'post_content'      =>  $event ->about,
            'post_title'    => $event ->title,
            'post_type'     => 'events',
            'post_status'   => 'publish',
            );  

            if ( isset($event->organizer) ) {
            update_post_meta( $event ->id, 'organizer', $event->organizer );
            }

            if ( isset($event->email) ) {
            update_post_meta( $event ->id, 'email', $event->email );
            }

            if ( isset($event->address) ) {
            update_post_meta( $event ->id, 'address', $event->address );
            }

            if ( isset($event->latitude) ) {
            update_post_meta( $event ->id, 'latitude', $event->latitude );
            }

            if ( isset($event->longitude) ) {
            update_post_meta( $event ->id, 'longitude', $event->longitude );
            }

            if ( isset($event->isActive) ) {
            update_post_meta( $event ->id, 'active', $event->isActive );
            }

            if ( isset($event->timestamp) ) {
						update_post_meta( $event ->id, 'time', $event->timestamp );
            }

            if ( isset($event->tags) ) {
            wp_set_object_terms($event ->id, $event->tags, 'event_tag');
            }
        

             wp_insert_post($dev_post);
        }

        //if not in database, set id
        else {

            $number_new_events++;

            $dev_post = array(
            'import_id'                =>  $event ->id,
            'post_content'      =>  $event ->about,
            'post_title'    => $event ->title,
            'post_type'     => 'events',
            'post_status'   => 'publish',
            );  

             if ( isset($event->organizer) ) {
              update_post_meta( $event ->id, 'organizer', $event->organizer );
              }
  
              if ( isset($event->email) ) {
              update_post_meta( $event ->id, 'email', $event->email );
              }
  
              if ( isset($event->address) ) {
              update_post_meta( $event ->id, 'address', $event->address );
              }
  
              if ( isset($event->latitude) ) {
              update_post_meta( $event ->id, 'latitude', $event->latitude );
              }
  
              if ( isset($event->longitude) ) {
              update_post_meta( $event ->id, 'longitude', $event->longitude );
              }
  
              if ( isset($event->isActive) ) {
              update_post_meta( $event ->id, 'active', $event->isActive );
              }
  
              if ( isset($event->timestamp) ) {
              update_post_meta( $event ->id, 'time', $event->timestamp );
              }
  
              if ( isset($event->tags) ) {
              wp_set_object_terms($event ->id, $event->tags, 'event_tag');
              }

           
        
             wp_insert_post($dev_post);
        }



    }
    
		//Sent email
		$to      = 'logging@agentur-loop.com';
		$subject = 'Import Events - Dusan Ljubenovic';
		$body = 'Imported '.$number_new_events.' new events and updated '.$number_updates.' existing.';
		$headers = 'From: webmaster@example.com' . "\r\n" .
				'Reply-To: webmaster@example.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
		

    wp_mail($to, $subject, $body, $headers);


  
  }

	import_events();