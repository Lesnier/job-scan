<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Company;
use App\Models\Posting;
use App\Models\Skill;
use League\Csv\Reader;
use Storage;
use Illuminate\Support\Str;

class PopulateJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate Companies, Postings and Skills in the Database from CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $csvData = Storage::get('job_imports.csv');

        $sourceRecords = Reader::createFromString($csvData)->setHeaderOffset(0);

        foreach ($sourceRecords as $sourcePosting) {
            dump($sourcePosting);
            $companySlug = Str::slug($sourcePosting['job_posting_company']);
            $company = Company::firstOrCreate(['slug' => $companySlug], ['name' => $sourcePosting['job_posting_company']]);
            dump($company);

            $posting = Posting::firstOrCreate(['id' => $sourcePosting['job_posting_id']], ['title' => $sourcePosting['job_posting_title']]);
            $posting->title = $sourcePosting['job_posting_title'];
            $posting->company_id = $company->id;

            $posting->save();

            $sourceSkills = preg_split("@\s*,\s*@", $sourcePosting['skills']);
            foreach ($sourceSkills as $skillName) {
                $skill = Skill::firstOrCreate(['name' => $skillName]);
                $posting->skills()->save($skill);
            }

            dump($posting);
            dump($posting->skills);
        }
    }
}
