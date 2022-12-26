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
                                    <a href="{{ url('admin/them-truyen-moi') }}" style="margin-right: 1rem"
                                        class="btn btn-primary float-right">Thêm truyện mới</a>
                                </div>
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
                    @foreach ($stories as $story)
                        <div class="col-md-3">

                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <p>ID: {{$story->id}}</p>

                                </div>
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                        <img class="img-fluid img-thumbnail" style="width: 150px"
                                            src="{{ asset($story->image) }}" alt="User profile picture">
                                    </div>
                                    <p class="pull-right" style="margin-top: 10px; font-size: 15px">{{ $story->name }}</p>

                                    <p>Tác giả: {{ $story->authors->name }}</p>
                                    <p>Danh mục: {{ $story->categories->name }} </p>

                                    <p>
                                        <i class="fas fa-user nav-icon" style="margin-right: 3px;">
                                        </i>Người đăng: <b>{{ $story->users->name }}
                                        </b></p>
                                    <p><i class="far fa-clock nav-icon" style="margin-right: 3px;"></i>
                                        Tạo lúc: <b>{{ $story->created_at->format('d-m-Y H:i:s') }}</b></p>
                                    <p><i class="fas fa-calendar-day" style="margin-right: 3px;"></i>
                                        Sửa lúc: <b>{{ $story->updated_at->format('d-m-Y H:i:s') }}</b></p>
                                    <p><i class="fas fa-list nav-icon" style="margin-right: 3px;"></i>
                                        Số tập: <b>123</b></p>
                                        <div class="card-footer">
                                    <a href="{{ route('story_delete', ['id' => $story->id]) }}"
                                        class="btn btn-outline-danger btn-xs">Chương <i class="fas fa-list nav-icon"></i></a>
                                    <a href="{{ route('story_edit', ['id' => $story->id]) }}"
                                        class="btn btn-outline-warning btn-xs">Sửa <i class="fas fa-edit nav-icon"></i></a>
                                    <a href="{{ route('story_detail', ['id' => $story->id]) }}"
                                        class="btn btn-outline-success btn-xs">Xem <i class="fas fa-eye nav-icon"></i></a>
                                    <a href="{{ route('story_delete', ['id' => $story->id]) }}"
                                        class="btn btn-outline-danger btn-xs">Xoá <i class="fas fa-trash nav-icon"></i></a>
                                        </div>
                                </div>

                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    </div>
    <!-- ./wrapper -->
@endsection
