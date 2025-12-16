<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class SendTestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirim test email ke alamat yang ditentukan';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $this->info("Mengirim test email ke: {$email}");

        try {
            Mail::to($email)->send(new TestMail());

            $this->info("✓ Email berhasil dikirim ke {$email}");
            $this->info("Silakan cek inbox atau folder spam Anda.");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("✗ Gagal mengirim email: " . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
