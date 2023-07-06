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
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {
            $messages = [
                [
                    'code' => 'register.message',
                    'subject'=> 'إنشاء حساب في موقعنا',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    تحية طيبة يا userName!,
                    نشكر تسجيلك في الموقع
                    مع أطيب التحيات،
                    فريق الموقع.',
                ],
                [
                    'code' => 'verification.message',
                    'subject'=> 'تفعيل الإيميل',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    تحية طيبة يا userName!,
                    قد تم تفعيل إيميلك بنجاح
                    مع أطيب التحيات،
                    فريق الموقع.',
                ],
                [
                    'code' => 'register.welcome_message',
                    'subject'=> 'نرحب بك في موقعنا',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    تحية طيبة يا userName!,
                    نحن فريق الموقع نرحب بك كعضو جديد في مجتمعنا. نود أن نشكرك على اختيارك للانضمام إلى موقعنا، ونتمنى أن تكون تجربتك معنا ممتعة ومثمرة.
                    يسعدنا أن نقدم لك العديد من الفرص للعمل وكسب العمولات، إضافة إلى توسيع شبكة علاقاتك المهنية. يمكنك الآن عرض خدماتك ومواهبك على آلاف العملاء المحتملين في جميع أنحاء العالم، وتحقيق أرباح تناسب جهودك ومهاراتك.
                    نحن نحرص على توفير بيئة آمنة ومريحة لجميع أعضائنا، ونسعى دائماً لتحسين تجربة المستخدم لدينا. إذا كان لديك أي أسئلة أو استفسارات، فلا تتردد في الاتصال بفريق الدعم الخاص بنا. سيكون فريق الدعم متاحاً دائماً لمساعدتك في أي شيء تحتاجه.
                    نتمنى لك التوفيق في مشاريعك القادمة، ونتطلع إلى رؤيتك تنضم لعائلتنا المتنامية من الفريلانسرز في جميع أنحاء العالم.

                    مع أطيب التحيات،
                        فريق الموقع.',
                ],
                [
                    'code' => 'password.reset_message',
                    'subject'=> 'تنبيه استعادة كلمة المرور',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    تحية طيبة يا userName!,
                    نرسل لك هذا الإيميل لأننا تلقينا طلب منك بتعيين كلمة المرور خاصتك
                    مع أطيب التحيات،
                    فريق الموقع.',
                ],
                [
                    'code' => 'password.change_message',
                    'subject'=> 'تغيير كلمة المرور',
                    'type' => 'email',
                    'language' => 'ar',
                    'text' => '
                    تحية طيبة يا userName!,
                    قد تم تغيير كلمة المرور الخاصة بك
                    مع أطيب التحيات،
                    فريق الموقع.',
                ],
            ];

            foreach ($messages as $message) {
                CustomMessage::create([
                    'code' => $message['code'],
                    'subject' => $message['subject'],
                    'type' => $message['type'],
                    'language' => $message['language'],
                    'text' => $message['text'],
                ]);
            }

            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
