<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = [
            'name' => 'Laurence Andrew',
            'title' => 'Web Developer & IT Student',
            'avatar' => 'images/avatar.jpg',
            'email' => 'laurence@example.com',
            'phone' => '+63 912 345 6789',
            'github' => 'https://github.com/supremo-a',
            'linkedin' => 'https://linkedin.com/in/YOUR_PROFILE',
            'school' => 'Data Center College of the Philippines - Bangued',
            'program' => 'Bachelor of Science in Information Technology',
            'graduation' => 'Expected March 2027'
        ];

        $skills = ['PHP', 'Laravel', 'MySQL', 'VB.NET', 'Tailwind CSS', 'JavaScript', 'Git & GitHub'];

        $certifications = [
            ['title' => 'Civil Service Examination - Professional Eligibility', 'year' => '2025'],
            ['title' => 'Integrative Programming Course Certification', 'year' => '2026']
        ];

        return view('portfolio', compact('profile', 'skills', 'certifications'));
    }
}