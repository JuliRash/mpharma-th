<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiagnosisRequest;
use App\Imports\DiagnosisImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function __construct()
    {
        $this->middleware('return-json');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $diagnoses = Diagnosis::paginate(20);
        return response()->json($diagnoses, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param DiagnosisRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DiagnosisRequest $request)
    {
        $validated = $request->validated();

        $diagnosis = Diagnosis::create([
            'category_code' => $validated['category_code'],
            'category_title' => $validated['category_title'],
            'diagnosis_code' => $validated['diagnosis_code'],
            'full_code' => $validated['full_code'],
            'abbreviated_description' => $validated['abbreviated_description'],
            'full_description' => $validated['abbreviated_description'],
        ]);

        return response()->json([
            'message' => 'diagnosis added successfully',
            'data' => $diagnosis,
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        $diagnosis = Diagnosis::where('id', $id)->first();

        if (is_null($diagnosis)) {
            return response()->json(['message' => 'diagnosis with the id: ' . $id . ' not found'], 404);
        }

        return response()->json([
            'data' => $diagnosis,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $diagnosis = Diagnosis::where('id', $id)->first();

        if (is_null($diagnosis)) {
            return response()->json(['message' => 'diagnosis with the id: ' . $id . ' not found'], 404);
        }

        $diagnosis->update($request->all());

        return response()->json([
            'data' => $diagnosis,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $diagnosis = Diagnosis::where('id', $id)->first();

        if (is_null($diagnosis)) {
            return response()->json(['message' => 'diagnosis with the id: ' . $id . ' not found'], 404);
        }

        $diagnosis->delete();

        return response()->json('Deleted', 204);
    }

    public function uploadCSV(Request $request)
    {
        $validated = $request->validate([
            'csv_file' => 'required|file|mimes:csv',
            'email' => 'required|email'
        ]);

        Excel::import(new DiagnosisImport($request->email), $request->csv_file);

        return response()->json([
            'message' => 'import in progress'
        ], 200);
    }
}
