@extends('admin.main')

@section('content')
    <form action="" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label>Tên danh mục</label>
                <input type="text" name="name" value="{{ $category -> name }}" class="form-control" placeholder="Nhập tên danh mục">
            </div>

            <div class="form-group">
                <label>Danh mục</label>
                <select class="form-control" name="parent_id">
                    <option value="0" {{ $category->parent_id == 0 ? "selected" : ""}}>Danh mục cha</option>
                    @foreach($categorys as $categoryParent)
                        <option value="{{ $categoryParent->id }}"
                            {{ $category->parent_id == $categoryParent->id ? "selected" : ""}} >
                            {{ $categoryParent->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Kích hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active"
                           name="active" {{ $category->active === 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active"
                           name="active" {{ $category->active === 0 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
            </div>
        </div>
        @csrf
    </form>

@endsection

