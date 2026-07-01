<?php
/**
 * Custom Elementor Control: Image Select
 * Renders a grid of clickable style-thumbnail cards in the Elementor panel.
 * Stores the selected key in a hidden <select> so Elementor's native
 * data-setting binding picks up the value automatically.
 *
 * @package marbure
 */

defined( 'ABSPATH' ) || exit;

class Marbure_Control_Image_Select extends \Elementor\Base_Data_Control {

	const TYPE = 'marbure_image_select';

	public function get_type() {
		return self::TYPE;
	}

	public function get_default_value() {
		return '';
	}

	protected function get_default_settings() {
		return array_merge(
			parent::get_default_settings(),
			array( 'options' => array() )
		);
	}

	/**
	 * Enqueue editor-only CSS and the click handler JS.
	 * Called by Elementor's Controls_Manager when the panel loads.
	 */
	public function enqueue() {
		// Editor CSS — attached to a sourceless handle (valid WP inline-style pattern).
		if ( ! wp_style_is( 'marbure-img-select-ctrl', 'registered' ) ) {
			wp_register_style( 'marbure-img-select-ctrl', false, array(), null ); // phpcs:ignore
		}
		wp_enqueue_style( 'marbure-img-select-ctrl' );
		wp_add_inline_style(
			'marbure-img-select-ctrl',
			'
			.marbure-img-select {
				display: flex;
				flex-wrap: wrap;
				gap: 8px;
				padding-top: 6px;
			}
			.marbure-img-select__item {
				flex: 0 0 calc( 50% - 4px );
				cursor: pointer;
				border: 2px solid #e3e3e3;
				border-radius: 5px;
				overflow: hidden;
				transition: border-color .2s, box-shadow .2s;
			}
			.marbure-img-select__item:hover { border-color: #aaa; }
			.marbure-img-select__item img {
				width: 100%;
				display: block;
				aspect-ratio: 16 / 9;
				object-fit: cover;
				background: #f0f0f0;
			}
			.marbure-img-select__item span {
				display: block;
				text-align: center;
				font-size: 11px;
				line-height: 1.4;
				padding: 5px 6px;
				background: #f7f7f7;
				color: #777;
			}
			.marbure-img-select__item.is-active {
				border-color: #93003c;
				box-shadow: 0 0 0 2px rgba(147,0,60,.2);
			}
			.marbure-img-select__item.is-active span { color: #93003c; font-weight: 600; }
			'
		);

		// Click handler — attach to jquery, which is always present in the editor.
		wp_add_inline_script(
			'jquery',
			'( function( $ ) {
				$( document ).on( "click", ".marbure-img-select__item", function () {
					var $item = $( this );
					var $wrap = $item.closest( ".elementor-control-input-wrapper" );
					$item.siblings( ".marbure-img-select__item" ).removeClass( "is-active" );
					$item.addClass( "is-active" );
					$wrap.find( ".marbure-img-select__input" )
						.val( $item.data( "value" ) )
						.trigger( "change" );
				} );
			} )( jQuery );'
		);
	}

	/**
	 * Underscore.js / Backbone template rendered inside the Elementor panel.
	 *
	 * Available template variables (injected by Elementor's BaseData view):
	 *   data  – control configuration (label, options, …)
	 *   value – current saved value of this control
	 *
	 * IMPORTANT: do NOT use {{ }} or {{{ }}} outside of Underscore expressions;
	 * any literal double-braces in HTML comments or attributes will be evaluated.
	 */
	public function content_template() {
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">

				<div class="marbure-img-select">
					<# _.each( data.options, function( option, optValue ) { #>
						<div class="marbure-img-select__item <# if ( optValue === value ) { #>is-active<# } #>"
						     data-value="{{ optValue }}">
							<img src="{{ option.image }}" alt="{{ option.label }}" />
							<span>{{{ option.label }}}</span>
						</div>
					<# } ); #>
				</div>

				<select class="marbure-img-select__input"
				        data-setting="{{ data.name }}"
				        style="position:absolute;opacity:0;pointer-events:none;width:0;height:0;"
				        tabindex="-1"
				        aria-hidden="true">
					<# _.each( data.options, function( option, optValue ) { #>
						<option value="{{ optValue }}" <# if ( optValue === value ) { #>selected<# } #>>{{{ option.label }}}</option>
					<# } ); #>
				</select>

			</div>
		</div>
		<?php
	}
}
