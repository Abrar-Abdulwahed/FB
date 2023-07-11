<?php

declare(strict_types=1);

return [
    'menu' => 'الأعضاء',
    
    'fields' => [
        'name' =>' الإسم',   
        'email' => 'البريد الإلكتروني',
        'password'=>'كلمة المرور',
        'password_confirmation'=>'تأكيد كلمة المرور',
        'roles'=>'الأدوار',
        'avatar'=>'صورة العضو',
        'is_banned'=>'حالة العضو',
        'banned_until'=>'تاريخ فك الحظر',
        'last_activity'=>'اخر ظهور',
        // for emails
        'created_at'=>'تاريخ الارسال',
        'title'=>'العنوان'
    ],

    'pages' => [
        'index' => 'قائمة الاعضاء',
        'create' => 'إضافة عضو',
        'edit' => 'تعديل عضو',
        'user_activities'=>'نشاطات الأعضاء',
        'The record of emails sent to the user'=>'سجل رسائل البريد الإلكتروني المرسلة للمستخدم'
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
    ],

    'messages' => [
        'create' => 'تم إضافة العضو بنجاح',
        'edit' => 'تعم تعديل العضو بنجاح',
        'delete' => 'تم حذف العضو بنجاح',
    ],

    'extra'=> [
        'Leave it blank if not changed'=>'اتركها فارغة في حالة عدم التغيير',
        'filters'=>'فلترة حسب',
        'actions'=>'العمليات',
        'active'=>'نشيط',
        'banned'=>'محظور',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',
        'There are no messages yet'=>'لا توجد رسائل بعد'

    ]
];