<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return CompanyResource::collection(Company::latest()->get());
    }

        /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request): CompanyResource
    {
        $company = Company::create($request->validated());

        return new CompanyResource($company);
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company): CompanyResource
    {
        $company->update($request->validated());

        return new CompanyResource($company);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company): \Illuminate\Http\Response
    {
        $company->delete();

        return response()->noContent();
    }
}
