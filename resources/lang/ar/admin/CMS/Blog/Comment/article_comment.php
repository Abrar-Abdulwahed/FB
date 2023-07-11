<?php

declare(strict_types=1);

return [
    'menu' => 'التعليقات',
    
    'fields' => [
        'id'=>'id',
        'user_id'=>'المستخدم',
        'article_id'=>'المقال',
        'comment'=>'التعليق',
    ],

    'pages' => [
        'index' => 'عرض التعليقات',
        'create' => 'إضافة قسم',
        'edit' => 'تعديل قسم',
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
    ],

    'messages' => [
        'create' => 'تم إضافة التعليق بنجاح',
        'delete' => 'تم حذف التعليق بنجاح',
        'pre_delete' => 'تم حذف التعليق نهائيا',
        'restore' => 'تم استعادة التعليق بنجاح',
    ],

    'extra'=> [
        'actions'=>'العمليات',
        'block'=>'حظر',
        'confirm_block'=>'تأكيد الحظر',
        'Are you sure you want block this item'=>'هل أنت متأكد من حظر هذا العنصر حذف نهائي؟',

        'Delete all comments of this user'=>'حذف كل تعليقات المستخدم',
        'Are you sure you want delete all comments of this user'=>'هل أنت متأكد من حذف كل تعليقات هذا المستخدم؟',

        'confirm_delete'=>'تأكيد الحذف',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',

        'cancel_delete'=>'الغاء الحذف',
        'confirm_restore_comment'=>'تأكيد استعادة التعليق',
        'Are you sure you want to restore this item'=>'هل أنت متأكد من استعادة هذا التعليق ؟',

        'confirm'=>'تأكيد',
        'close'=>'اغلاق',
        'yes'=>'نعم',

    ]
];