<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataAccessLayer\SchoolYear\SchoolYear;
use App\Http\Requests\SchoolYearFormRequest;
use Illuminate\Support\Facades\Log;

class SchoolYearController extends Controller
{
    protected $schoolYear;

    public function __construct(SchoolYear $schoolYear)
    {
        $this->schoolYear = $schoolYear;
    }

    public function index() 
    {
        return $this->schoolYear->getAllSchoolYear();
    }

    public function create(SchoolYearFormRequest $request) 
    {
        return $this->schoolYear->createSchoolYear($request);
    }

    public function update($id, SchoolYearFormRequest $request) 
    {
        return $this->schoolYear->updateSchoolYear($id, $request);
    }

    public function delete($id) 
    {
        return $this->schoolYear->deleteSchoolYear($id);
    }

    public function setActiveSchoolYear($id) 
    {
        return $this->schoolYear->setActiveSchoolYear($id);
    }

    public function getActiveSchoolYear() 
    {
        return $this->schoolYear->getActiveSchoolYear();
    }
}
