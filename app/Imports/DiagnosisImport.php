<?php

namespace App\Imports;

use App\Mail\ImportCompleted;
use App\Models\Diagnosis;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterImport;
use Illuminate\Support\Facades\Mail;




class DiagnosisImport implements ToModel, WithChunkReading, ShouldQueue, WithEvents
{
    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function model(array $row)
    {
        return new Diagnosis([
            'category_code' => $row[0],
            'category_title' => $row[5],
            'diagnosis_code' => $row[1],
            'full_code' => $row[2],
            'abbreviated_description' => $row[3],
            'full_description' => $row[4],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function registerEvents(): array
    {
        return [

            AfterImport::class => function (AfterImport $event) {
                Mail::to($this->email)->send(new ImportCompleted);
            }
        ];
    }
}
