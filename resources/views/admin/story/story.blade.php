@extends('admin.layout.layout')
@section('main')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" style="margin-top: 10px">Danh sách thể loại</h3>
                                    <div class="col-lg-12">
                                        <a class="btn btn-primary float-right">Thêm chương mới</a>
                                        <a href="{{url('admin/them-truyen-moi')}}" style="margin-right: 1rem" class="btn btn-primary float-right">Thêm truyện mới</a>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên truyện</th>
                                                <th>Tác giả</th>
                                                <th>Chuyên mục</th>
                                                <th>Số chương</th>
                                                <th>Người đăng</th>
                                                <th>Hình ảnh</th>
                                                <th>Ngày tạo</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($stories as $story)
                                            <tr>
                                                <td>{{$story->id}}</td>
                                                <td>{{$story->name}}</td>
                                                <td>{{$story->authors[0]->name}}</td>
                                                <td>{{$story->categories[0]->name}}</td>
                                                <td></td>
                                                <td>{{$story->users[0]->name}}</td>
                                                <td><img style="width: 50px; height: 50px" src="{{asset($story->image)}}" alt=""></td>
                                                <td>{{$story->created_at->format('d-m-Y H:i:s')}}</td>
                                                <td>
                                                    <a href="{{route('story_edit',['id' => $story->id])}}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="{{route('story_delete',['id' => $story->id])}}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
            <!-- /.content -->
        </div>
    </div>
    <!-- ./wrapper -->
@endsection
