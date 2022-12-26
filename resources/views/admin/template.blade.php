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
                                    <input id="thumbnail" class="form-control" type="text" name="image">
                                </div>
                                <div id="holder" style="margin-top:15px;max-height:100px;"> </div>
                            </div>
                        </div>
                    </div>
                    <form method="POST">
                        @csrf
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
                                                <input class="form-check-input" value="{{ $cate->id }}"
                                                    name="category_id" type="checkbox">
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
                                <input type="text" name="name" class="form-control" id="exampleInputEmail1">
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
                                        <input type="text" name="keyword" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Bí danh</label>
                                        <input type="text" name="alias" class="form-control" id="exampleInputPassword1">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nguồn</label>
                                        <input type="text" name="source" class="form-control"
                                            id="exampleInputPassword1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Tình trạng</label>
                                    <select name="status" class="form-control" aria-hidden="true">
                                        <option value="1" selected="selected">Hoàn thành</option>
                                        <option value="0">Đang cập nhật</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Tình trạng</label>
                                    <select name="status" class="form-control" aria-hidden="true">
                                        <option value="1" selected="selected">Hoàn thành</option>
                                        <option value="0">Đang cập nhật</option>
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
                            <textarea name="description" id="summernote"></textarea>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                    <button type="submit" class="btn btn-danger float-right">Làm mới</button>
                </div>
                </form>
    </section>
</div>
@endsection
