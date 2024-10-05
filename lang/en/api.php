<?php
return [

    'auth' => [
        'registered_successfully'               => 'Registered successfully',
        'provided_email_not_found'              => 'Provided email not found',
        'otp_code'                              => 'Verification code',
        'your_verification_code'                => 'Your verification code',
        'otp_sent_successfully'                 => 'Otp sent successfully',
        'your_account_deactivated'              => 'Your account have been deactivated',
        'your_account_have_been_banned'         => 'Your account have been banned',
        'wrong_email_or_password'               => 'Wrong email or password',
        'login_success'                         => 'Login success',


        'request_successfully'                  => 'Request successfully',
        'incorrect_otp'                         => 'Incorrect otp!',
        'your_account_already_active'           => 'Your account already active',
        'phone_verification_success'            => 'Phone verification success',

        'please_verify_phone_first'             => 'Please verify your phone first',

        'wrong_phone_or_otp'                    => 'Wrong phone or otp',
        'verify_your_phone_first'               => 'Please verify your phone first',
        'account_have_deactivated'              => 'Your account have been deactivated',
        'account__banned'                       => 'Your account have been banned',
        'reset_password_code_sent_successfully'     => 'A reset password code has been sent successfully',
        'password_updated_successfully'         => 'Password updated successfully',
        'log_out_success'                       => 'Log out success',
        'cant_delete_account_while_order_open'  => "Can't delete account while you have opend order",
        'account_deleted_successfully'          => 'Account deleted successfully',
        'update_request_success'                => 'Update request success',
        'phone_verified_successfully'           => 'phone verified successfully',
        'please_complete_your_data'             => 'please enter valid phone number',
        'OTP_Correct'                           => 'OTP Correct',
        'incorrect_registration'                => 'Invalid registration'
    ],

    'profile' => [
        'lang_changed_successfully' => 'lang changed successfully',
        'profile_updated_successfully'  => 'Profile updated successfully',
        'password_changed_successfully' => 'Password changed successfully',
        'incorrect_password' => 'Incorrect password, Try again',
        'success' => 'success',
        'user_not_found' => 'This user not found',
    ],

    'order' => [
        'used_voucher_before' => 'The user had previously used the voucher',
        'cannot_use_voucher' => 'Cannot use this voucher',
        'car_price_not_found_for_this_trip' => 'Car price not found for this trip',
        'cannot_use_this_voucher_with_this_car' => 'Cannot use this voucher with this car',
        'car_not_available_on_this_duration' => 'Car not available on this duration',
        'is_save_btn_key_required' => 'Is save key required',
        'order_dont_have_contracts' => 'Order dont have contracts',
        'order_not_allowed_to_edit' => 'Order not allowed to edit',
        'you_already_have_an_active_order' => 'You already have an active order',
        'status' => [
            'in_completed' => 'In Completed',
            'confirmed' => 'Confirmed',
            'paid' => 'Paid',
            'apply_contract' => 'Apply Contract',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ]
    ],

    'maintenance' => [
        'added_successfully' => 'Maintenance added successfully',
        'updated_successfully' => 'Maintenance updated successfully',
        'deleted_successfully' => 'Maintenance deleted successfully',
        'not_valid_maintenance_to_hold' => 'Not valid Maintenance to hold it',
        'you_already_have_new_maintenance' => 'You already have new maintenance for this elevator',
    ],

    'notification' => [
        'new_order' => 'New Order is created successfully',
        'title_new_order' =>  'New Order',
        'in_progress' => 'Driver start the trip',
        'paid_order' => 'Order is paid successfully',
        'title_paid_order' => 'Pay order',
        'completed' => 'Driver end the trip',
        'trip_points' => 'You got points from new trip',
        'trip_points_achieve' => 'You achive the max point record',
        'referral_points' => 'You got points from using your referall code',
        'payment_confirmed' => 'Order payment done successfully',
        'edit_order' => 'Order edited successfully',
        'update_order' => 'Order updated successfully',
        'title_update_order' => 'Update order',
        'cancel_order' => 'Order canceled successfully',
        'title_cancel_order' => 'Cancel order',
        'user_canceled_order' => 'The user had canceled the order',
        'user' => [
            'assigned' => 'we assigned a driver for your trip',
            'detail' => [
                'assigned' => 'we assigned a driver :driver for your trip'
            ]
        ],
        'driver' => [
            'assigned' => 'You have been assigned to a trip',
            'detail' => [
                'assigned' => 'You have been assigned to a trip'
            ]
        ]
    ],

    'delete_success' => 'Deleted Successfully',
    'read_success' => 'Readed Successfully',
    'added_success' => 'Added Successfully',
    'error' => 'Oops Something went wrong!.',
    'new_message' => 'you have new message from :username.',
    'new_admin_message' => 'you have new message from the administration.',
    'new_technical' => 'New technical account has been registered.',
    'technical_hold_maintenance' => 'Maintenance status has been changed to hold.',

    'voucher' => [
        'new_voucher_title' => 'You have new voucher :title',
        'new_voucher_body' => 'You have new voucher :title',
    ],

    'add' => [
        'new_add_title' => 'You have new Advertisement :title',
        'new_add_body' => 'You have new Advertisement :title',
    ],

    'settings' => [
        'about_not_found' => 'The about section is not available.',
        'policy_not_found' => 'The policy section is not available.',
        'vision_not_found' => 'The vision section is not available.',
        'terms_not_found' => 'The terms section is not available.',
        'share_not_found' => 'The share section is not available.',
        'refund_not_found' => 'The refund section is not available.',
        'success' => 'success',
    ],
    'message' => [
        'added' => 'Message added successfully',
    ],
    'date_package_not_found' => 'This date package is not available',
    'not_auth_login' => 'Please login first',
    'failed_send_otp' => 'Failed to send otp',
    'no_clients_found' => 'NO clients found',
    'success' => 'Success',
];
