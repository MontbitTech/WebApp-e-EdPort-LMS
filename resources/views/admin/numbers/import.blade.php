@extends('layouts.admin.app')
@section('content')  
 <section class="main-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-common mb-3">
          <div class="card-header">
            <span class="topic-heading">Import Student Details</span>
			 <div class="float-right">
              <a type="button" class="btn btn-sm btn-success" href="{{route('admin.sampleStudentsDownload')}}">
                <svg class="icon icon-font16 icon-mmtop-3 mr-1"><use xlink:href="{{asset('images/icons.svg#icon_adduser')}}"></use></svg> Download Sample File
              </a>
            </div>
          </div>
          <div class="card-body pt-4">
              {!! Form::open(array('route' => ['admin.studentsimport'],'method'=>'POST','autocomplete'=>'off','enctype'=>'multipart/form-data')) !!}
              
               <div class="form-group row">
                  <label for="colFormLabel" class="col-md-4 col-form-label">Browse file:</label>
                  <div class="col-md-5">
                    {!! Form::file('file', null, array('placeholder' => 'Browse .csv file','class' => 'form-control')) !!}
                </div>
              </div>
                <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary btn-w140">Submit</button>
                    <a href="{{route('list.students')}}" class="btn btn-danger">Back</a>
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