<?php

/*
Thanks to WP Retina 2x (http://www.meow.fr/wp-retina-2x)
Dual licensed under the MIT and GPL licenses
*/

class bebelRetinaHelper{
    public static function generateAttachmentMetaData( $meta ) {
        if (BebelSingleton::getInstance('BebelSettings')->get('generate_2x_images') == "on"){
            if ( $meta && isset( $meta['width'] ) && isset( $meta['height'] ) ){
                bebelRetinaHelper::generate2xImages( $meta );
            }
        }
        return $meta;
    }

    public static function generate2xImages( $meta ) {
        $sizes = bebelRetinaHelper::getImageSizes();
        $originalfile = $meta['file'];
        $uploads = wp_upload_dir();
        $pathinfo = pathinfo( $originalfile );
        $original_basename = $pathinfo['basename'];
        $basepath = trailingslashit( $uploads['basedir'] ) . $pathinfo['dirname'];
        $issue = false;
        $id = bebelRetinaHelper::getAttachmentId( $meta['file'] );


        foreach ( $sizes as $name => $attr ) {
            // Is the file related to this size there?
            $pathinfo = null;
            $retina_file = null;

            if ( isset( $meta['sizes'][$name] ) && isset( $meta['sizes'][$name]['file'] ) ) {
                $normal_file = trailingslashit( $basepath ) . $meta['sizes'][$name]['file'];
                $pathinfo = pathinfo( $normal_file ) ;
                $retina_file = trailingslashit( $pathinfo['dirname'] ) . $pathinfo['filename'] . '@2x.' . $pathinfo['extension'];
            }

            if ( $retina_file && file_exists( $retina_file ) ) {
                continue;
            }
            if ( $retina_file ) {
                $originalfile = trailingslashit( $pathinfo['dirname'] ) . $original_basename;

                if ( !file_exists( $originalfile ) ) {
                    return $meta;
                }

                // Maybe that new image is exactly the size of the original image.
                // In that case, let's make a copy of it.
                if ( $meta['sizes'][$name]['width'] * 2 == $meta['width'] && $meta['sizes'][$name]['height'] * 2 == $meta['height'] ) {
                    copy ( $originalfile, $retina_file );
                }
                // Otherwise let's resize (if the original size is big enough).
                else if ( $meta['sizes'][$name]['width'] * 2 <= $meta['width'] && $meta['sizes'][$name]['height'] * 2 <= $meta['height'] ) {
                    $image = bebelRetinaHelper::resize( $originalfile, $meta['sizes'][$name]['width'] * 2,
                        $meta['sizes'][$name]['height'] * 2, $retina_file );
                }
            }
        }

        // Checks attachment ID + issues
        if ( !$id )
            return $meta;

        return $meta;
    }

    public static function resize( $file_path, $width, $height, $newfile ) {
        $orig_size = getimagesize( $file_path );
        $image_src[0] = $file_path;
        $image_src[1] = $orig_size[0];
        $image_src[2] = $orig_size[1];
        $file_info = pathinfo( $file_path );
        $extension = '.' . $file_info['extension'];
        $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];
        $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . "-tmp" . $extension;
        $image = wp_get_image_editor( $file_path );
        $image->resize( $width, $height, true );

        $quality = 100;
        if ( is_numeric( $quality ) ) {
            $image->set_quality( intval( $quality ) );
        }

        $image->save( $cropped_img_path );
        if ( rename( $cropped_img_path, $newfile ) )
            $cropped_img_path = $newfile;
        $new_img_size = getimagesize( $cropped_img_path );
        $new_img = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
        $vt_image = array ( 'url' => $new_img, 'width' => $new_img_size[0], 'height' => $new_img_size[1] );
        return $vt_image;
    }

    public static function getImageSizes() {
        $sizes = array();
        global $_wp_additional_image_sizes;
        foreach (get_intermediate_image_sizes() as $s) {
            $crop = false;
            if (isset($_wp_additional_image_sizes[$s])) {
                $width = intval($_wp_additional_image_sizes[$s]['width']);
                $height = intval($_wp_additional_image_sizes[$s]['height']);
                $crop = $_wp_additional_image_sizes[$s]['crop'];
            } else {
                $width = get_option($s.'_size_w');
                $height = get_option($s.'_size_h');
                $crop = get_option($s.'_crop');
            }
            $sizes[$s] = array( 'width' => $width, 'height' => $height, 'crop' => $crop );
        }
        return $sizes;
    }

    public static function getAttachmentId( $file ) {
        $query = array(
            'post_type' => 'attachment',
            'meta_query' => array(
                array(
                    'key'		=> '_wp_attached_file',
                    'value'		=> ltrim( $file, '/' )
                )
            )
        );
        $posts = get_posts( $query );
        foreach( $posts as $post )
            return $post->ID;
        return false;
    }

    public static function generate2xImageForAllAttachments(){
        try {
            global $wpdb;
            $postids = $wpdb->get_col( "
                SELECT p.ID
                FROM $wpdb->posts p
                WHERE post_status = 'inherit'
                AND post_type = 'attachment'
                AND ( post_mime_type = 'image/jpeg' OR
                    post_mime_type = 'image/png' OR
                    post_mime_type = 'image/gif' )
            " );
            foreach ($postids as $id) {
                bebelRetinaHelper::deleteAttachment( $id );
                $meta = wp_get_attachment_metadata( $id );
                bebelRetinaHelper::generate2xImages( $meta );
            }
            return array(
                'successful' => true
            );
        }
        catch (Exception $e) {
            return array(
                'successful' => false,
                'message' => $e->getMessage()
            );
        }
    }

    public static function deleteAttachment( $attach_id ) {
        $meta = wp_get_attachment_metadata( $attach_id );
        bebelRetinaHelper::delete2xImages( $meta );
    }

    public static function delete2xImages( $meta ) {
        if ( !isset( $meta['sizes'] ) )
            return $meta;
        $sizes = $meta['sizes'];
        if ( !$sizes || !is_array( $sizes ) )
            return $meta;
        $originalfile = $meta['file'];
        $id = bebelRetinaHelper::getAttachmentId( $originalfile );
        $pathinfo = pathinfo( $originalfile );
        $uploads = wp_upload_dir();
        $basepath = trailingslashit( $uploads['basedir'] ) . $pathinfo['dirname'];
        foreach ( $sizes as $name => $attr ) {
            $pathinfo = pathinfo( $attr['file'] );
            $retina_file = $pathinfo['filename'] . '@2x.' . $pathinfo['extension'];
            if ( file_exists( trailingslashit( $basepath ) . $retina_file ) ) {
                unlink( trailingslashit( $basepath ) . $retina_file );
                do_action( 'wr2x_retina_file_removed', $id, $retina_file );
            }
        }
        return $meta;
    }
}