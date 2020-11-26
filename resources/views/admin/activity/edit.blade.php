@extends('layouts.admin.main')

@section('content')
    <div class="card">
        <div class="card-header">
            โพสต์กิจกรรม
        </div>
        <div class="card-body">
            <div class="col-12">
                <h5>แก้ไขข้อมูลกิจกรรม <i class="far fa-newspaper"></i></h5>
                <hr>
            </div>
            <form action="{{ route('activity.update', $activity->ID) }}" method="post">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="form-group">
                            <label for="post_title">หัวเรื่อง</label>
                            <input id="post_title" class="form-control" type="text" name="post_title"
                                value="{{ $activity->post_title }}" required>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <h5>ตั้งค่าเพิ่มเติม</h5>
                        <div class="form-check" required>
                            <input class="form-check-input" name="comment_status"
                                {{ $activity->comment_status == 'open' ? 'checked' : '' }} type="checkbox"
                                id="comment_status" value="open">
                            <label class="form-check-label" for="comment_status">
                                สามารถ Comment ได้
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="post_content">เนื้อหาของกิจกรรม</label>
                            <textarea name="post_content" class="form-control" id="post_content" rows="10" required
                                cols="80">{{ $activity->post_content }} </textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">แก้ไขกิจกรรม</button>
        </div>
        </form>
    </div>
@endsection
x
