@if ($path)
    <div class="upload-preview">
        <img
            class="mx-auto h-20 w-24 rounded-lg border border-slate-200 object-cover"
            src="{{ asset($path) }}"
            alt="{{ $label }}"
        >
        <a href="{{ asset($path) }}" download>Download</a>
    </div>
@else
    <span class="text-sm font-semibold text-slate-400">-</span>
@endif
