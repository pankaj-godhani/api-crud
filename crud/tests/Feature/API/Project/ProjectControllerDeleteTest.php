<?php
declare(strict_types=1);

namespace Tests\Feature\API\Project;

use App\Http\HttpCode;
use App\Models\Project;
use Tests\Feature\Mobile\MobileTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProjectControllerDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_Given_NonExistentProject_When_DeleteProject_Then_NotFoundErrorReturned(): void
    {
        $response = $this->deleteJson($this->getEndpointUrl(100));
        $response->assertStatus(HttpCode::HTTP_NOT_FOUND);
        $response->assertJsonStructure(['message']);
    }

    public function test_Given_ExistingProject_When_DeleteProject_Then_ProjectDeleted(): void
    {
        $project = Project::factory()->create(['name' => 'Fatih Moschee - Krefeld']);
        $response = $this->deleteJson($this->getEndpointUrl($project->id));
        $response->assertStatus(HttpCode::HTTP_OK);
        $project = Project::find($project->id);
        $this->assertNull($project);
    }


    protected function getEndpointUrl(int $projectId = null): string
    {
        if (is_null($projectId)) {
            $project = Project::factory()->create();
            $projectId = $project->id;
        }
        return $this->getBaseUrl() . '/projects/' .$projectId;
    }
}
