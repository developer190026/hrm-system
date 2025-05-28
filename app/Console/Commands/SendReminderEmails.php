<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    protected $signature = 'emails:send-reminders';
    protected $description = 'Send reminder emails to active users';

    public function handle()
    {
        // $users = User::where('active', 1)->get();
        // foreach ($users as $user) {
        //     Mail::raw('This is your reminder!', function ($message) use ($user) {
        //         $message->to('developer190026@gmail.com')
        //         ->subject('Reminder Email');
        //     });
        // }
Mail::raw('Hi test, just reminding you about your task due today.', function ($message) {
    $message->to('developer190026@gmail.com')
            ->subject('Custom Reminder');
});
        $this->info('Reminder emails sent successfully!');
    }
}
