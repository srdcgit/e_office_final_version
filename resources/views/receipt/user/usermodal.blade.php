<div>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Phone:</strong> {{ $user->phone }}</p>
    <p><strong>Role:</strong> {{ $user->type ?? 'N/A' }}</p>
    <p><strong>Department:</strong> {{ $user->departments->name ?? 'N/A' }}</p>
    <p><strong>Section:</strong> {{ $user->sections->name ?? 'N/A' }}</p>
    <!-- Add other fields as needed -->
</div>
