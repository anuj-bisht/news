@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])
@section('content')
<div class="content">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-12">
            <form method="post" action="{{route('submit.image')}}" autocomplete="off" class="form-horizontal" enctype="multipart/form-data">
                @csrf

               <div class="card">
                  <div class="card-header card-header-primary">
                     <h4 class="card-title">Add News</h4>
                     <p class="card-category">News information</p>
                  </div>
                  <div class="card-body ">

                     <div class="row">
                        <label class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-7">

                           <input class="form-control" name="image"  type="file" required="">
                        </div>
                     </div>
                     <div class="row">
                       <div x-data="{true:false}">
                           <button @click = "open = !open">Toggle</button>
                           <div x-show="open">contents...</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


@endsection
