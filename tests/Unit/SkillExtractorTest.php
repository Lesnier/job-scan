<?php

namespace Tests\Unit;

use App\Helpers\SkillHelper;
use Tests\TestCase;

class SkillExtractorTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testLaravelDescriptionSkillFinder()
    {
        $description = 'Seeking Laravel/PHP developers who are familiar and seriously interested in the
            advertising technology space. AcquireCrowd is an advertising company focused on building
            relationships with top advertisers in the digital marketplace.

            We have 5+ years of exponential growth, have marquee clients in resilient areas of the economy,
            and are looking to build further on our success with our next wave of growth.

            Requirements

            You identify as a self-starter and independent developer. We encourage self-taught and
            self-motivated individuals and reward them as such.
            You make systems talk together like second nature. Understanding API integrations is a
            big part of this role.
            You love learning and are not afraid of change, and so you have the skills to navigate
            these circumstances.
            You should have experience building applications, full-stack, in Laravel.
            ...Then deploying aforementioned applications via GCP or AWS.
            Even though we like to deploy fast, we like to keep our foundation strong with our git flow.
            Be flexible with fast solutions by scripting languages, whether that be python/node/php.


            You must identify with the below:

            You communicate extraordinarily well.
            You convey your ideas by flowcharts, paragraphs, or slideshows.';
        $skills = SkillHelper::extractFromDescription($description);

        $this->assertArrayHasKey('GCP', $skills);
        $this->assertArrayHasKey('AWS', $skills);
        $this->assertArrayHasKey('Laravel', $skills);
        $this->assertArrayHasKey('PHP', $skills);
    }

    public function testCSharpDescriptionSkillFinder()
    {
        $description = "We are looking for a strong C# developer to join our team! As a # Developer,
            you will have a strong understanding of the C# programming language and experience working
            with client-server desktop and web applications.

            In addition, you will also be responsible for the analysis, design, development, testing
            and implementation of company's platform technology.

            C# Developer duties and responsibilities
            Design, development and testing of new features in the applications
            Responsible for regular communication with others involved in the development process
            Implement, test, and bug-fix functionality
            Responsibility for design and implementation of software projects using C#
            Participate as a team member in fully agile Scrum deliveries
            Provide support to end users
            Design, build, and maintain efficient and reliable C# code

            C# Developer requirements
            4+ years of software development experience
            Proficient in C#.Net
            Experience with HTML, JavaScript and web development frameworks (AngularJS, Bootstrap, jQuery)
            Proven experience with software design and OOD methodologies
            Familiarity with Relational Databases and SQL
            Experience with ORM frameworks
            BS degree in Computer Science or Engineering
            Experience with Web services development (SOAP, REST)
            Strong in Object Oriented Programming, MVC, Design patterns and SOLID principles";

        $skills = SkillHelper::extractFromDescription($description);

        echo printf($skills,4);
        $this->assertArrayHasKey('C#', $skills);
        $this->assertArrayHasKey('Javascript', $skills);
        $this->assertArrayHasKey('REST', $skills);
        $this->assertArrayHasKey('HTML', $skills);
        $this->assertArrayHasKey('jQuery', $skills);
        $this->assertArrayHasKey('C++', $skills);
        $this->assertArrayNotHasKey('AWS', $skills);
        $this->assertArrayNotHasKey('React', $skills);
        $this->assertArrayNotHasKey('Linux', $skills);
        $this->assertArrayNotHasKey('GraphQL', $skills);
        $this->assertArrayNotHasKey('Java', $skills);
    }
}
