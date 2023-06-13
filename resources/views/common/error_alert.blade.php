<div class="alert alert-danger">
    <ul>
        @foreach ($error_messages as $error_message)
            <li>{{ $error_message }}</li>
        @endforeach
    </ul>
</div>