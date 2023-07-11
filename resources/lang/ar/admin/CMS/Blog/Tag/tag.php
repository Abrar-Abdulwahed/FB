<?php

declare(strict_types=1);

return [
    'menu' => 'Tags',
    
    'fields' => [
        'name'=>'الاسم',
        'slug'=>'Slug',
    ],

    'pages' => [
        'index' => 'Tags',
        'create' => 'إضافة Tag',
        'edit' => 'تعديل Tag',
    ],

    'buttons' => [
        'create' =>'اضافة',
        'edit' => 'تحديث',
        'delete' => 'حذف',
    ],

    'messages' => [
        'create' => 'تم إضافة التاج بنجاح',
        'edit' => 'تم تعديل التاج بنجاح',
        'delete' => 'تم حذف التاج بنجاح',
    ],

    'extra'=> [
        'actions'=>'العمليات',
        'confirm_delete'=>'تأكيد الحذف',
        'confirm'=>'تأكيد',
        'Are you sure you want delete this item'=>'هل أنت متأكد من حذف هذا العنصر حذف نهائي؟',
        'close'=>'اغلاق',
        'yes'=>'نعم',

    ]
];