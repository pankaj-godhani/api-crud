<?php
declare(strict_types=1);

namespace Tests\Feature\API\Project;

use App\Http\HttpCode;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Tests\Feature\Mobile\MobileTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_Given_ExistingProject_When_GetProjects_Then_CorrectDataAndStructureReturned(): void
    {
        $projects = Project::factory()->count(2)->create();
        $response = $this->getJson($this->getEndpointUrl());
        $response->assertStatus(HttpCode::HTTP_OK);
        $response->assertJsonStructure($this->getProjectStructureData());
        $this->assertEquals(
            ProjectResource::collection($projects)->response()->getData(true),
            $response->json());
    }

    public function test_Given_NonExistingProject_When_GetProjects_Then_EmptyDataAndStructureReturned(): void
    {
        $response = $this->getJson($this->getEndpointUrl());
        $response->assertStatus(HttpCode::HTTP_OK);
        $response->assertJson([
            'data' => [],
        ]);
    }

    protected function getEndpointUrl(): string
    {
        return $this->getBaseUrl() . '/projects';
    }

    protected function getProjectStructureData(): array
    {
        return [
            'data' => [
                [
                    "id",
                    "tag" => [
                        "id",
                        "name"
                    ],
                    "organizer" => [
                        "id",
                        "name",
                        "profile_url",
                        "position"
                    ],
                    "donations" => [],
                    "updates" => [],
                    "name",
                    "description",
                    "amount",
                    "collected_fund",
                    "files" => []
                ]
            ]

        ];
    }
}
