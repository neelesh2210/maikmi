@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 card-title"><h4>{{$page_title}}</h4></div>
                        <div class="col-md-6 text-end">
                            <x-cancle-btn text="Back" route="{{route('salon.index')}}" />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 stretch-card grid-margin grid-margin-md-0 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('salon-gallery.update', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="col-md-12 mb-3">
                                            <label for="document" class="form-label"></label>
                                            <div class="needsclick dropzone" id="document-dropzone">
                                            </div>
                                            @error('gallery')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <x-save-btn text="Update" />
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            dictDefaultMessage: "Select File to Upload",
            url: '{{ route('salon-gallery.store') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="gallery[]" value="' + response.id + '">')
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove();
                if (typeof file.name !== 'undefined') {
                    name = file.name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="gallery[]"][value="' + name + '"]').remove();
            },
            init: function() {
                @if (isset($data) && is_array($data->gallery))
                    @foreach ($data->gallery as $gallery)
                        var existingFileUrl = "{{ imageUrl($gallery) }}";
                        var mockFile = {
                            name: "{{ $gallery }}",
                            size: "30.3",
                            accepted: true
                        };
                        // Add the mock file to the Dropzone
                        this.emit("addedfile", mockFile);
                        this.emit("thumbnail", mockFile, existingFileUrl);
                        this.emit("complete", mockFile);
                        // Disable further file uploads
                        // Customize the look and behavior of the thumbnail
                        this.options.thumbnail.call(this, mockFile, existingFileUrl);
                        $('form').append('<input type="hidden" name="gallery[]" value="{{ $gallery }}">');
                    @endforeach
                @endif
            }
        }
    </script>
@endsection
