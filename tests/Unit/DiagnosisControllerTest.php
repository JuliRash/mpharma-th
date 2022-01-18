<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Models\Diagnosis;


class DiagnosisControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testIndexReturnsDataInValidFormat()
    {
        $this->json('get', 'api/diagnosis')
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'current_page',
                    'data' => [
                        '*' => [
                            'id',
                            'category_code',
                            'category_title',
                            'diagnosis_code',
                            'full_code',
                            'abbreviated_description',
                            'full_description',
                            'created_at',
                            'updated_at',
                        ]
                    ],
                    'first_page_url',
                    'from',
                    'last_page',
                    'links' => [
                        '*' => [
                            'url',
                            'label',
                            'active'
                        ]
                    ],
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                    'total',
                ]
            );
    }

    public function testShowReturnsDataInValidFormat()
    {
        $diagnosis = Diagnosis::create([
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ]);

        $this->json('get', 'api/diagnosis/' . $diagnosis->id)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'category_code',
                        'category_title',
                        'diagnosis_code',
                        'full_code',
                        'abbreviated_description',
                        'full_description',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
    }

    public function testUpdateDiagnosisWithCodeReturnsValidFormat()
    {
        $diagnosis = Diagnosis::create([
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ]);

        $payload = [
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ];
        $this->json('patch', 'api/diagnosis/' . $diagnosis->id, $payload)
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure(
                [

                    'data' => [
                        'id',
                        'category_code',
                        'category_title',
                        'diagnosis_code',
                        'full_code',
                        'abbreviated_description',
                        'full_description',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
    }

    public function testDiagnosisWithCodeIsDestroyed()
    {
        $diagnosisData = [
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ];

        $diagnosis = Diagnosis::create($diagnosisData);


        $this->json('delete', 'api/diagnosis/' . $diagnosis->id)
            ->assertStatus(Response::HTTP_NO_CONTENT)
            ->assertNoContent();

        $this->assertDatabaseMissing('diagnoses', $diagnosisData);
    }

    public function testDiagnosisIsCreatedSuccessfully()
    {
        $payload = [
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ];
        $this->json('post', 'api/diagnosis', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'message',
                    'data' => [
                        'id',
                        'category_code',
                        'category_title',
                        'diagnosis_code',
                        'full_code',
                        'abbreviated_description',
                        'full_description',
                        'created_at',
                        'updated_at'
                    ]
                ]
            );
    }

    public function testStoreDiagnosisWithMissingData()
    {

        $payload = [
            'category_title' => $this->faker->firstName,
            'full_description'  => $this->faker->sentence
            //'abbreviated_description', is missing
        ];
        $this->json('post', 'api/diagnosis', $payload)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonStructure(['errors']);
    }

    public function testDestroyForMissingDiagnosis()
    {

        $this->json('delete', 'api/diagnosis/0')
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message']);
    }

    public function testUpdateForMissingDiagnosis()
    {

        $payload = [
            "category_code" => Str::random(5),
            "category_title" => $this->faker->sentence,
            "diagnosis_code" => Str::random(5),
            "full_code" => uniqid(6),
            "abbreviated_description" => $this->faker->sentence,
            "full_description" => $this->faker->paragraph,
        ];

        $this->json('patch', 'api/diagnosis/0', $payload)
            ->assertStatus(Response::HTTP_NOT_FOUND)
            ->assertJsonStructure(['message']);
    }
}
