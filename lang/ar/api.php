<?php

return [

    'auth' => [
        'registered_successfully'               => 'تم التسجيل بنجاح',
        'provided_email_not_found'              => 'لم يتم العثور على هذا الإيميل',
        'otp_code'                              => 'رمز التأكيد',
        'your_verification_code'                => 'هذا هو رمز التأكيد الخاص بك',
        'otp_sent_successfully'                 => 'تم إرسال الرمز بنجاح',
        'your_account_deactivated'              => 'تم إلغاء تنشيط حسابك',
        'your_account_have_been_banned'         => 'تم حظر حسابك',
        'wrong_email_or_password'               => 'الإيميل أو كلمة المرور خاطئ',
        'login_success'                         => 'تم تسجيل الدخول بنجاح',


        'request_successfully'                  => 'تم الطلب بنجاح',
        'incorrect_otp'                         => 'الرمز غير صحيح',
        'your_account_already_active'           => 'حسابك مفعل بالفعل',
        'phone_verification_success'            => 'تم التحقق من الهاتف بنجاح',

        'please_verify_phone_first'             => 'الرجاء التحقق من هاتفك أولاً',

        'wrong_phone_or_otp'                    => 'رقم الهاتف أو الرمز خاطئ',
        'verify_your_phone_first'               => 'الرجاء التحقق من هاتفك أولاً',
        'account_have_deactivated'              => 'تم إلغاء تنشيط حسابك',
        'account__banned'                       => 'تم حظر حسابك',
        'reset_password_code_sent_successfully'     => 'تم إرسال رمز إعادة ضبط كلمة المرور بنجاح',
        'password_updated_successfully'         => 'تم تحديث كلمة المرور بنجاح',
        'log_out_success'                       => 'تم تسجيل الخروج بنجاح',
        'cant_delete_account_while_order_open'  => 'لا يمكن حذف الحساب أثناء وجود طلب مفتوح',
        'account_deleted_successfully'          => 'تم حذف الحساب بنجاح',
        'update_request_success'                => 'تم تحديث الطلب بنجاح',
        'phone_verified_successfully'           => 'تم التحقق من الهاتف بنجاح',
        'please_complete_your_data'             => 'من فضل ادخل رقم هاتف صحيح',
        'OTP_Correct'                           => 'الرمز صحيح',
        'incorrect_registration'                => 'بيانات تسجيل غير صحيحة'
    ],

    'profile' => [
        'lang_changed_successfully' => 'تم تغير اللغة بنجاح.',
        'password_changed_successfully' => 'تم تغير كلمة السر بنجاح.',
        'profile_updated_successfully' => 'تم تعديل الحساب بنجاح.',
        'success' => 'تم بنجاح',
        'incorrect_password' => 'كلمة مرور غير صحيحة حاول مرة أخرى',
        'user_not_found' => 'هذا المستخدم غير موجود',
    ],

    'maintenance' => [
        'added_successfully' => 'تم إضافة طلب الصيانة بنجاح',
        'updated_successfully' => 'تم تعديل طلب الصيانة بنجاح',
        'not_valid_maintenance_to_hold' => 'الصيانة المطلوب تعديلها غير صحيحة',
        'you_already_have_new_maintenance' => 'لديك صيانة جديدة بالفعل لهذا المصعد',
    ],

    'error' => 'حدث خطأ ما.',
    'new_message' => 'لديك رسالة جديده من :username.',
    'new_admin_message' => 'لديك رساله جديده من الادراة',
    'new_technical' => 'تم تسجيل حساب فنى جديد.',
    'in_progress' => 'تم تغير حالة الطلب الى قيد التنفيذ.',
    'on_the_way' => 'تم تغير حالة الطلب الى فى الطريق.',
    'technical_hold_maintenance' => 'تم تغير حالة الطلب الى معلق.',
    'delete_success' => 'تم الحذف بنجاح',
    'read_success' => 'تمت القراءة بنجاح',
    'added_success' => 'تمت الإضافة بنجاح',

    'order' => [
        'used_voucher_before' => 'المستخدم قد استخدم القسيمة من قبل',
        'cannot_use_voucher' => 'لا يمكن استخدام هذه القسيمة',
        'car_price_not_found_for_this_trip' => 'لا يوجد سعر للسيارة في هذا الرحلة',
        'cannot_use_this_voucher_with_this_car' => 'لا يمكن استخدام هذه القسيمة مع هذه السيارة',
        'car_not_available_on_this_duration'    => 'السيارة غير متوفرة في الوقت المحدد',
        'is_save_btn_key_required' => 'Is save key required',
        'order_dont_have_contracts' => 'لا يوجد عقود لهذا الطلب',
        'order_not_allowed_to_edit' => 'غير مسموح بتعديل هذا الطلب',
        'you_already_have_an_active_order' => 'انت لديك اوردر بالفعل',
        'status' => [
            'in_completed' => 'غير مكتمل',
            'confirmed' => 'مؤكد',
            'paid' => 'مدفوع',
            'apply_contract' => 'تقديم عقد',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
        ]
    ],
    'notification' => [
        'new_order' => 'تم تسجيل طلب جديد بنجاح',
        'title_new_order' => 'طلب جديد',
        'in_progress' => 'بدأ السائق الرحلة',
        'paid_order' => 'تم دفع قيمة الطلب',
        'title_paid_order' => 'دفع طلب',
        'completed' => 'انتهى السائق من الرحلة',
        'trip_points' => 'لقد حصلت على نقاط من رحلة جديدة',
        'trip_points_achieve' => 'لقد حققت الحد الأقصى للنقاط',
        'referral_points' => 'لقد حصلت على نقاط من استخدام رمز الإحالة الخاص بك',
        'payment_confirmed' => 'تم دفع الطلب بنجاح',
        'update_order' => 'تم تعديل الطلب بنجاح',
        'title_update_order' => 'تحديث طلب',
        'edit_order' => 'تم تعديل الطلب بنجاح',
        'cancel_order' => 'تم إلغاء الطلب بنجاح',
        'title_cancel_order' => 'إلغاء طلب',
        'user_canceled_order' => 'قام المستخدم بإلغاء الطلب',
        'user' => [
            'assigned' => 'تم تعيين سائق للقيام بتوصيلك',
            'details' => [
                'assigned' => 'تم تعيين السائق :driver للقيام بالرحلة'
            ]
        ],
        'driver' => [
            'assigned' => 'تم تعيينك للقيام برحلة',
            'details' => [
                'assigned' => 'تم تعيينك للقيام برحلة'
            ]
        ]
    ],
    'voucher' => [
        'new_voucher_title' => 'لديك قسيمة جديدة :title',
        'new_voucher_body' => 'لديك قسيمة جديدة :title',
    ],

    'add' => [
        'new_add_title' => 'لديك اعلان جديدة :title',
        'new_add_body' => 'لديك اعلان جديدة :title',
    ],

    'settings' => [
        'about_not_found' => 'قسم المعلومات غير متاح.',
        'policy_not_found' => 'قسم السياسات غير متاح.',
        'vision_not_found' => 'قسم الرؤية غير متاح.',
        'terms_not_found' => 'قسم الشروط غير متاح.',
        'share_not_found' => 'قسم الشير غير متاح',
        'refund_not_found' => 'قسم سياسة الإسترجاع غير متاح',
        'success' => 'تم بنجاح',
    ],
    'message' => [
        'added' => 'تم إضافة الرسالة بنجاح',
    ],
    'date_package_not_found' => 'هذا العنصر غير موجود',
    'not_auth_login' => 'من فضلك قم بتسجيل الدخول أولا',
    'failed_send_otp' => 'لم يتم ارسال رمز التحقق',
    'no_clients_found' => 'لا يوجد عملاء',
    'success' => 'تم بنجاح',
];
