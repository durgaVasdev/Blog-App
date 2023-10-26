<tbody id="user-list">
    @foreach ($users as $user)
        <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roleNames }}</td>
            <td><img src="{{ $user->image }}" width="100px" alt="User Image"></td>
            <td>{!! $user->statusAndLastSeen !!}</td>
            <td>
                @foreach ($user->products as $product)
                    {{ $product->name }} {{ !$loop->last ? ',' : '' }}
                @endforeach
            </td>
            <td>
                <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-dark">View</a>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-dark">Edit</a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
    @endforeach
</tbody>


{{ $users->links() }}
