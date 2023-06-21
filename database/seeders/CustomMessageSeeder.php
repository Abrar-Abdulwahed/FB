<?php

namespace Database\Seeders;

use App\Models\CustomMessage;
use App\Models\Seeder as ModelsSeeder;
use Illuminate\Database\Seeder;

class CustomMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run($name = 'عميلنا'): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            CustomMessage::create([
                'code' => 'register.welcome_message',
                'type' => 'email',
                'language' => 'ar',
                'text' => sprintf('
            تحية طيبة يا %s!,
            نحن فريق الموقع نرحب بك كعضو جديد في مجتمعنا. نود أن نشكرك على اختيارك للانضمام إلى موقعنا، ونتمنى أن تكون تجربتك معنا ممتعة ومثمرة.
            يسعدنا أن نقدم لك العديد من الفرص للعمل وكسب العمولات، إضافة إلى توسيع شبكة علاقاتك المهنية. يمكنك الآن عرض خدماتك ومواهبك على آلاف العملاء المحتملين في جميع أنحاء العالم، وتحقيق أرباح تناسب جهودك ومهاراتك.
            نحن نحرص على توفير بيئة آمنة ومريحة لجميع أعضائنا، ونسعى دائماً لتحسين تجربة المستخدم لدينا. إذا كان لديك أي أسئلة أو استفسارات، فلا تتردد في الاتصال بفريق الدعم الخاص بنا. سيكون فريق الدعم متاحاً دائماً لمساعدتك في أي شيء تحتاجه.
            نتمنى لك التوفيق في مشاريعك القادمة، ونتطلع إلى رؤيتك تنضم لعائلتنا المتنامية من الفريلانسرز في جميع أنحاء العالم.

            مع أطيب التحيات،
            فريق الموقع.', $name),
            ]);

            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
