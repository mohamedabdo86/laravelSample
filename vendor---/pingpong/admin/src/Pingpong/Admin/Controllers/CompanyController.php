<?php

namespace Pingpong\Admin\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;



class CompanyController  extends BaseController
{
    protected $company;

    /**
     * @var ImageUploader
     */
    protected $uploader;

    /**
     * @param ImageUploader $uploader
     */
    public function index()
    {
        return $this->view('company.index');

    }

}
