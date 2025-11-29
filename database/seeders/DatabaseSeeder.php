<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use App\Models\CurriculumSubject;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'role' => 'admin',
            'contact' => '09773942290'
        ]);

        Student::create([
            'name' => 'John Doe',
            'email' => 'student@gmail.com',
            'gender' => 'male',
            'contact' => '123456',
            'parent_contact' => '123456',
            'password' =>  Hash::make('123'),
        ]);

        // School years seeder

        DB::table('school_years')->insert([

            [
                'name' => '2024-2025',
                'start_date' => '2024-08-01',
                'end_date' => '2025-05-31',
                'description' => 'Current academic school year',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => '2023-2024',
                'start_date' => '2023-08-01',
                'end_date' => '2024-05-31',
                'description' => 'Previous academic school year',
                'active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => '2025-2026',
                'start_date' => '2025-08-01',
                'end_date' => '2026-05-31',
                'description' => 'Upcoming school year',
                'active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

        // roles seeder

        $roles = [
            ['name' => 'admin',     'description' => 'System administrator'],
            ['name' => 'registrar', 'description' => 'Handles student records'],
            ['name' => 'cashier',   'description' => 'Handles payments and fees'],
            ['name' => 'teacher',   'description' => 'Teaches subjects and manages classes'],
            ['name' => 'student',   'description' => 'Student account'],
            ['name' => 'parent',    'description' => 'Parent/guardian user'],
            ['name' => 'staff',     'description' => 'General staff user']
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']], // prevent duplicates
                $role
            );
        }

        $departments = [
            // Academic Levels (Student Related)
            ['code' => 'JHS', 'name' => 'Junior High School', 'description' => 'For Grade 7 to Grade 10 students'],
            ['code' => 'SHS', 'name' => 'Senior High School', 'description' => 'For Grade 11 and Grade 12 students'],
            ['code' => 'COL', 'name' => 'College', 'description' => 'For first year to fourth year college students'],

            // Employee / Operational Departments
            ['code' => 'FAC', 'name' => 'Faculty', 'description' => 'Teachers and instructors'],
            ['code' => 'ACC', 'name' => 'Accounting', 'description' => 'Handles financial records and audits'],
            ['code' => 'CAS', 'name' => 'Cashier', 'description' => 'Handles payments and collections'],
            ['code' => 'REG', 'name' => 'Registrar', 'description' => 'Manages student records and enrollment'],
            ['code' => 'ADM', 'name' => 'Administration', 'description' => 'School administration and executives'],
            ['code' => 'LIB', 'name' => 'Library', 'description' => 'Library operations'],
            ['code' => 'IT',  'name' => 'IT Department', 'description' => 'Information technology and support'],
            ['code' => 'GUID', 'name' => 'Guidance Office', 'description' => 'Student services and counseling'],
        ];

        DB::table('departments')->insert($departments);


        // grade levels seeder
        $levels = [
            // Junior High School
            ['name' => 'Grade 7', 'level_number' => 7, 'description' => 'Junior High', 'status' => 'active'],
            ['name' => 'Grade 8', 'level_number' => 8, 'description' => 'Junior High', 'status' => 'active'],
            ['name' => 'Grade 9', 'level_number' => 9, 'description' => 'Junior High', 'status' => 'active'],
            ['name' => 'Grade 10', 'level_number' => 10, 'description' => 'Junior High', 'status' => 'active'],

            // Senior High School
            ['name' => 'Grade 11', 'level_number' => 11, 'description' => 'Senior High', 'status' => 'active'],
            ['name' => 'Grade 12', 'level_number' => 12, 'description' => 'Senior High', 'status' => 'active'],

            // College Levels
            ['name' => '1st Year', 'level_number' => 13, 'description' => 'College Level 1', 'status' => 'active'],
            ['name' => '2nd Year', 'level_number' => 14, 'description' => 'College Level 2', 'status' => 'active'],
            ['name' => '3rd Year', 'level_number' => 15, 'description' => 'College Level 3', 'status' => 'active'],
            ['name' => '4th Year', 'level_number' => 16, 'description' => 'College Level 4', 'status' => 'active'],
        ];

        DB::table('grade_levels')->insert($levels);

        // programs seeder
        $programs = [

            // -----------------------------
            // JUNIOR HIGH SCHOOL (Grades 7–10)
            // -----------------------------
            [
                'department_id' => 3,   // junior high dept
                'grade_level_id' => null, // applies to multiple levels
                'name' => 'Junior High School Program',
                'description' => 'Grade 7–10 general curriculum',
                'code' => 'JHS',
            ],

            // -----------------------------
            // SENIOR HIGH STRANDS (Grades 11–12)
            // -----------------------------
            [
                'department_id' => 4, // senior high dept
                'grade_level_id' => null,
                'name' => 'STEM',
                'description' => 'Science, Technology, Engineering & Mathematics',
                'code' => 'STEM',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'ABM',
                'description' => 'Accountancy, Business & Management',
                'code' => 'ABM',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'HUMSS',
                'description' => 'Humanities & Social Sciences',
                'code' => 'HUMSS',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'TVL',
                'description' => 'Technical-Vocational-Livelihood Track',
                'code' => 'TVL',
            ],

            // Same strands also apply to Grade 12
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'STEM',
                'description' => 'Grade 12 STEM',
                'code' => 'STEM12',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'ABM',
                'description' => 'Grade 12 ABM',
                'code' => 'ABM12',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'HUMSS',
                'description' => 'Grade 12 HUMSS',
                'code' => 'HUMSS12',
            ],
            [
                'department_id' => 4,
                'grade_level_id' => null,
                'name' => 'TVL',
                'description' => 'Grade 12 TVL',
                'code' => 'TVL12',
            ],

            // -----------------------------
            // COLLEGE PROGRAMS
            // -----------------------------
            [
                'department_id' => 5, // college dept
                'grade_level_id' => null, // 1st year
                'name' => 'Bachelor of Science in Information Technology',
                'description' => 'BSIT Program',
                'code' => 'BSIT',
            ],
            [
                'department_id' => 5,
                'grade_level_id' => null,
                'name' => 'Bachelor of Science in Computer Science',
                'description' => 'BSCS Program',
                'code' => 'BSCS',
            ],
            [
                'department_id' => 5,
                'grade_level_id' => null,
                'name' => 'Bachelor of Science in Business Administration',
                'description' => 'BSBA Program',
                'code' => 'BSBA',
            ],
        ];

        DB::table('programs')->insert($programs);

        // curriculums seeder

        $curriculums = [
            // Junior High School Curriculum
            [
                'program_id' => DB::table('programs')->where('code', 'JHS')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'JHS')->value('id'),
                'name' => 'Junior High Curriculum',
                'description' => 'Official Junior High School curriculum for Grades 7–10',
            ],

            // Senior High Curriculums
            [
                'program_id' => DB::table('programs')->where('code', 'STEM')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'SHS')->value('id'),
                'name' => 'STEM Curriculum',
                'description' => 'Science, Technology, Engineering & Mathematics track',
            ],
            [
                'program_id' => DB::table('programs')->where('code', 'HUMSS')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'SHS')->value('id'),
                'name' => 'HUMSS Curriculum',
                'description' => 'Humanities & Social Sciences track',
            ],
            [
                'program_id' => DB::table('programs')->where('code', 'ABM')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'SHS')->value('id'),
                'name' => 'ABM Curriculum',
                'description' => 'Accounting, Business & Management track',
            ],
            [
                'program_id' => DB::table('programs')->where('code', 'TVL')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'SHS')->value('id'),
                'name' => 'TVL Curriculum',
                'description' => 'Technical-Vocational-Livelihood track',
            ],

            // College Curriculums
            [
                'program_id' => DB::table('programs')->where('code', 'BSIT')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'COLLEGE')->value('id'),
                'name' => 'BSIT Curriculum',
                'description' => 'Bachelor of Science in Information Technology',
            ],
            [
                'program_id' => DB::table('programs')->where('code', 'BSBA')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'COLLEGE')->value('id'),
                'name' => 'BSBA Curriculum',
                'description' => 'Bachelor of Science in Business Administration',
            ],
            [
                'program_id' => DB::table('programs')->where('code', 'BSED')->value('id'),
                'department_id' => DB::table('departments')->where('code', 'COLLEGE')->value('id'),
                'name' => 'BSED Curriculum',
                'description' => 'Bachelor of Secondary Education',
            ],
        ];

        DB::table('curricula')->insert($curriculums);


        // subjects seeder can be added here later

        // Helper to get IDs
        $dept = fn($code) => DB::table('departments')->where('code', $code)->value('id');
        $grade = fn($num) => DB::table('grade_levels')->where('level_number', $num)->value('id');
        $prog = fn($code) => DB::table('programs')->where('code', $code)->value('id');

        $subjects = [

            // ----------------------------------------------------
            // JUNIOR HIGH SUBJECTS (Grades 7–10)
            // ----------------------------------------------------
            [
                'department_id' => $dept('JHS'),
                'grade_level_id' => $grade(7),
                'program_id' => $prog('JHS'),
                'category' => 'core',
                'units' => 0,
                'name' => 'Mathematics 7',
                'code' => 'MATH7',
                'description' => 'Basic math skills for Grade 7',
                'status' => 'active'
            ],
            [
                'department_id' => $dept('JHS'),
                'grade_level_id' => $grade(7),
                'program_id' => $prog('JHS'),
                'category' => 'core',
                'units' => 0,
                'name' => 'English 7',
                'code' => 'ENG7',
                'description' => 'English fundamentals for Grade 7',
                'status' => 'active'
            ],
            [
                'department_id' => $dept('JHS'),
                'grade_level_id' => $grade(7),
                'program_id' => $prog('JHS'),
                'category' => 'core',
                'units' => 0,
                'name' => 'Science 7',
                'code' => 'SCI7',
                'description' => 'General science for Grade 7',
                'status' => 'active'
            ],

            // ----------------------------------------------------
            // SENIOR HIGH SUBJECTS (STEM, HUMSS, ABM, TVL)
            // ----------------------------------------------------

            // STEM Specialized
            [
                'department_id' => $dept('SHS'),
                'grade_level_id' => $grade(11),
                'program_id' => $prog('STEM'),
                'category' => 'specialized',
                'units' => 3,
                'name' => 'General Biology 1',
                'code' => 'BIO1',
                'description' => 'Specialized STEM biology',
                'status' => 'active'
            ],
            [
                'department_id' => $dept('SHS'),
                'grade_level_id' => $grade(11),
                'program_id' => $prog('STEM'),
                'category' => 'specialized',
                'units' => 3,
                'name' => 'Pre-Calculus',
                'code' => 'PRECAL',
                'description' => 'STEM track mathematics',
                'status' => 'active'
            ],

            // HUMSS Core
            [
                'department_id' => $dept('SHS'),
                'grade_level_id' => $grade(11),
                'program_id' => $prog('HUMSS'),
                'category' => 'core',
                'units' => 3,
                'name' => 'Introduction to World Religions',
                'code' => 'WR11',
                'description' => 'Religion and ethics study',
                'status' => 'active'
            ],

            // ABM Specialized
            [
                'department_id' => $dept('SHS'),
                'grade_level_id' => $grade(11),
                'program_id' => $prog('ABM'),
                'category' => 'specialized',
                'units' => 3,
                'name' => 'Business Mathematics',
                'code' => 'BUSMATH',
                'description' => 'ABM business math basics',
                'status' => 'active'
            ],

            // TVL (Example)
            [
                'department_id' => $dept('SHS'),
                'grade_level_id' => $grade(11),
                'program_id' => $prog('TVL'),
                'category' => 'specialized',
                'units' => 3,
                'name' => 'Computer System Servicing',
                'code' => 'CSS11',
                'description' => 'Technical-vocational computing',
                'status' => 'active'
            ],

            // ----------------------------------------------------
            // COLLEGE SAMPLE SUBJECTS (BSIT)
            // ----------------------------------------------------
            [
                'department_id' => $dept('COLLEGE'),
                'grade_level_id' => $grade(13), // 1st Year College
                'program_id' => $prog('BSIT'),
                'category' => 'core',
                'units' => 3,
                'name' => 'Introduction to Computing',
                'code' => 'IT101',
                'description' => 'Fundamentals of computing and IT',
                'status' => 'active'
            ],
            [
                'department_id' => $dept('COLLEGE'),
                'grade_level_id' => $grade(13),
                'program_id' => $prog('BSIT'),
                'category' => 'core',
                'units' => 3,
                'name' => 'Programming 1',
                'code' => 'IT102',
                'description' => 'Basic programming using modern languages',
                'status' => 'active'
            ],
        ];

        DB::table('subjects')->insert($subjects);

        // curriculum subjects seeder can be added here later

        // Make sure we have curriculums and subjects first
        $curriculums = Curriculum::all();
        $subjects = Subject::all();

        if ($curriculums->isEmpty() || $subjects->isEmpty()) {
            $this->command->warn('⚠️ No curriculums or subjects found. Skipping curriculum_subjects seeder.');
            return;
        }

        foreach ($curriculums as $curriculum) {
            // Assign 3–6 random subjects per curriculum
            $randomSubjects = $subjects->random(rand(3, 6));

            foreach ($randomSubjects as $subject) {
                CurriculumSubject::firstOrCreate([
                    'curriculum_id' => $curriculum->id,
                    'subject_id' => $subject->id,
                ]);
            }
        }

        // sections

        DB::table('sections')->insert([

            // Junior High Sections
            [
                'school_year_id' => 1,
                'curriculum_id' => 1,
                'program_id' => 1,
                'grade_level_id' => null,
                'adviser' => null, // user_id
                'name' => '7 - Newton',
                'capacity' => 40,
                'description' => 'Science section',
                'room' => 'Room 101',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'school_year_id' => 1,
                'curriculum_id' => 1,
                'program_id' => 1,
                'grade_level_id' => null,
                'adviser' => null,
                'name' => '8 - Einstein',
                'capacity' => 40,
                'description' => 'Advanced class',
                'room' => 'Room 102',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Senior High Sections
            [
                'school_year_id' => 1,
                'curriculum_id' => 2,
                'program_id' => 4, // e.g., ABM, STEM, HUMSS
                'grade_level_id' => null,
                'adviser' => null,
                'name' => '11 - STEM A',
                'capacity' => 45,
                'description' => 'STEM track',
                'room' => 'SHS Room 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'school_year_id' => 1,
                'curriculum_id' => 2,
                'program_id' => 4,
                'grade_level_id' => null,
                'adviser' => null,
                'name' => '12 - STEM B',
                'capacity' => 45,
                'description' => 'STEM graduating class',
                'room' => 'SHS Room 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // College Sections
            [
                'school_year_id' => 1,
                'curriculum_id' => 3,
                'program_id' => 7, // BSIT, BSED, etc.
                'grade_level_id' => null,
                'adviser' => null,
                'name' => 'BSIT 1A',
                'capacity' => 50,
                'description' => '1st-year IT students',
                'room' => 'Computer Lab 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
