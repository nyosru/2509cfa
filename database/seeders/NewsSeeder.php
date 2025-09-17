<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $news = [
            [
                'title' => 'Новые методы финансового анализа в 2024 году',
                'content' => 'В 2024 году ожидается внедрение новых методик финансового анализа, основанных на искусственном интеллекте и машинном обучении. Эти технологии позволят более точно прогнозировать рыночные тенденции и оценивать риски.',
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Изменения в налоговом законодательстве',
                'content' => 'С января 2024 года вступают в силу изменения в налоговом кодексе, которые затрагивают малый и средний бизнес. Важно заранее подготовиться к этим изменениям и пересмотреть финансовые стратегии.',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            // Добавьте больше новостей по аналогии
        ];

        foreach ($news as $newsData) {
            News::create($newsData);
        }
    }
}
