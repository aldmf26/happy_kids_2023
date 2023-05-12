@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-small text-red-600" style="margin-bottom: 0px;">
            {{ __('Hubungi administrator untuk mengaktifkan akun.') }}
        </div>

        <ul class=" list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li></li>
            @endforeach
        </ul>
    </div>
@endif
