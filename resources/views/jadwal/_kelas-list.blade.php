<div class="form-group">
    <label for="input_name" class="font-weight-bold">Kelas</label>
    <select name="kelas" id="" class="form-control @error('kelas') is-invalid @enderror">
        <option value="">Pilih Kelas</option>
        @foreach ($kelas as $item)
        <option value="{{$item->id}}" {{old('kelas_id')==$item->id ? 'selected':null}}>{{$item->kelas}} {{$item->nama_kelas}}</option>
        @endforeach
    </select>
    @error('kelas')
        <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>