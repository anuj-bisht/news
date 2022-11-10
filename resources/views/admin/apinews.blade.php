@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])

@section('content')
{{-- <div class="container h">
    <input type="text" id="keywords">
<input type="text" id="category">
<button onclick="searchnews()">Search</button> --}}
<div class="container" style="padding-top: 70px;">
    <div class="row">
        <div class="col-12 text-right">
           <a href="{{url('addnews')}}" class="btn btn-sm btn-primary">Add News</a>
        </div>
     </div>
     <div class="row">
        <div class="col-12 text-center">
            @foreach($categories as $category)
     <button type="button" class="btn btn-info btn-round" value="{{$category->categories}}" onclick="chooseCategory(this.value)" >{{$category->categories}}</button>
             @endforeach

        </div>
     </div>
    <div class="row">
       <div class="col-lg-12">
          <table class="table" style="font-size:13px;">
             <thead class="thead-light">
                <tr>
                   <th scope="col">Sno.</th>
                   <th scope="col" style='width:200px;'>Image</th>
                   <th scope="col">Description</th>
                   <th scope="col">Category</th>

                </tr>
             </thead>
             <tbody class="newsData" id="row">
                @forelse($data as $information)
                @if($information->editable=='yes')
                <tr style="background-color:antiquewhite">
                    <td>{{$loop->iteration}}</td>
                   <th><img src="{{$information->image}}" class="img-fluid rounded-start" alt="Not Found" style="height:120px; object-fit='contain';"></th>
                   <td><div>{!!substr($information->description,0,80)!!}</div><div><b>{{$information->author}}</b></div></td>
                   <td>{{$information->category}}</td>
                   <td><a class="btn btn-primary" href="{{$information->url}}" >Read More</a></td>
                   <td class="td-actions text-right">
                    <a rel="tooltip" class="btn btn-success btn-link" href="{{asset('news/edit')}}/{{$information->id}}" data-original-title="" title="">
                       <i class="material-icons">edit</i>
                       <div class="ripple-container"></div>
                    </a>
                    {{-- <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="fa-solid fa-eye"></i>
                        <div class="ripple-container"></div>
                     </a> --}}
                 </td>
                 <td>
                    @if($information->status==1)
                    <input type="checkbox" checked id="{{$information->id}}no"  class="{{$information->id}}"  onclick='newsactive(this.id)'>
                    @else
                    <input type="checkbox"   id="{{$information->id}}yes" class="{{$information->id}}" onclick='newsactive(this.id)'>
                    @endif
                   </td>
                </tr>
                @elseif($information->editable=='no')
                <tr>
                    <td>{{$loop->iteration}}</td>
                   <th><img src="{{$information->image}}" class="img-fluid rounded-start" alt="Not Found" style="height:120px;"></th>
                   <td><div>{!!substr($information->description,0,80)!!}</div><div><b>{{$information->author}}</b></div></td>
                   <td>{{$information->category}}</td>
                   <td><a class="btn btn-primary" href="{{$information->url}}" >Read More</a></td>
                   <td class="td-actions text-right">
                    <a rel="tooltip" class="btn btn-success btn-link" href="{{asset('news/edit')}}/{{$information->id}}" data-original-title="" title="">
                       <i class="material-icons">edit</i>
                       <div class="ripple-container"></div>
                    </a>
                    {{-- <a rel="tooltip" class="btn btn-success btn-link" href="#" data-original-title="" title="">
                        <i class="fa-solid fa-eye"></i>
                        <div class="ripple-container"></div>
                     </a> --}}
                 </td>
                 <td>
                    @if($information->status==1)
                    <input type="checkbox" checked id="{{$information->id}}no"  class="{{$information->id}}"  onclick='newsactive(this.id)'>
                    @else
                    <input type="checkbox"   id="{{$information->id}}yes" class="{{$information->id}}" onclick='newsactive(this.id)'>
                    @endif
                   </td>
                </tr>
                @endif
                @empty
                <td>No Data found</td>
                @endforelse
             </tbody>

          </table>
       </div>
       <div class="d-flex justify-content-center newsData">
        {{$data->links("pagination::bootstrap-4")}}
    </div>
    </div>
 </div>



@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    function newsactive(id){
    var checkbox= document.getElementById(id);   //yes or no
    if(checkbox.checked == true)
        {
            value = 'yes';
        }
        else
        {
            value = 'no';

        }
    var user_id= document.getElementById(id).className;  //user id
    $.ajax({
         type:'GET',
         dataType:'JSON',
         url:'{{URL::to("newsactive")}}/'+user_id+'/'+value,
         success:function(data){
             console.log(data);
         }
    });

    }

    function chooseCategory(category){

        $('.newsData').empty();
        $('.newsData nav').empty();
        $.ajax({
         type:'GET',

         dataType:'JSON',

         url:'{{URL::to("categorynews")}}/'+category,
         success:function(data){
             var newslength=data.length;
             if(newslength > 0){
                for (const element of data) {
                     var news=` <tr style="">
                    <td>${element['id']}</td>
                    <th><img src="${element['image']}" class="img-fluid rounded-start" alt="Not Found" style="height:120px; object-fit='contain';"></th>
                    <td><div>${'nil'?element['description'].substr(0,20):element['description']}</div><div><b>${element['author']}</b></div></td>
                   <td>${element['category']}</td>
                   <td><a class="btn btn-primary" href="${element['url']}" >Read More</a></td>
                   <td class="td-actions text-right">
                    <a rel="tooltip" class="btn btn-success btn-link" href="{{asset('news/edit')}}/${element['id']}" data-original-title="" title="">
                       <i class="material-icons">edit</i>
                       <div class="ripple-container"></div>
                    </a>

                 </td>
                 <td>



                   </td>



                </tr>`
                var rows= document.getElementById('row');
                rows.insertAdjacentHTML('afterbegin', news);
                 }
             }
            //  else{

            //  }
         }
    });

    }
</script>
