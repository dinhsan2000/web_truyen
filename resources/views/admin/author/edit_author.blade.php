@extends('admin.layout.layout')
@section('main')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sửa tác giả</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="POST" action="{{route('author_edit',$author->id)}}">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên tác giả</label>
                                        <input type="text" name="name" value="{{$author->name}}" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Bí danh</label>
                                        <input type="text" name="alias" value="{{$author->alias}}" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Từ khoá tìm kiếm</label>
                                        <input type="text" name="keyword" value="{{$author->keyword}}" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Slug</label>
                                        <input type="text" name="slug" value="{{$author->slug}}" class="form-control" id="exampleInputPassword1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả</label>
                                        <textarea id="summernote" name="description">
                                            {{$author->description}}
                                          </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Trạng thái</label>
                                        <select class="form-control" name="status" aria-hidden="true">
                                            <option value="1" {{$author->slug == 1 ? 'selected' : ''}}">Hiển thị</option>
                                            <option value="0">Tạm ẩn</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Lưu lại</button>
                                    <button type="submit" class="btn btn-danger float-right">Làm mới</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection()
