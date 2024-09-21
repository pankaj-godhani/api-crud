<?php
declare(strict_types=1);

namespace Tests\Feature\API\Project;

use App\Http\HttpCode;
use App\Models\Organizer;
use App\Models\Project;
use App\Models\Tag;
use Tests\Feature\Mobile\MobileTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class ProjectControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_Given_NoDataProvided_When_CreateProject_Then_ValidationErrorReturned(): void
    {
        $requestData = [];
        $response = $this->postJson($this->getEndpointUrl(), $requestData);
        $response->assertStatus(HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'The tag id field is required. (and 6 more errors)',
            'errors'=> [
                'tag_id' => ['The tag id field is required.'],
                'organizer_id' => ['The organizer id field is required.'],
                'name' => ['The name field is required.'],
                'description' => ['The description field is required.'],
                'amount' => ['The amount field is required.'],
                'collected_fund' => ['The collected fund field is required.'],
                'files' => ['The files field is required.']
            ]
        ]);
    }

    public function test_Given_NonExistentProject_When_CreateProjectWithInvalidTagId_Then_ValidationErrorReturned(): void
    {
        $requestData = $this->getRequestData();
        $requestData['tag_id'] = 100;
        $response = $this->postJson($this->getEndpointUrl(), $requestData);
        $response->assertStatus(HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'The selected tag id is invalid.',
            'errors'=> [
                'tag_id' => [
                    'The selected tag id is invalid.'
                ]
            ]
        ]);
    }

    public function test_Given_NonExistentProject_When_CreateProjectWithInvalidOrganizerId_Then_ValidationErrorReturned(): void
    {
        $requestData = $this->getRequestData();
        $requestData['organizer_id'] = 100;
        $response = $this->postJson($this->getEndpointUrl(), $requestData);
        $response->assertStatus(HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'The selected organizer id is invalid.',
            'errors'=> [
                'organizer_id' => [
                    'The selected organizer id is invalid.'
                ]
            ]
        ]);
    }

    public function test_Given_NonExistentProject_When_CreateProjectWithInvalidFilesFormat_Then_ValidationErrorReturned(): void
    {
        $requestData = $this->getRequestData();
        $requestData['files'][0] =  UploadedFile::fake()->create('document.txt', 100);
        $response = $this->postJson($this->getEndpointUrl(), $requestData);
        $response->assertStatus(HttpCode::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertExactJson([
            'message' => 'The files.0 field must be a file of type: jpg, png, jpeg, svg, pdf, mp4, mov.',
            'errors'=> [
                'files' => [
                    [
                        'The files.0 field must be a file of type: jpg, png, jpeg, svg, pdf, mp4, mov.'
                    ]
                ]
            ]
        ]);
    }

    public function test_Given_NonExistentProject_When_CreateProject_Then_ProjectCreated(): void
    {
        $requestData = $this->getRequestData();
        $project = Project::firstWhere(['name' => $requestData['name']]);
        $this->assertNull($project);

        $response = $this->postJson($this->getEndpointUrl(), $requestData);
        $response->assertStatus(HttpCode::HTTP_CREATED);

        $project = Project::firstWhere(['name' => $requestData['name']]);
        $this->assertNotNull($project);
    }

    protected function getEndpointUrl(): string
    {
        return $this->getBaseUrl() . '/projects';
    }

    protected function getRequestData(): array
    {
        Tag::create(['name'=>'Building']);
        Organizer::factory()->create();

        return [
            'tag_id' => Tag::first()->id,
            'organizer_id' => Organizer::first()->id,
            'name' => 'Fatih Moschee - Krefeld',
            'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took ',
            'amount' =>  20.00,
            'collected_fund' => 400.90,
            'files' => [
                UploadedFile::fake()->create('document.pdf', 100)
            ]
        ];
    }
}
