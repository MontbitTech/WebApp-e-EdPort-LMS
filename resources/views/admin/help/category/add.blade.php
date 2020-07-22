@extends('layouts.admin.app')

@section('content')
<!-- Admin-setting-sechool-main  -->
<section class="main-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6  mt-5">


                <div class="card  mt-5">
                    <div class="card-header ">
                        Category
                    </div>
                    <div class="card-body">
                        <form action="{{isset($category)?route('admin.help-category-update',encrypt($category->id)):route('admin.help-category-store')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="Category">Category</label>
                                <input type="text" name="category" class="form-control " id="Category" placeholder="Enter Category" value="{{isset($category)?$category->category:''}}">

                            </div>
                            <button type="submit" class="btn btn-secondary">
                                {{isset($category)?'Update':'Submit'}}
                            </button>
                            <a href="{{route('admin.help-category')}}" class="btn btn-danger ml-1"><i class="fa fa-arrow-left mr-1" aria-hidden="true"></i>Back</a>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
</section>







@endsection