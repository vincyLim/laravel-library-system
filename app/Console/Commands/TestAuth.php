<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TestAuth extends Command
{
    protected $signature = 'test:auth';
    protected $description = 'Test authentication with seeded users';

    public function handle()
    {
        $this->info('Testing authentication...');
        
        // Check if users exist
        $admin = User::where('email', 'admin@email.com')->first();
        $librarian = User::where('email', 'librarian@email.com')->first();
        $student = User::where('email', 'student@email.com')->first();
        
        if (!$admin || !$librarian || !$student) {
            $this->error('Users not found! Run php artisan db:seed --class=UserSeeder first.');
            return;
        }
        
        $this->info('Users found:');
        $this->info("Admin: {$admin->email} (Role ID: {$admin->role_id})");
        $this->info("Librarian: {$librarian->email} (Role ID: {$librarian->role_id})");
        $this->info("Student: {$student->email} (Role ID: {$student->role_id})");
        
        // Test password verification
        $this->info("\nTesting password verification:");
        
        $adminPasswordCheck = Hash::check('password', $admin->password);
        $librarianPasswordCheck = Hash::check('password', $librarian->password);
        $studentPasswordCheck = Hash::check('password', $student->password);
        
        $this->info("Admin password check: " . ($adminPasswordCheck ? 'PASS' : 'FAIL'));
        $this->info("Librarian password check: " . ($librarianPasswordCheck ? 'PASS' : 'FAIL'));
        $this->info("Student password check: " . ($studentPasswordCheck ? 'PASS' : 'FAIL'));
        
        // Test Auth::attempt
        $this->info("\nTesting Auth::attempt:");
        
        $adminAuth = Auth::attempt(['email' => 'admin@email.com', 'password' => 'password']);
        $this->info("Admin auth attempt: " . ($adminAuth ? 'PASS' : 'FAIL'));
        
        if ($adminAuth) {
            Auth::logout();
        }
        
        $librarianAuth = Auth::attempt(['email' => 'librarian@email.com', 'password' => 'password']);
        $this->info("Librarian auth attempt: " . ($librarianAuth ? 'PASS' : 'FAIL'));
        
        if ($librarianAuth) {
            Auth::logout();
        }
        
        $studentAuth = Auth::attempt(['email' => 'student@email.com', 'password' => 'password']);
        $this->info("Student auth attempt: " . ($studentAuth ? 'PASS' : 'FAIL'));
        
        if ($studentAuth) {
            Auth::logout();
        }
    }
}