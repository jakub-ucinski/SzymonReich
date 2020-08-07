@extends('layouts.admin.app')

@section('content')

<div for='pages-pages' class="cms-page">
    <div class="d-flex align-items-center justify-content-between">
        <h1>Pages</h1>
        <a href="/admin/pages/create" type="button" class="button">
            <i class="fas fa-plus"></i>
        </a>
    </div>



<table>
    <colgroup>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>
        <col>

    </colgroup>
    <thead>
      <tr>
        <th>Title</th>
        <th>Text</th>
        <th>Options</th>
      </tr>
    </thead>
@foreach ($pages as $page)
    <tr>
        <td>{{$page->title}}</td>
        <td>{{$page->text}}</td>

        <td class="d-flex">
            {{-- <form :action="'products/' + product.id" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" :value="csrf">                    
            
                <!-- @csrf -->
                    <button type="submit" class="button mr-2">
                        <i class="fas fa-trash-alt"></i>
                     </button>
        
            </form> --}}

            <form action="{{ route('pages.destroy', ["page" => $page->id])  }}" method="post">
                @method('DELETE')
                            
                @csrf
                    <button type="submit" class="button mr-2">
                        <i class="fas fa-trash-alt"></i>
                     </button>
        
            </form>
            <a href="{{ route('pages.edit', ["page" => $page->id]) }}" class="button">
                <button type="submit" class="button">
                        <i class="fas fa-pencil-alt"></i>                     
                </button>
            </a>
        </td>
    </tr>
    @endforeach
  </table>

</div>

@endsection
