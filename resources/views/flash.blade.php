@if (session('success'))
    <div id="message" class="alert alert-success">
        <em id="type">success</em>
        <span>{{ session('success') }}</span>
    </div>
@endif
@if (session('error'))
    <div id="message" class="alert alert-danger">
        <em id="type">danger</em>
        <span>{{ session('error') }}</span>
    </div>
@endif
@if (session('warning'))
    <div id="message" class="alert alert-warning">
        <em id="type">warning</em>
        <span>{{ session('warning') }}</span>
    </div>
@endif
@if (session('info'))
    <div id="message" class="alert alert-info">
        <em id="type">info</em>
        <span>{{ session('info') }}</span>
    </div>
@endif
