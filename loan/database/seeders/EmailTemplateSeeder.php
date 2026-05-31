<?php

namespace Database\Seeders;

use App\Services\EmailTemplateService;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        app(EmailTemplateService::class)->syncDefaults();
    }
}
