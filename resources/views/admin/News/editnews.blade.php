@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('update.news')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf
               <input type="hidden" name="id" value="{{$news->id}}">
               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Edit News</h4>
                     <p class="card-category">News information</p>
                  </div>
                  <div class="card-body ">
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <textarea  class="form-control" name="description" required="true" aria-required="true">{{$news->description}}</textarea>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Url</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="url"  type="url" placeholder="News Url" value="{{$news->url}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Source</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="source"  type="text" placeholder="Source" value="{{$news->source}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Author</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                              <input class="form-control" name="author"  type="text" placeholder="Author" value="{{$news->author}}" required="">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-7">
                           <div class="form-group bmd-form-group is-filled">
                               @if(isset($news->image))
                               <img src="{{asset($news->image)}}" style="width:30%; "   class= 'dropzone', id = 'image-upload'>
                               @endif

                           </div>
                           <input class="form-control" name="image"  type="file" required="">
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-2"></div>
                     <div class="form-group col-md-3">
                        <label for="category">Category</label>

                        <select id="category"  name="category" class="form-control">

                            {{-- @foreach($category as $categoryy) --}}
                            {{-- @if($news->category=== $categoryy->categories) --}}
                          <option value="{{$news->category}}">{{$news->category}}</option>
                            @foreach($category as $categoryy)
                            <option>{{$categoryy->categories}}</option>

                          {{-- @endif --}}
                          @endforeach

                        </select>

                      </div>
                      <div class="form-group col-md-3">
                        <label for="country">Country</label>

                        <select id="country"  name="country" class="form-control">
                            <option value="{{$news->country}}">{{$news->country}}</option>

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

                      {{-- <div class="form-group col-md-1"></div> --}}

                    </div>

                  </div>
                  <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Update</button>
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
