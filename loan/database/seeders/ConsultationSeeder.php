<?php

namespace Database\Seeders;

use App\Models\ConsultationSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // database/seeders/ConsultationSeeder.php
    public function run()
    {
        ConsultationSection::updateOrCreate([], [
            'heading' => 'Schedule Your Consultation',
            'description' => 'Get personalized financial advice...',
            'info_heading' => 'Why Schedule a Consultation?',
            'benefits' => [
                ['icon' => 'fa-chart-line', 'title' => 'Personalized Funding Strategy', 'description' => 'Get a customized plan...'],
                ['icon' => 'fa-clock', 'title' => 'Save Time & Resources', 'description' => 'Our experts will help...'],
                ['icon' => 'fa-hand-holding-usd', 'title' => 'Better Loan Terms', 'description' => 'Access exclusive loan options...'],
            ],
            'expect_heading' => 'What to Expect',
            'expectations' => [
                ['text' => '30-minute initial consultation'],
                ['text' => 'No obligation or hidden fees'],
                ['text' => 'Personalized funding assessment'],
                ['text' => 'Clear next steps for your business'],
            ],
            'contact_heading' => 'Can\'t find a suitable time?',
            'contact_description' => 'Contact us directly and we\'ll arrange a consultation at your convenience.',
            'phone' => '+260 965508033',
            'email' => 'binesschama1127@gmail.com',
        ]);
    }
}
