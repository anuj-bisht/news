@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('submit.news')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add News</h4>
                     <p class="card-category">News information</p>
                  </div>
                  <div class="card-body ">
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="description" required="true" aria-required="true"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Url</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="url"  type="url" placeholder="News Url" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Source</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="source"  type="text" placeholder="Source" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="author"  type="text" placeholder="Author" value="" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-7">

                           <input class="form-control" name="image"  type="file" required="">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-2"></div>
                     <div class="form-group col-md-3">
                        <label for="category">Category</label>

                        <select id="category"  name="category" class="form-control">
                            <option selected disabled>Select Categories</option>
                            @foreach($category as $categoryy)
                            <option>{{$categoryy->categories}}</option>


                          @endforeach

                        </select>

                      </div>
                      <div class="form-group col-md-3">
                        <label for="country">Country</label>

                        <select id="country"  name="country" class="form-control">
                            <option selected disabled>Select Country</option>
                            @foreach($country as $countryy)
                          <option >{{$countryy->country}}</option>
                          @endforeach
                        </select>

                      </div>
                      <div class="form-group col-md-3">
                        <label for="editable">Editable</label>
                        <select id="editable" class="form-control" name="editable">
                          <option>yes</option>
                          <option>no</option>
                        </select>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
Dropzone.autoDiscover = false;

        $("#image-upload").dropzone({
            maxFiles: 2000,
            acceptedFiles: ".jpeg,.jpg,.png,.gif"
        });

</script>
@endsection
