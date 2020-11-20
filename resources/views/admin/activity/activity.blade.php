@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">
            รายการกิจกรรม
        </div>
        <div class="card-body">
            @if (session('publish'))
                <div class="alert alert-success" role="alert">
                    {{ session('publish') }}
                </div>
            @endif
            @if (session('edit'))
                <div class="alert alert-success" role="alert">
                    {{ session('edit') }}
                </div>
            @endif
            @if (session('error_publish'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error_publish') }}
                </div>
            @endif
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>ชื่อเรื่อง</td>
                        <td style="width: 100px">
                            <center>เผยแพร่</center>
                        </td>
                        <td style="width: 300px">
                            <center>จัดการ</center>
                        </td>
                    </tr>
                    @foreach (App\Models\Activity::join('user_post', 'user_post.post_id', '=', 'wp_posts.id')
            ->where('user_post.user_id', Auth::user()->id)
            ->get()
        as $item)
                        <tr>
                            <td>{{ $item['post_title'] }}</td>
                            <td>
                                <form action="{{ route('activity.update', $item['post_id']) }}" method="post"
                                    name="publish">
                                    @csrf
                                    @method('put')
                                    <center><input type="checkbox" name="post_status"
                                            id="post_status_{{ $item['post_id'] }}"
                                            {{ $item['post_status'] == 'publish' ? 'checked' : '' }}>
                                    </center>
                                </form>
                            </td>
                            <td>
                                <center>
                                    <button class="btn btn-danger px-4"
                                        onclick="deleteActivity({{ $item->post_id }})">ลบ</button>

                                    <a class="btn btn-warning px-4"
                                        href="{{ route('activity.edit', $item['post_id']) }}">แก้ไข</a>


                                </center>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            โพสต์กิจกรรม
        </div>
        <div class="card-body">
            <div class="col-12">
                @if (session('result'))
                    <div class="alert alert-success" role="alert">
                        {{ session('result') }}
                    </div>
                @endif
                <h5>เพิ่มข้อมูลกิจกรรม <i class="far fa-newspaper"></i></h5>
                <hr>
            </div>
            <form action="{{ route('activity.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="post_title">หัวเรื่อง</label>
                            <input id="post_title" class="form-control" type="text" name="post_title" required>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="post_name">SLUG</label>
                            <input id="post_name" class="form-control" type="text" name="post_name">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <h5>ตั้งค่าเพิ่มเติม</h5>
                        <div class="form-check" required>
                            <input class="form-check-input" name="comment_status" type="checkbox" id="comment_status"
                                value="open">
                            <label class="form-check-label" for="comment_status">
                                สามารถ Comment ได้
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="post_content">เนื้อหาของกิจกรรม</label>
                            <textarea name="post_content" class="form-control" id="post_content" rows="10" required
                                cols="80"> </textarea>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-success">เพิ่มกิจกรรม</button>
        </div>
        </form>
        <form action="{{ route('activity.destroy', 0) }}" method="post" name="delete" id="delete">
            @csrf
            @method('delete')
            <input type="text" value="0" id="to_delete" name="to_delete">
        </form>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        let form = Array.from(document.getElementsByName('publish'));

        for (let i = 0; i < form.length; i++) {
            document.getElementsByName('post_status')[i].addEventListener('click', function() {

                if (form[i][2].checked) {
                    form[i][2].value = 'publish';
                } else {
                    form[i][2].value = 'draft';
                }
                form[i].submit();
            })
        }

        function deleteActivity(id) {
            if (confirm('คุณต้องการที่จะลบกิจกรรมนี้')) {
                document.getElementById('to_delete').value = id;
                $('#delete').submit();
            }
        }

    </script>
@endsection
