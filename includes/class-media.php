<?php
namespace WPAG\Media;

use Imagecraft\ImageBuilder;

class Media {

	public function __construct() {
		add_filter( 'image_downsize', [ $this, 'resize' ], 10, 4 );
	}

	public function resize( $downsize, $id, $size, $crop = true ) {

		$file_path = get_attached_file( $id, true );
		$file_info = new \finfo(FILEINFO_MIME);
		$mime_type = $file_info->buffer(file_get_contents($file_path));
		if( false !== strpos( $mime_type, 'image/gif') ) {

			$height = get_option( $size . '_size_h' );
			$width = get_option( $size . '_size_w' );

			// @todo localize appropriately
			$options = [
				'engine'            => 'php_gd',
				'locale'            => 'en',
				'gif_animation'     => true,
				'output_format'     => 'gif',
				'debug'             => true
			];
			$gif = new ImageBuilder($options);
			$layer = $gif->addImageLayer();
			$layer->http( wp_get_attachment_image_url( $id, 'full', false ) );
			error_log( print_r( $layer, true ) );

			$image = $gif->save();
			if( $image->isValid() ) {
				file_put_contents( ABSPATH . '/out.' . $image->getExtension(), $image->getContents() );
			}

		}
		/*if( 'image/gif' !== $file['type'] ) {
			return $file;
		}*/


		//return $file;
	}
}

new Media;