@foreach ($studi as $item)
    <!-- category list -->
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
        <label class="mt-auto mb-auto">
        <!-- todo: show category title -->
        {{str_repeat('-',$count).' '.$item->studi}}
        </label>
        <div>
            {{-- <a href="{{route('studi.show',['studi'=>$item])}}" class="btn btn-sm btn-primary" role="button">
                <i class="fas fa-eye"></i>
            </a> --}}
        <!-- edit -->
        <a href="{{route('studi.edit',['studi'=>$item])}}" class="btn btn-sm btn-info" role="button">
            <i class="fas fa-edit"></i>
        </a>
        <!-- delete -->
        <form class="d-inline" action="{{route('studi.destroy',['studi'=>$item])}}" role="alert" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-sm btn-danger">
            <i class="fas fa-trash"></i>
            </button>
        </form>
        </div>
    </li>
    <!-- end  category list -->
@endforeach