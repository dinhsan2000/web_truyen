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
                                        <a href="{{url('admin/them-the-loai-moi')}}" style="margin-right: 1rem" class="btn btn-primary float-right">Thêm thể loại mới</a>
                                    </div>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên thể loại</th>
                                                <th>Ngày tạo</th>
                                                <th>Công cụ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{$category->created_at->format('d-m-Y H:i:s')}}</td>
                                                <td>
                                                    <a href="{{route('category_detail',['slug' => Str::slug($category->slug),'id' => $category->id])}}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('category_edit',['id' => $category->id])}}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="{{route('category_delete',['id' => $category->id])}}">
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
