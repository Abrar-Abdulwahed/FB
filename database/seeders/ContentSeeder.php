<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Seeder as ModelsSeeder;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seeder = ModelsSeeder::where('class_name', __CLASS__)->count();

        if ($seeder == 0) {

            $tag_1 = Tag::query()->create([
                'name' => 'tag-1-تجربة',
                'slug' => 'tag-1-test',
            ]);
            $tag_2 = Tag::query()->create([
                'name' => 'tag-2-تجربة',
                'slug' => 'tag-2-test',
            ]);

            $category_1 = ArticleCategory::query()->create([
                'title' => 'category-1-تجربة',
                'slug' => 'category-1-test',
            ]);
            $category_2 = ArticleCategory::query()->create([
                'title' => 'category-2-تجربة',
                'slug' => 'category-2-test',
            ]);

            $article_1 = Article::query()->create([
                'title' => 'مرحبا بك ',
                'slug' => 'article-1-test',
                'content' => 'anything',
                'user_id' => 1,
            ]);
            $article_2 = Article::query()->create([
                'title' => 'تجربة مقال ثاني',
                'slug' => 'article-2-test',
                'content' => 'anything',
                'user_id' => 1,
            ]);

            $article_1->tags()->sync([$tag_1->id, $tag_2->id]);
            $article_1->categories()->sync([$category_1->id, $category_2->id]);

            $article_2->tags()->sync([$tag_1->id, $tag_2->id]);
            $article_2->categories()->sync([$category_1->id, $category_2->id]);

            $page_titles = ['عن الموقع', 'سياسة الخصوصية', 'الاتصال بنا'];

            foreach ($page_titles as $key => $title) {
                Page::query()->create([
                    'title' => $title,
                    'slug' => 'page-' . $key + 1 . '-test',
                    'content' => 'anything',
                ]);
            }

            Faq::query()->create([
                'title' => 'anything',
                'answer' => 'anything',
            ]);

            ModelsSeeder::create(array('class_name' => __CLASS__));
        }
    }
}
