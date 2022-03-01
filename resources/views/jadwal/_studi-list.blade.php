    <div class="form-group">
        <label for="input_name" class="font-weight-bold">Studi</label>
    <select name="studi" id="" class="form-control @error('kelas') is-invalid @enderror">
        <option value="">Pilih Studi</option>
        @foreach ($studi as $item)
            <option value="{{$item->id}}"}}>{{$item->studi.' '.$item->name}}</option>
        @endforeach
    </select>
    @error('kelas_studi')
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>
