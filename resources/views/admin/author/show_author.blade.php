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
                                <h3 class="card-title">Danh sách thể loại</h3>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên thể loại</th>
                                        <th>Alias</th>
                                        <th>Từ khoá</th>
                                        <th>Chi tiết</th>
                                        <th>Slug</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{$author->id}}</td>
                                        <td>{{$author->name}}</td>
                                        <td>{{$author->alias}}</td>
                                        <td>{{$author->keyword}}</td>
                                        <td>{!!$author->description!!}</td>
                                        <td>{{$author->slug}}</td>
                                        <td>{{$author->status == 1 ? 'Hiển thị' : 'Ẩn'}}</td>
                                    </tr>

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

