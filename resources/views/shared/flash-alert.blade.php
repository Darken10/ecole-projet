    @if (session('success'))
        <x-alert type="success"> {{ session('success') }}</x-alert>
    @else
        @if (session('error'))
            <x-alert type="error"> {{ session('error') }}</x-alert>
        @else
            @if (session('info'))
                <x-alert type="info"> {{ session('info') }}</x-alert>
            @else
                @if (session('warning'))
                    <x-alert type="warning"> {{ session('info') }}</x-alert>
                @endif
            @endif
        @endif
    @endif