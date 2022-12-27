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
                                        <a href="{{url('admin/them-chuong-truyen-moi', ['id' => $story->id])}}" style="margin-right: 1rem" class="btn btn-primary float-right">Thêm chương truyện</a>
                                    </div>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên mục</th>
                                                <th>Tên chương</th>
                                                <th>Ngày cập nhật</th>
                                                <th>Công cụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($chapters as $chapter)
                                            <tr>
                                                <td>{{$chapter->id}}</td>
                                                <td>{{$chapter->name}}</td>
                                                <td>{{$chapter->subname}}</td>
                                                <td>{{$chapter->updated_at->format('d-m-Y H:i:s')}}</td>
                                                <td>
                                                    <a href="{{route('chapter_edit', ['id' => $chapter->id])}}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="">
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
