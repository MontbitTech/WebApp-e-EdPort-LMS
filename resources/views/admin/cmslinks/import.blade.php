@extends('layouts.admin.app')
@section('content')
<section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 mt-5">
        <div class="card card-common mb-3 mt-5">
          <div class="card-header">
            <span class="topic-heading">Import Content</span>
            <div class="float-right">
              <a type="button" class="btn btn-sm btn-color" href="{{route('cms.sampleCMSLinksDownload')}}">
                <i class="fa fa-download mr-1 icon-4x" aria-hidden="true"></i>
                Download Sample File
              </a>
            </div>
          </div>
          <div class="card-body pt-4">
            {!! Form::open(array('route' => ['cms.cmslinksimport'],'method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data')) !!}

            <div class="form-group row">
              <label for="colFormLabel" class="col-md-4 col-form-label">Browse file:</label>
              <div class="col-md-5">
                {!! Form::file('file', null, array('placeholder' => 'Browse .csv file','class' => 'form-control')) !!}
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn submit-btn btn-w140">Submit</button>
                <a href="{{route('cms.listtopics')}}" class="btn btn-back ml-3"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
              </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection