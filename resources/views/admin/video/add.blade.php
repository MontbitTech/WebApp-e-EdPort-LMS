@extends('layouts.admin.app')
@section('content')


<section class="main-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card  mt-5">
                    <div class="card-header ">
                        {{isset($videos)?'Edit':'Add'}} Video
                    </div>
                    <div class="card-body">
                        <form action="{{isset($videos)?route('video.update',encrypt($videos->id)):route('video.store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Title"> Title</label>
                                <input type="text" name="title" class="form-control " id="Title" placeholder=" {{isset($videos)?'Update Video':'Enter Title'}}" value="{{isset($videos)?$videos->title:''}}" required>
                            </div>
                            <div class="form-group">
                                <label for="Links"> Link</label>
                                <input type="text" name="link" class="form-control " id="Links" placeholder=" {{isset($videos)?'Update Video':'Enter Links'}}" value="{{isset($videos)?$videos->link:''}}" required>
                            </div>
                            <button type="submit" class="btn submit-btn">Submit</button>
                            <a href="{{route('video')}}" class="btn btn-back ml-1"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection