<div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama </th>
                <th>email</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($siswa as $key =>$item)
        <tr>
    <!-- category list -->
        <!-- todo: show category title -->
        <td>{{$siswa->firstItem()+$key}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->user->email}}</td>
        <td>{{$item->kelas->kelas}} {{$item->kelas->nama_kelas}}</td>
        <div>
            <td>
                <!-- detail -->
                <a href="{{route('siswa.show',['siswa'=>$item])}}" class="btn btn-sm btn-primary" role="button">
                    <i class="fas fa-eye"></i>
                </a>
                <!-- edit -->
                <a href="{{route('siswa.edit',['siswa'=>$item])}}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
                <!-- delete -->
                <form class="d-inline" action="{{route('siswa.destroy',['siswa'=>$item])}}" role="alert" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </div>
    <!-- end  category list -->
    @endforeach
        </tr>
    </table>
</div>


