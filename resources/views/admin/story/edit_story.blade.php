@extends('admin.layout.layout')
@section('main')
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sửa truyện</h3>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <form method="POST" enctype="multipart/form-data" action="{{route('story_edit', $story->id)}}">
                @csrf
            <div class="row">
                <div class="col-md-4">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ảnh bìa truyện</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <a id="lfm" data-input="thumbnail" data-preview="holder"
                                            class="btn btn-primary">
                                            <i class="fas fa-images"></i>
                                        </a>
                                    </span>
                                    <input id="thumbnail" value="{{$story->image}}" class="form-control" type="text" name="image">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;">
                                    <img src="{{asset($story->image)}}" style="width: 120px;height:120px; margin-left:10rem" alt="{{$story->image}}">
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Chuyên mục</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($category as $cate)
                                    <div class="col-sm-6">
                                        <!-- checkbox -->
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" value="{{$cate->id}}"
                                                    name="category_id[]" type="checkbox">
                                                <label class="form-check-label">{{ $cate->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin truyện</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên truyện</label>
                                <input type="text" name="name" value="{{$story->name}}" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="form-group">
                                <label>Tác giả</label>
                                <select class="form-control" name="author_id">
                                    @foreach ($author as $authors)
                                    <option value="{{ $authors->id }}">{{ $authors->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Từ khoá tìm kiếm</label>
                                        <input type="text" value="{{$story->keyword}}" name="keyword" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Bí danh</label>
                                        <input type="text" value="{{$story->alias}}" name="alias" class="form-control" id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nguồn</label>
                                        <input type="text" value="{{$story->source}}" name="source" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Tình trạng</label>
                                    <select name="status" class="form-control" aria-hidden="true">

                                        <option value="1" {{$story->status == '1' ? 'selected' : ''}} selected="selected">Hoàn thành</option>
                                        <option value="0" {{$story->status == '0' ? 'selected' : ''}}>Đang cập nhật</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Trạng thái</label>
                                    <select name="publish" class="form-control" aria-hidden="true">
                                        <option value="1" {{$story->publish == '1' ? 'selected' : ''}} selected="selected">Xuất bản</option>
                                        <option value="0" {{$story->publish == '0' ? 'selected' : ''}}>Chưa xuất bản</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mô tả</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả</label>
                            <textarea name="description" id="summernote">{{$story->description}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <button type="submit" class="btn btn-danger float-right">Làm mới</button>
                </div>
            </form>
            </div>
            </section>
</div>
@endsection
