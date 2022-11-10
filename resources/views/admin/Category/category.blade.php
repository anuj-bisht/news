@extends('layouts.master', ['activePage' => 'news', 'titlePage' => "News Fetch"])

@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Categories</h4>
                <p class="card-category"> Here you can manage categories</p>
              </div>
              <div class="card-body">
                                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{route('add.categories')}}" class="btn btn-sm btn-primary">Add category</a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr><th>
                          Sno.
                      </th>
                      <th>
                        Category Name
                      </th>
                      <th class="text-right">
                        Action
                      </th>

                    </tr></thead>
                    <tbody>
                        @forelse($categories as $category)
                    <tr>
                          <td>
                            {{$loop->iteration}}
                          </td>
                          <td>
                            {{$category->categories}}
                          </td>

                          <td class="td-actions text-right">
                             <a rel="tooltip" class="btn btn-success btn-link" href="{{url('editcategories')}}/{{$category->id}}" data-original-title="" title="">
                                <i class="material-icons">edit</i>
                                <div class="ripple-container"></div>
                              </a>
                                                      </td>
                        </tr>
                        @empty
                        <td>
                          No data
                          </td>
                        @endforelse
                                          </tbody>
                  </table>
                </div>
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>


@endsection
