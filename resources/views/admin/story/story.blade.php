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
                    <div class="col-md-4">

                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">

                                <div class="text-center">
                                    <img class="profile-user-img" style="width: 150px"
                                        src="https://st.ntcdntempv3.com/data/comics/64/su-tro-lai-cua-nguoi-choi-bi-dong-bang.jpg"
                                        alt="User profile picture">
                                </div>
                                <h4 class="pull-left" style="margin-top: 1rem">{{$story->name}}</h4>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <p>The loai: abc</b>
                                    <p>Danh muc:{{$story->categories->name}}</p>
                                    <p>Tac gia: {{$story->authors->name}}</p>
                                </ul>
                                <ul class="list-group list-group-unbordered mb-3">
                                    <p><i class="fas fa-user nav-icon"></i>Nguoi dang:</p>
                                    <p><i class="far fa-clock nav-icon"></i>Tao</p>
                                    <p><i class="fas fa-calendar-day"></i></i>Sua</p>
                                    <p><i class="fas fa-list nav-icon"></i>So tap</p>
                                </ul>
                                <a href="{{ route('story_detail', ['id' => $story->id]) }}"
                                    class="btn btn-outline-warning btn-sm">Edit <i class="fas fa-edit nav-icon"></i></a>
                                <a href="{{ route('story_edit', ['id' => $story->id]) }}"
                                    class="btn btn-outline-success btn-sm">View <i class="fas fa-eye nav-icon"></i></a>
                                <a href="{{ route('story_delete', ['id' => $story->id]) }}"
                                    class="btn btn-outline-danger btn-sm">Delete <i class="fas fa-trash nav-icon"></i></a>
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
