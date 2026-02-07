<?php 
function eatgo_get_webp_url( $url = '', $folder = '' ) {
    if ( empty( $url ) ) {
        return $url;
    }

    $user_agent = ! empty( $_SERVER['HTTP_USER_AGENT'] ) ? $_SERVER['HTTP_USER_AGENT'] : '';
    if ( stripos( $user_agent, 'Chrome' ) === false ) {
        return $url;
    }

    if ( $folder == 'themes' ) {
        $basedir = THEME_URL;
        $baseurl = THEME_URI;
    } else {
        $upload_info = wp_upload_dir();
        $basedir     = $upload_info['basedir'];
        $baseurl     = $upload_info['baseurl'];
    }

    try {
        $http_prefix     = 'http://';
        $https_prefix    = 'https://';
        $relative_prefix = '//';

        if ( ! strncmp( $url, $https_prefix, strlen( $https_prefix ) ) ) {
            $baseurl = str_replace( $http_prefix, $https_prefix, $baseurl );
        } else if ( ! strncmp( $url, $http_prefix, strlen( $http_prefix ) ) ) {
            $baseurl = str_replace( $https_prefix, $http_prefix, $baseurl );
        } else if ( ! strncmp( $url, $relative_prefix, strlen( $relative_prefix ) ) ) {
            $baseurl = str_replace( array( 0 => "$http_prefix", 1 => "$https_prefix" ), $relative_prefix, $baseurl );
        }


        if ( false === strpos( $url, $baseurl ) ) {
            return $url;
        }

        $rel_path = str_replace( $baseurl, '', $url );
        $img_path = $basedir . $rel_path;
        if ( ! file_exists( $img_path ) || ! getimagesize( $img_path ) ) {
            return $url;
        }

        $info = pathinfo( $img_path );
        $ext  = $info['extension'];

        if ( $ext == 'webp' ) {
            return $url;
        }

        $img_path_array = explode( '.', $img_path );
        $img_path_array[count($img_path_array)-1] = 'webp';
        if ( $ext !== 'jpg' ) {
            $img_path_array[ array_key_last( $img_path_array ) - 1 ].= '-' . $ext;
        }
        $path_result = implode( '.', $img_path_array );
        
        if ( file_exists( $path_result ) ) {
            $webp_rel_path = str_replace( $basedir, '', $path_result );
            return $baseurl . $webp_rel_path;
        }

        $new_path = $img_path;
        if ( $ext === 'png' ) {
            $image_resource = imagecreatefrompng( $img_path );
            if ( ! imageistruecolor( $image_resource ) ) {
                imagepalettetotruecolor( $image_resource );
                
                $new_path = substr( $img_path, 0, -4 ) . '_true.png';
                imagepng( $image_resource, $new_path );
            }
            imagedestroy( $image_resource );
        }

        $editor = wp_get_image_editor( $new_path );
        if ( is_wp_error( $editor ) ) {
            return $url;
        }

        $resized_file = $editor->save( $path_result, 'image/webp' );

        if ( $img_path != $new_path ) {
            @unlink( $new_path );
        }

        if ( is_wp_error( $resized_file ) ) {
            return $url;
        }

        $webp_rel_path = str_replace( $basedir, '', $resized_file['path'] );
        return $baseurl . $webp_rel_path;
    } catch ( Exception $e ) {
        return $url;
    }
}