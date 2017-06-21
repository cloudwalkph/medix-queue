@if (session('success'))
    <div class="alert alert-success">
        <strong>Nice!</strong> {{ session('success') }}.
    </div>
@endif