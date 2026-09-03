<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = [
            'name' => 'Laurence Andrew B. Perlas',
            'title' => 'Web Developer & IT Student',
            'avatar' => 'images/avatar.jpg',
            'email' => 'xlaurence02@example.com',
            'phone' => '+63 962 251 8929',
            'github' => 'https://github.com/supremo-a/andrewlbp',
        ];

        $education = [
            [
                'level' => 'College',
                'school' => 'Data Center College of the Philippines - Bangued',
                'program' => 'Bachelor of Science in Information Technology',
                'year' => 'Expected graduation - 2027'
            ],
            [
                'level' => 'Senior High School',
                'school' => 'University of Abra - Bangued',
                'program' => 'TVL - Technical-Vocational-Livelihood',
                'year' => 'Graduated 2023'
            ],
            [
                'level' => 'Elementary',
                'school' => 'Tayum Central School',
                'program' => 'Elementary Education',
                'year' => 'Graduated 2017'
            ]
        ];

        $skills = ['PHP', 'Laravel', 'MySQL', 'VB.NET', 'Tailwind CSS', 'Git & GitHub'];

        $certifications = [
            [
                'title' => 'Online Safety Through Netiquette - DICT Region II Webinar',
                'year' => 'July 23, 2026'
            ]
        ];

        return view('portfolio', compact('profile', 'education', 'skills', 'certifications'));
    }
}