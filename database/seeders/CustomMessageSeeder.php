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
                    'message_sms' => 'email',
                    'message_email' => 'تحية طيبة يا userName!,
                    نشكر تسجيلك في الموقع',
                    'language' => 'ar',
                ],
                [
                    'code' => 'verification.message',
                    'subject'=> 'تفعيل الإيميل',
                    'message_sms' => 'email',
                    'message_email' => 'تحية طيبة يا userName!,
                    قد تم تفعيل إيميلك بنجاح',
                    'language' => 'ar',
                ],
                [
                    'code' => 'register.welcome_message',
                    'subject'=> 'نرحب بك في موقعنا',
                    'message_sms' => 'email',
                    'message_email' => 'تحية طيبة يا userName!,
                    نحن فريق الموقع نرحب بك كعضو جديد في مجتمعنا. نود أن نشكرك على اختيارك للانضمام إلى موقعنا، ونتمنى أن تكون تجربتك معنا ممتعة ومثمرة.
                    يسعدنا أن نقدم لك العديد من الفرص للعمل وكسب العمولات، إضافة إلى توسيع شبكة علاقاتك المهنية. يمكنك الآن عرض خدماتك ومواهبك على آلاف العملاء المحتملين في جميع أنحاء العالم، وتحقيق أرباح تناسب جهودك ومهاراتك.
                    نحن نحرص على توفير بيئة آمنة ومريحة لجميع أعضائنا، ونسعى دائماً لتحسين تجربة المستخدم لدينا. إذا كان لديك أي أسئلة أو استفسارات، فلا تتردد في الاتصال بفريق الدعم الخاص بنا. سيكون فريق الدعم متاحاً دائماً لمساعدتك في أي شيء تحتاجه.
                    نتمنى لك التوفيق في مشاريعك القادمة، ونتطلع إلى رؤيتك تنضم لعائلتنا المتنامية من الفريلانسرز في جميع أنحاء العالم.',
                    'language' => 'ar',
                ],
                [
                    'code' => 'password.reset_message',
                    'subject'=> 'تنبيه استعادة كلمة المرور',
                    'message_sms' => 'email',
                    'message_email' => 'تحية طيبة يا userName!,
                    نرسل لك هذا الإيميل لأننا تلقينا طلب منك بتعيين كلمة المرور خاصتك
                    مع أطيب التحيات،
                    فريق الموقع.',
                    'language' => 'ar',
                ],
                [
                    'code' => 'password.change_message',
                    'subject'=> 'تغيير كلمة المرور',
                    'message_sms' => 'email',
                    'message_email' => 'تحية طيبة يا userName!,
                    قد تم تغيير كلمة المرور الخاصة بك
                    مع أطيب التحيات،
                    فريق الموقع.',
                    'language' => 'ar',
                ],
                [
                    'code' => 'ticket.create',
                    'subject'=> 'إنشاء تذكرة جديدة رقم #id',
                    'message_sms' => 'email',
                    'message_email' => 'مرحبا يا userName!, قمت بإنشاء تذكرة، يرجى الانتظار إلى حين قيام المسئول بالرد عليها',
                    'language' => 'ar',
                ],
                [
                    'code' => 'ticket.reply',
                    'subject'=> 'رد على التذكرة رقم #id',
                    'message_sms' => 'email',
                    'message_email' => 'مرحبا يا userName!, قام replier بالرد على التذكرة التي قمت بإنشائها',
                    'language' => 'ar',
                ],
            ];

            foreach ($messages as $message) {
                CustomMessage::create([
                    'code' => $message['code'],
                    'subject' => $message['subject'],
                    'message_sms' => $message['message_sms'],
                    'message_email' => $message['message_email'],
                    'language' => $message['language'],
                ]);
            }

            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
