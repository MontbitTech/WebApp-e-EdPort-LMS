@extends('layouts.admin.app')

@section('content')
<!-- Admin-setting-sechool-main  -->
<section class="main-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6  mt-5">


                <div class="card  mt-5">
                    <div class="card-header ">
                        {{isset($category)?'Edit':'Add'}} Category
                    </div>
                    <div class="card-body">
                        <form action="{{isset($category)?route('admin.help-category-update',encrypt($category->id)):route('admin.help-category-store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Category">
                                    Category</label>
                                <input type="text" name="category" class="form-control " id="Category" placeholder=" {{isset($category)?'Update Category':'Enter Category'}}" value="{{isset($category)?$category->category:''}}">

                            </div>
                            <button type="submit" class="btn submit-btn">

                                Submit
                            </button>
                            <a href="{{route('admin.help-category')}}" class="btn btn-back ml-1"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
</section>







@endsection