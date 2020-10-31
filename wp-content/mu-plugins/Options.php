<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	
	Container::make( 'theme_options', __('SmartStaff') )
//	         ->where( 'theme_options', '=', 'page' ) //TODO might need this
	         ->add_tab( __('General'), array(
		         Field::make( 'text', 'ss_general_default_country_prefix', 'Default Country Prefix' )->set_default_value('START')
	         ) )
	         ->add_tab( __('Questionnaire'), array(
		         Field::make( 'text', 'ss_questionnaire_command_to_start', 'Command to Start' ),
		         Field::make( 'textarea', 'ss_questionnaire_sms_invite_template', 'SMS Invitation Template' ),
		         Field::make( 'textarea', 'ss_questionnaire_whatsapp_invite_template', 'Invitation Template' ),
		         Field::make( 'textarea', 'ss_questionnaire_complete_template', 'Completion Template' )
	         ) )
	         ->add_tab( __('SMS'), array(
		         Field::make( 'text', 'ss_sms_server_url', 'Server URL' ),
		         Field::make( 'text', 'ss_sms_username', 'Username' ),
		         Field::make( 'text', 'ss_sms_password', 'Password' )
	         ) )
	         ->add_tab( __('MessengerPeople'), array(
		         Field::make( 'text', 'ss_mp_channel_api_url', 'Channel API URL' ),
		         Field::make( 'text', 'ss_mp_channel_api_key', 'Channel API Key' ),
		         Field::make( 'text', 'ss_mp_channel_id', 'Channel ID' ),
		         Field::make( 'text', 'ss_mp_channel_number', 'Channel Number' )
	         ) )
	         ->add_tab( __('Voucher'), array(
		         Field::make( 'text', 'ss_voucher_system_url', 'System URL' ),
		         Field::make( 'text', 'ss_voucher_username', 'Username' ),
		         Field::make( 'text', 'ss_voucher_password', 'Password' )
	         ) )
            ->title = 'Craig';
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
	require_once( ABSPATH.'vendor/autoload.php' );
	\Carbon_Fields\Carbon_Fields::boot();
}
