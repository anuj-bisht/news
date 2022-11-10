@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.categories')}}" autocomplete="off" class="form-horizontal" >
                @csrf
                <input class="form-control" name="category_id"  type="hidden" placeholder="Add Category" value="{{$category->id}}" required="">
               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add Category</h4>

                  </div>
                  <div class="card-body ">
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Add Category</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                            <input class="form-control" name="category"  type="text" placeholder="Add Category" value="{{$category->categories}}" required="">
                        </div>
                        </div>
                     </div>







                    </div>

                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

@endsection
