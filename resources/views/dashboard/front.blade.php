@extends('layout.main')
@section('title')
<title> Dashboard </title>
@endsection
@section('content')
<div class="right_col" role="main">
	 @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
<div class="image-container"  style="text-align: center;">
        <img src="{{asset('logino/images/'.$bg->url_foto)}}" alt="Responsive Image" style="max-width: 100%; max-height: 600px;">
    </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display: block; margin: 20px auto 0;">Edit</button>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Upload Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form with Dropify file input -->
                    <form action="{{route('front.update',1)}}" method="POST" enctype="multipart/form-data">
                		@method('patch')
						@csrf
                        <div class="form-group">
                            <label for="image">Image Upload</label>
                            <input type="file" id="image" class="dropify" name="image" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
