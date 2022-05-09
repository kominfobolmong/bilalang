@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Berita</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book-open"></i> Edit Pengumuman</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.post.update', $post->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <strong hidden>Author ID:</strong>
                            <input class="form-control" type="text" name="user_id" id="user_id"
                                value="{{ auth()->user()->id }}" placeholder="{{ auth()->user()->id }}" hidden readonly>
                                @error('user_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>JUDUL PENGUMUMAN</label>
                            <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                placeholder="Masukkan Judul Pengumuman"
                                class="form-control @error('title') is-invalid @enderror">


                            @error('title')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KATEGORI</label>
                            <select class="form-control select-category @error('category_id') is-invalid @enderror"
                                name="category_id">
                                <option value="">-- PILIH KATEGORI --</option>
                                @foreach ($categories as $category)
                                    @if($post->category_id == $category->id)
                                        <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>KONTEN</label>
                            <textarea class="form-control content @error('content') is-invalid @enderror" name="content"
                                placeholder="Masukkan Konten / Isi Berita"
                                rows="10">{!! old('content', $post->content) !!}</textarea>
                            @error('content')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>EMBED</label>
                            <textarea class="form-control content @error('embed') is-invalid @enderror" name="embed"
                                placeholder="Masukkan Embed / Link"
                                rows="10">{!! old('embed', $post->embed) !!}</textarea>
                            @error('embed')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">TAGS</label>
                            <select class="form-control" name="tags[]"
                                multiple="multiple">
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}" {{ in_array($tag->id, $post->tags()->pluck('id')->toArray()) ? 'selected' : '' }}> {{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            UPDATE</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
<!-- <script>
    var editor_config = {
        selector: "textarea.content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        forced_root_block : false,
    };

    tinymce.init(editor_config);
</script> -->
@stop