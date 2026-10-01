<?php

use App\Models\Setting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Setting::set('whatsapp_number', '');
    }

    public function down(): void
    {
        Setting::where('key', 'whatsapp_number')->delete();
    }
};