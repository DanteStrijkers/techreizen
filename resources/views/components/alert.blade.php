<div {{ $attributes->merge(['class' => 'alert alert-' . $bootstrapType]) }}>
    {{ $message }}
    {{ $slot }}
</div>
