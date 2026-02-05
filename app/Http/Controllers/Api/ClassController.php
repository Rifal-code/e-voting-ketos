<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Http\Resources\ClassResource;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index() {
        return response()->json([
            'success' => true,
            'data' => ClassResource::collection(SchoolClass::all())
        ]);
    }

    public function store(StoreClassRequest $request) {
        $class = SchoolClass::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil ditambahkan',
            'data' => new ClassResource($class)
        ], 201);
    }

    public function show(SchoolClass $class) {
        return response()->json([
            'success' => true,
            'data' => new ClassResource($class)
        ], 200);
    }

    public function update(UpdateClassRequest $request, SchoolClass $class) {
        $class->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil diperbarui',
            'data' => new ClassResource($class)
        ],200);
    }

    public function destroy(SchoolClass $class) {
        $class->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kelas berhasil dihapus'
        ]);
    }
}
