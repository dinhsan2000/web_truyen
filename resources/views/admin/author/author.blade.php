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
                                    <h3 class="card-title" style="margin-top: 10px">Danh sách tác giả</h3>
                                    <div class="col-lg-12">
                                        <a href="{{url('admin/them-tac-gia-moi')}}" style="margin-right: 1rem" class="btn btn-primary float-right">Thêm thể loại mới</a>
                                    </div>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên tác giả</th>
                                                <th>Ngày tạo</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($authors as $author)
                                            <tr>
                                                <td>{{$author->id}}</td>
                                                <td>{{$author->name}}</td>
                                                <td>{{$author->created_at->format('d-m-Y H:i:s')}}</td>
                                                <td>
                                                    <a href="{{route('author_detail',['id' => $author->id])}}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{route('author_edit',['id' => $author->id])}}">
                                                        <i class="fas fa-pen"></i>
                                                    </a>
                                                    <a href="{{route('author_delete',['id' => $author->id])}}">
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
