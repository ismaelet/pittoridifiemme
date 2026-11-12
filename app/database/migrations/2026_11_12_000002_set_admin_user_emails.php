<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const EMAILS = [
        'ismaele.t' => 'ismaele.tuffanelli@gmail.com',
        'Pittori' => 'giacomo@avvgd.it',
    ];

    public function up(): void
    {
        foreach (self::EMAILS as $username => $email) {
            DB::table('users')->where('username', $username)->update(['email' => $email]);
        }
    }

    public function down(): void
    {
        foreach (self::EMAILS as $username => $email) {
            DB::table('users')->where('username', $username)->where('email', $email)->update(['email' => '']);
        }
    }
};
