<div
class="mx-8"
    wire:ignore
    x-data
    x-init="() => {
        const post = FilePond.create($refs.input,{
            credits:false,
            allowMultiple: {{ $attributes->has('multiple') ? 'true' : 'false' }},
            acceptedFileTypes: ['image/jpeg','image/png','text/csv','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/pdf','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/vnd.ms-powerpoint','application/vnd.openxmlformats-officedocument.presentationml.presentation'],
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            }
        });
    }"
>
    <input type="file" x-ref="input" />
    
</div>

@section('styles')
    @once
        <link href="{{ asset('filepond/dist/filepond.css')}}" rel="stylesheet">
    @endonce
@endsection

@section('scripts')
    @once
        <script src="{{ asset('filepond/dist/filepond.js')}}"></script>
        <script src="{{ asset('filepond/dist/filepond-plugin-file-validate-type.js')}}"></script>
        <script>
            FilePond.registerPlugin(FilePondPluginFileValidateType);
        </script>
    @endonce
@endsection